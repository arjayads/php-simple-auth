<?php

include_once '../Config/Config.php';
require_once '../User.php';
require_once 'Str.php';

class Session {

    # Logs in the given user.
    static function logIn($user) {
        if (isset($user)) {
            session_start();
            $_SESSION['userId'] = $user->id;
        }
    }

    # Remembers a user in a persistent session.
    static function remember(User $user) {
        $user->remember();
        $cookie = new CookieSigner(Config::app()['BASE_KEY']);
        $cookie->set('userId', $user->id);
        $cookie->set('rememberToken', $user->rememberToken);
    }

    # Returns true if the given user is the current user.
    static function isCurrentUser(User $user) {
        return $user == self::currentUser();
    }

    # Returns the current logged-in user (if any).
    static function currentUser() {
        $cookie = new CookieSigner(Config::app()['BASE_KEY']);

        if (isset($_SESSION['userId']) && $userId = $_SESSION['userId']) {
            $user = new User();
            return $user->findOne($userId);
        } else if ($userId = $cookie->get('userId')) {
            $user = new User();
            $user->findOne($userId);

            if ($user && $user->isAuthenticated('remember', $cookie->get('rememberToken'))) {
                self::logIn($user);
                return $user;
            }
        }
        return null;
    }

    # Returns true if the user is logged in, false otherwise.
    static function isLoggedIn() {
        $user = self::currentUser();
        return isset($user) && $user != null;
    }

    # Forgets a persistent session.
    static function forget(User $user) {
        $user->forget();
        setcookie( "userId", '');
        setcookie( "rememberToken", '');
    }

    # Logs out the current user.
    static function logout() {
        self::forget(self::currentUser());
        unset($_SESSION['userId']);
        session_destroy();
    }

    # Redirects to stored location (or to the default).
    static function redirectBackOr($default) {
        $redirectUrl = isset($_SESSION['forwardingUrl']) ? $_SESSION['forwardingUrl'] : $default;
        unset($_SESSION['forwardingUrl']);
        header('Location: ' . $redirectUrl);
    }

    # Stores the URL trying to be accessed.
    static function storeLocation() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $_SESSION['forwardingUrl'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        }
    }

    static function putFlash($message) {
        if ($message === FALSE) {
            unset($_SESSION['FLASH']);
        } else {
            $_SESSION['FLASH'] = $message;
        }
    }

    static function getFlash($key = false) {
        if (isset($_SESSION['FLASH'])) {
            return $key ? $_SESSION['FLASH'][$key] : $_SESSION['FLASH'];
        }
        return NULL;
    }
}

class CookieSigner {

    public function __construct($secret) {
        $this->iv = mcrypt_create_iv(32);
        $this->secret = $secret;
    }

    private function encrypt($value) {
        $securekey = hash('sha256', $this->secret, TRUE);
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $securekey, $value, MCRYPT_MODE_ECB, $this->iv));
    }

    private function decrypt($value) {
        $securekey = hash('sha256', $this->secret, TRUE);
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $securekey, base64_decode($value), MCRYPT_MODE_ECB, $this->iv));
    }

    public function set($name, $value, $signed = TRUE) {
        if ($signed === TRUE) {
            $encryptedData = $this->encrypt($value);
            setcookie($name, $encryptedData, time() + (10 * 365 * 24 * 60 * 60));
        } else {
            setcookie($name, $value, time() + (10 * 365 * 24 * 60 * 60));
        }

    }

    public function get($name, $signed = TRUE) {
        if (isset($_COOKIE[$name])) {
            $value = $_COOKIE[$name];
            if ($signed === TRUE) {
                return $this->decrypt($value);
            }
            return $value;
        }
        return null;
    }
}