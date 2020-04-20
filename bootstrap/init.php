<?php

/** INIT */

include "C:/xampp/htdocs/php.expert/todo/bootstrap/constants.php";
include BASE_PATH . "/bootstrap/config.php";
include BASE_PATH . "/libs/helpers.php";
session_start();
# connection to db
$dsn = "mysql:dbname={$dataBase->dbname};host={$dataBase->host}";

try {
    $db = new PDO($dsn, $dataBase->user, $dataBase->password);
} catch (PDOException $e) {
    warningMsg('Connection failed: ' . $e->getMessage());
}

// echo "connection is ok!";
// include BASE_PATH . "/process/ajax-handler.php";

include BASE_PATH . "/libs/lib-auth.php";
include BASE_PATH . "/libs/lib-tasks.php";
include BASE_PATH . "/vendor/autoload.php";
