<?php

class Config {

    static function db() {
        return include 'Db.php';
    }

    static function email() {
        return include 'Email.php';
    }

    static function app() {
        return include 'App.php';
    }
}