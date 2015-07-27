<?php

class Config {

    static function db() {
        return include 'DbConfig.php';
    }

    static function email() {
        return include 'EmailConfig.php';
    }

    static function app() {
        return include 'AppConfig.php';
    }
}