<?php

class EmailTemplate {

    static function passwordReset($user) {
        $token = urlencode($user->resetToken);
        $email = urlencode($user->email);
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
        return $body;
    }

    static function userActivation($user) {
        $email = urlencode($user->email);
        $token = urlencode($user->activationToken);

        $body = <<<BODY
        <h1>UCM Tool</h1>

        <p>Hi {$user->firstName},</p>

        <p>
          Welcome to the UCM! Click on the link below to activate your account:
        </p>

        <a href="{$_SERVER['HTTP_HOST']}/activate.php?token={$token}&email={$email}">Activate</a>
BODY;

        return $body;
    }
}