<?php

/** MAIN */
include "bootstrap/init.php";



$user = $_SESSION['login'];
$folderTasks = [];
$folderName = '';

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'sign-out') {
        unset($_SESSION['login']);
    }
}

if (!isLoggedIn()) {
    reDirect("auth.php");
}




if (isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])) {
    deleteFolder($_GET['delete_folder']);
}
if (isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])) {
    deleteTask($_GET['delete_task']);
}
if (isset($_GET['name'])) {
    $folderName = $_GET['name'];
}

$folders = getFolders();
$tasks = getTasks();




include "tpl/tpl-index.php";
