<?php

/** AUTHENTICATION FUNCTION */

function getCurrentUserId()
{
    if (isset($_SESSION['login'])) {
        return $_SESSION['login'][0]->id;
    }
}

function isLoggedIn()
{
    return isset($_SESSION['login']) ? true : false;
}

function registry($name, $email, $pass)
{
    $password = password_hash($pass, PASSWORD_BCRYPT);
    global $db;
    $data = [
        'name' => $name,
        'email' => $email,
        'pass' => $password
    ];
    $sql = "INSERT INTO `users`(`name`, `email`, `pass`) VALUES (:name,:email,:pass)";
    $stmt = $db->prepare($sql);
    $stmt->execute($data);
    return $stmt->rowCount();
}

function passStrong($pass)
{
    $uppercase = preg_match('@[A-Z]@', $pass);
    $lowercase = preg_match('@[a-z]@', $pass);
    $number    = preg_match('@[0-9]@', $pass);

    if (!$uppercase || !$lowercase || !$number ||  strlen($pass) < 6) {
        warningMsg("پسورد باید بیشتراز 6 کاراکتر و دارایی حداقل یک حرف بزرگ یک عدد باشد");
        return false;
    }
    return true;
}
function userInfo($email)
{
    global $db;
    $sql = "SELECT * FROM `users` WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $user;
}

function checkEmail($email)
{
    global $db;
    $sql = "SELECT * FROM `users` WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetchAll(PDO::FETCH_OBJ);
    if (empty($user)) {
        return false;
    } else {
        return ($user[0]->email === $email) ? true : false;
    }
}



function login($email, $pass)
{
    if (checkEmail($email)) {
        $user = userInfo($email);
        if (password_verify($pass, $user[0]->pass)) {
            #user is logged
            successMsg("خوش آمدید");
            return true;
        } else {
            warningMsg('پسورد با ایمیل ثبت شده مطابقت ندارد');
        }
    } else {
        warningMsg('شما عضو نیستید.لطفا اول ثبت نام کنید.');
    }
}
