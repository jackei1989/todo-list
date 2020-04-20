<?php 
/** UTILITY FUNCTION */
// print msg
function warningMsg(string $msg)
 {
    echo "<div data=error style='padding: 20px; background-color: #e74c3c; border: 1px solid #c53324a6; border-radius: 5px; text-align: center; margin: 9px auto;width: 60%;font-family: isans; font-size: 17px;'>{$msg}</div>";
}

function successMsg(string $msg)
{
    echo "<div data=success style='padding: 20px; background-color: #4CAF50; border: 1px solid #8BC34A; border-radius: 5px; text-align: center; margin: 9px auto;width: 60%;font-family: isans; font-size: 17px;'>{$msg}</div>";
}

function ajaxRequestChecker() 
{
    if (!empty($_SERVER["CONTENT_TYPE"])) {
        return true;
    } else {
        return false;
    }   
}

function dd(array $array) 
{
    echo "<pre style='position: relative; z-index: 9999; background: white; margin: 20px; padding: 15px; border-left: 5px solid #d88340; color: #884614; border-radius: 5px;'>";
    var_dump($array);
    echo "</pre>";
}

function siteUrl(string $uri='') {
    echo BASE_URL . $uri ;
}

function reDirect(string $uri = '')
{
    return header("Location: $uri");
}