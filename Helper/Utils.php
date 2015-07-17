<?php

require_once 'Session.php';

function loadView($html, $data = []) {
    ob_start();
    extract($data); // make variables available in the view
    include_once $html; // content to be loaded inside layout html
    $content = ob_get_clean();
    include_once '_layout.php';

    Session::flash(FALSE);
}

function redirect($link) {
    header("location: $link");
    exit;
}