<?php

require_once '_common.inc.php';
require_once '_auth.inc.php';


$user = Session::currentUser();
$name = $user->firstName . ' ' . $user->lastName;

loadView('_profile.php', ['name' => $name]);