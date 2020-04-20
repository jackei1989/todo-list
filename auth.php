<?php
include "bootstrap/init.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $params = $_POST;
        $email = trim($_POST['email']);
        $pass = trim($_POST['password']);
        $action = $params['action'];
        if ($action === 'login') {
            if (login($email, $pass)) {
                $_SESSION['login'] = userInfo($email);
                reDirect("/todo/index.php");
            }
        }
        if ($action === 'registry') {
            $name = trim($params['name']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                warningMsg("ایمیل نا معتبر است");
            }
            if (checkEmail($email)) {
                warningMsg("این ایمیل قبلا ثبت شده است");
            }
            if (strlen($name) < 3) {
                warningMsg("نام شما باید بیشتر از 3 کارکتر باشد");
            }
            if(passStrong($pass)) {
                if(registry($name, $email, $pass)){
                    successMsg("ثبت نام شما با موفقیت انجام شد.برای استفاده از تسک منجیر وارد شوید");
                }
            }                        
        }
    }
}

include "tpl/tpl-auth.php";
