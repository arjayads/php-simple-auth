<?php

require_once 'Helper/Database.php';
require_once 'Helper/Str.php';
require_once 'Helper/Emailer.php';

class User {

    private $id;

    private $fillables = [
        'firstName', 'lastName', 'email', 'username', 'passwordDigest',
        'activationDigest', 'rememberDigest', 'resetDigest', 'resetSentAt', 'activatedAt',
        'isActive', 'id'
    ];

    public function __construct() {
        $this->createActivationDigest();
    }

    public function __get($prop) {
        return $this->{$prop};
    }
    public function __set($prop, $value = null) {
        $this->{$prop} = $value;
    }

    public function findOne($userId) {
        $db = new Database();
        $row = $db->executeQuery('SELECT *, isActive+0 as isActive FROM User WHERE id = :id LIMIT 1', ['id' => $userId]);
        if ($row) {
            return $this->toObject($row[0]);
        }
        return null;
    }

    public function find($criteria = null) {
        $db = new Database();
        $sql = 'SELECT *, isActive+0 as isActive FROM User WHERE 1 ';

        if ($criteria) {
            $sql .= "AND $criteria";
        }
        return $db->executeQuery($sql, [], PDO::FETCH_OBJ);
    }

    public function findOneBy($criteria = null) {
        $db = new Database();
        $sql = 'SELECT *, isActive+0 as isActive FROM User WHERE 1 ';

        if ($criteria) {
            $sql .= "AND $criteria";
        }
        $sql .= ' LIMIT 1';
        $rows = $db->executeQuery($sql);
        if ($rows) {
            return $this->toObject($rows[0]);
        }
        return null;
    }

    public function findAll() {
        $db = new Database();
        return $db->executeQuery('SELECT * FROM User');
    }

    public function save() {
        $db = new Database();
        $update = isset($this->id);
        $id = $update ? $this->id : 0;

        $vars  = get_object_vars($this);

        if ($vars) {
            $script = $update ? 'UPDATE User SET ' : 'INSERT INTO User SET ';

            $allowedParams = [];
            foreach($vars as $k => $v) {
                if (in_array($k, $this->fillables)) {
                    $allowedParams[$k] = $v;
                    $script .= " $k = :$k,";
                }
            }
            $script = rtrim($script, ',');

            if ($update) {
                $script .= " WHERE id = $id";
            } else {
                $this->createPasswordDigest();
                $allowedParams['id'] = 0;
                $allowedParams['passwordDigest'] = $this->passwordDigest;

                $script .= " ,passwordDigest = :passwordDigest ";
            }
            $result = $db->executeUpdate($script, $allowedParams);
            if ($result) {
                if ($update) {
                    return $this->findOne($this->id);
                } else {
                    return $this->findOne($db->lastInsertId);
                }
            }
        }
        return null;
    }

    private function toObject(array $assocArray) {
        foreach($assocArray as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

    # Returns a random token
    protected function newToken($str = '') {
        if ($str && strlen($str) > 0) {
            return hash_hmac('sha256', $str, 'secret');
        }
        return hash_hmac('sha256', Str::random(40), 'secret');
    }

    # Remembers a user in the database for use in persistent sessions.
    public function remember() {
        $this->rememberToken = $this->newToken();
        $this->rememberDigest = $this->digest($this->rememberToken);
        $this->save();
    }

    # Forgets a user.
    public function forget() {
        $this->rememberDigest = NULL;
        $this->save();
    }

    # Returns the hash digest of the given string.
    protected function digest($str) {
        return password_hash($str, PASSWORD_BCRYPT, ["cost" => 4]);
    }

    # Returns true if the given token matches the digest.
    public function isAuthenticated($attribute, $token) {
        $digest = $this->{"{$attribute}Digest"};
        if (isset($digest)) {
            return password_verify($token, $digest);
        }
        return false;
    }

    # Activates an account.
    public function activate() {
        $this->isActive = True;
        $this->activatedAt = date("Y-m-d H:i:s");
        $this->save();
    }

    # Sends activation email.
    public function sendActivationEmail() {
        $email = urlencode($this->email);
        $token = urlencode($this->activationToken);

        $body = <<<BODY
        <h1>UCM Tool</h1>

        <p>Hi {$this->firstName},</p>

        <p>
          Welcome to the UCM! Click on the link below to activate your account:
        </p>

        <a href="{$_SERVER['HTTP_HOST']}/activate.php?token={$token}&email={$email}">Activate</a>
BODY;

        Emailer::send(['arjay@verticalops.com' => 'arjay'], [$this->email], 'Activation', $body);
    }

    # Sets the password reset attributes.
    public function createResetDigest() {
        $this->resetToken = $this->newToken();
        $this->resetDigest = $this->digest($this->resetToken); # remove later

        $this->resetSentAt = date("Y-m-d H:i:s");
        $this->save();
    }

    # Sends password reset email.
    public function sendPasswordResetEmail() {
        $token = urlencode($this->resetToken);
        $email = urlencode($this->email);
        $body = <<<BODY
        <h1>Password reset</h1>

        <p>To reset your password click the link below:</p>

        <a href="{$_SERVER['HTTP_HOST']}/password_reset.php?token={$token}&email={$email}">Reset password</a>

        <p>This link will expire in two hours.</p>

        <p>
          If you did not request your password to be reset, please ignore this email and
          your password will stay as it is.
        </p>
BODY;
        Emailer::send(['arjay@verticalops.com' => 'arjay'], [$this->email], 'Password reset', $body);

    }

    # Returns true if a password reset has expired.
    public function passwordResetExpired() {
        # reset_sent_at < 2.hours.ago
    }

    private function createActivationDigest() {
       $this->activationToken = $this->newToken();
       $this->activationDigest = $this->digest($this->activationToken);
    }

    public function createPasswordDigest() {
        $this->passwordDigest = $this->digest($this->password);
    }
}