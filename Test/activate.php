<?php

require_once '_common.inc.php';


if (isset($_GET['token']) && isset($_GET['email'])) {
    $u = new User();
    $user = $u->findOneBy("email = '" . $_GET['email'] . "'");

    if ($user && !$user->isActive && $user->isAuthenticated('activation', $_GET['token'])) {
        $user->activate();
        Session::logIn($user);
        Session::putFlash(['info'=>'Account activated!']);
        redirect("/profile.php");
    }  else {
        Session::putFlash(['danger' => "Invalid activation link!"]);
        redirect("/");
    }
} else {
    redirect('/');
}