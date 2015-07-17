<?php

require_once '_common.inc.php';


if (!Session::isLoggedIn()) {
    redirect("/session.php");
}

$user = Session::currentUser();
$name = $user->firstName . ' ' . $user->lastName;

loadView('_profile.php', ['name' => $name]);