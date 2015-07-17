<?php

include_once '../Config/Config.php';

class Database {
    private $username;
    private $password;
    private $host;
    private $database;

    function __construct() {
        $config = Config::db();
        $this->host = $config['host'];
        $this->database = $config['database'];
        $this->username = $config['username'];
        $this->password = $config['password'];
    }


    public function connect() {
        try {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
            return $pdo;
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    public function executeUpdate($script, array $params = []) {
        $conn = $this->connect();
        $result = null;
        try {
            $stmt = $conn->prepare($script);

            $namedParams = [];
            if ($params) {
                foreach($params as $key => $value) {
                    $key = ':'. $key;
                    $namedParams[$key] = $value;
                }
            }
            $result = $stmt->execute($namedParams);
            if ($result) {
                $this->lastInsertId = $conn->lastInsertId();
            }
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
        $conn = null;
        return $result;
    }

    public function executeQuery($script, array $params = [], $fetchMethod = PDO::FETCH_ASSOC) {
        $conn = $this->connect();
        $returnValue = null;
        try {
            $stmt = $conn->prepare($script);

            $namedParams = [];
            if ($params) {
                foreach($params as $key => $value) {
                    $key = ':'. $key;
                    $namedParams[$key] = $value;
                }
            }

            $stmt->execute($namedParams);
            $returnValue = $stmt->fetchAll($fetchMethod);

        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
        $conn = null;
        return $returnValue;
    }
}