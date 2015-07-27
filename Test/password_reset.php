<?php

require_once '_common.inc.php';


function getUser($email) {
    $u = new User();
    return $u->findOneBy("email = '$email'");
}

$errors = [];
if ($_POST) {
    if (isset($_POST['password_reset']['email']) && $_POST['password_reset']['email']) { // enter email for password reset
        $user = getUser($_POST['password_reset']['email']);
        if ($user) {
            $user->createResetDigest();
            $user->sendPasswordResetEmail();

            Session::putFlash(['success' =>'Email sent with password reset instructions']);
            redirect('session.php');
            
        } else {
            $errors[] = 'Email not found!';
        }
    } else if (isset($_POST['member']['password']) && isset($_POST['member']['password_confirmation'])) { // new password entered
        if (empty($_POST['member']['password'])) {
            $data['errors'] = ["Password can't be blank"];
            loadView('_password_reset_confirm.php', $data);
            exit;
        } else if ($_POST['member']['password'] != $_POST['member']['password_confirmation']) {
            $data['errors'] = ["Password confirmation doesn't match with Password"];
            loadView('_password_reset_confirm.php', $data);
        } else {
            $user = getUser($_POST['member']['email']);
            if ($user) {
                if ($user && $user->isActive && $user->isAuthenticated('reset', $_POST['token'])) {
                    $user->password = $_POST['member']['password'];
                    $user->createPasswordDigest();
                    $user->save();

                    Session::putFlash(['success' => 'Password has been reset.']);
                    redirect('session.php');
                }
            }
            $data['errors'] = ["User not found!"];
            loadView('_password_reset_confirm.php', $data);
        }
    } else {
        $errors[] = "Email can't be blank";
    }
} else if (isset($_GET['token']) && isset($_GET['email'])) { // password reset link click from email
    $user = getUser($_GET['email']);

    if ($user && $user->isActive && $user->isAuthenticated('reset', $_GET['token'])) {
        $data['email'] = $_GET['email'];
        $data['token'] = $_GET['token'];
        loadView('_password_reset_confirm.php', $data);
        exit;
    }  else {
        redirect("/");
    }
}
// default
$data['errors'] = $errors ? $errors : [];
loadView('_password_reset_email.php', $data);