<?php

require_once 'Session.php';

function loadView($html, $data = []) {
    ob_start();
    extract($data); // make variables available in the view
    include_once $html; // content to be loaded inside layout html
    $content = ob_get_clean();
    include_once '_layout.php';

    Session::putFlash(FALSE);
}

function redirect($link) {
    header("location: $link");
    exit;
}

/**
 * @param $vars - instance variables with values
 * @param $script - sql script (update/insert)
 * @param $fields - table columns might be affected during insert/update
 * @return array - ['script' => $script, 'params' => $allowedParams]
 */
function constructScriptAndParams($vars, $script, $fields) {
    $allowedParams = [];
    foreach($vars as $k => $v) {
        if (in_array($k, $fields)) {
            $allowedParams[$k] = $v;
            $script .= " $k = :$k,";
        }
    }
    $script = rtrim($script, ',');

    return ['script' => $script, 'params' => $allowedParams];
}