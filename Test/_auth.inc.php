<?php

if (!Session::isLoggedIn()) {
    Session::storeLocation();
    Session::putFlash(['danger' => 'Please log in']);
    redirect("session.php");
}