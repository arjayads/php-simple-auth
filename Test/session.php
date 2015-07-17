<?php

require_once '_common.inc.php';


if (isset($_GET['logout'])) {
    Session::logout();
    redirect("/");

} else if (Session::isLoggedIn()) {
    redirect("/profile.php");
} else if (isset($_POST['signin'])) {

    $errors = [];
    if (!isset($_POST['session']['email'])) {
        $errors[] = 'Input email';
    }

    if (count($errors) > 0) {
        $data['errors'] = $errors;
        $data['session'] = $_POST['session'];
        loadView('_signin_form.php', $data);
    } else {
        $user = new User();
        $user = $user->findOneBy("email = '" . $_POST['session']['email'] . "'");

        if ($user && $user->isActive && $user->isAuthenticated('password', $_POST['session']['password'])) {
            Session::logIn($user);

            if (isset($_POST['session']['remember_me']) && $_POST['session']['remember_me'] == '1') {
                Session::remember($user);
            } else {
                Session::forget($user);
            }
            redirect("profile.php");
        } else {
            $data['session'] = $_POST['session'];
            $data['errors'] = ['Invalid email and password combination'];
            loadView('_signin_form.php', $data);
        }
    }
} else {
    loadView('_signin_form.php');
}