<?php

require_once '_common.inc.php';



if (Session::isLoggedIn()) {
    redirect("/profile.php");

} else if (isset($_POST['signup'])) {

    $errors = [];
    if (!isset($_POST['member']['email']) || !$_POST['member']['email']) {
        $errors[] = 'Email can\'t be blank';
    } else {
        $u = new User();
        $user = $u->findOneBy("email = '" . $_POST['member']['email'] . "'");
        if ($user) {
            $errors[] = 'Email is already taken';
        }
    }
    if (!isset($_POST['member']['first_name']) || !$_POST['member']['first_name']) {
        $errors[] = 'Enter first name';
    }
    if (!isset($_POST['member']['password']) || !$_POST['member']['password']) {
        $errors[] = 'Enter password';
    } else {
        if (strcmp($_POST['member']['password'], $_POST['member']['password_confirmation']) !== 0) {
            $errors[] = 'Password confirmation does not matched with Password';
        }
    }

    if (count($errors) > 0) {
        $data['member'] = $_POST['member'];
        $data['errors'] = $errors;
        loadView('_signup_form.php', $data);
    } else {
        $u = new User();
        $u->isActive = false;
        $u->email = $_POST['member']['email'];
        $u->firstName = $_POST['member']['first_name'];
        $u->lastName = $_POST['member']['last_name'];
        $u->password = $_POST['member']['password'];

        $result = $u->save();
        if ($result) {
            $result->sendActivationEmail();
            Session::flash("Sign-up successful. An email is sent to you to activate your account before you can sign-in");
            redirect("/session.php");
        } else {
            $data['member'] = $_POST['member'];
            $data['errors'] = ['Something went wrong'];
            loadView('_signup_form.php', $data);
        }
    }
} else {
    loadView('_signup_form.php');
}