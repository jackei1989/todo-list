<?php
include "../bootstrap/init.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $params = $_POST;
        if (isset($params['action'])) {
            $email = trim($_POST['email']);
            $pass = trim($_POST['password']);
            if($params['action'] === 'login') {
                if(login($email, $pass)) {
                    $_SESSION['login'] = userInfo($email);
                    reDirect("/todo/index.php");
                }
            } else {
                echo "registry";
            }
            // switch ($params['action']) {                
            //     case 'login':
                   
            //         break;
            //     case 'registry':
            //         $name = trim($_POST['name']);
            //         if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            //             warningMsg("ایمیل نا معتبر است");
            //         if (checkEmail($email))
            //             warningMsg("این ایمیل قبلا ثبت شده است");
            //         if (!preg_match("/^[a-zA-Z ]*$/", $name))
            //             warningMsg("نام شما باید بیشتر از 3 کارکتر باشد");
            //         passStrong($pass);
            //         if (registry($name, $email, $pass))
            //             successMsg("ثبت نام شما با موفقیت انجام شد.برای استفاده از تسک منجیر وارد شوید");
            //         break;
            // }
        }
    }
}