<?php

require_once '_common.inc.php';

if (Session::isLoggedIn()) {
    redirect("/profile.php");
}

loadView('_index.php');