<?php

/*
require_once '../User.php';
$u = new User();
$u->isActive = true;
$u->email = 'arjay@verticalops.com';
$u->firstName = 'Arjay';
$u->lastName = 'Ads';
$u->password = 'adsads';

$u->save();
$token = $u->activationToken;
# User account activation
print $u->isAuthenticated('activation', $token) ? "User activated!" : 'Invalid activation token' . PHP_EOL;
print  PHP_EOL;

# Reset user password
$u->createResetDigest();
$token = $u->resetToken;

$valid = $u && $u->isActive && $u->isAuthenticated('reset', $token);
print $valid ? "Email sent with password reset instructions" : 'Error' ;
print  PHP_EOL;

# Verify password
$u = $u->findOneBy("email = 'arjay@verticalops.com'");
$cool = $u->isAuthenticated('password', 'adsads');

print $cool ? "Access granted" : 'Access denied' ;
print  PHP_EOL;


# Test account activation
require_once '../Helper/Emailer.php';

$u = new User();
$u->isActive = false;
$u->email = 'arjayads@gmail.com';
$u->firstName = 'Arjay';
$u->lastName = 'Ads';
$u->password = 'adsads';

$u->save();
$email = urlencode($u->email);
$token = urlencode($u->activationToken);

print $token . PHP_EOL;
print $u->activationDigest . PHP_EOL;

$body = <<<BODY
    <h1>UCM Tool</h1>

    <p>Hi {$u->firstName},</p>

    <p>
      Welcome to the UCM! Click on the link below to activate your account:
    </p>

    <a href="http://auth.dev/activate.php?token={$token}&email={$email}">Activate</a>
BODY;

Emailer::send(['arjay@verticalops.com' => 'arjay'], [$u->email], 'Activation', $body);

*/