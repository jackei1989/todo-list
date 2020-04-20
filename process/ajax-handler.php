<?php
include "../bootstrap/init.php";
if (!ajaxRequestChecker()) {
    echo "Ops!Invalid Request";
    die();
}

$action = $_POST['action'];
if (!empty($action && strlen($action) > 2)) {
    switch ($action) {
        case "addFolder":
            $folderName = $_POST['folderName'];
            if (empty($folderName)) {
                warningMsg("لطفا نام فولدر را وارد کنید");
            } elseif (strlen($folderName) < 3) {
                warningMsg("نام فولدر باید صحیح و بیشتر از سه حرف باشد");
            } else {
                addFolder($folderName);
            }
            break;
        case "addTask":
            $taskTitle = $_POST['taskTitle'];
            $folderId = $_POST['folderId'];
            if (empty($taskTitle)) {
                warningMsg("لطفا نام تسک را وارد کنید");
            } elseif (strlen($taskTitle) < 3) {
                warningMsg("نام تسک باید صحیح و بیشتر از سه حرف باشد");
            } elseif (empty($folderId)) {
                warningMsg("فولدر باید انتخاب شود");
            } elseif (!is_numeric($folderId)) {
                warningMsg("فولدر باید انتخاب شود");
            } else {
                addTask($taskTitle, $folderId);
            }
            break;
        case "done":
            $taskId = $_POST['taskId'];
            if (empty($taskId)) {
                warningMsg("تسک آیدی خالی است");
            } else {
                doneSwitch($taskId);
            }
            break;
        default:
            warningMsg('اکشن تعریف نشده است');
    }
} else {
    warningMsg('لطفا نام فولدر را با دقت وارد کنید');
}
