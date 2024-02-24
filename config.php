<?php
const ROOT_PATH = "http://localhost/fpoly/exam/thithu_02/";
const ROOT_URI = "/fpoly/exam/thithu_02/";

//hàm dd dùng để bug
function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die;
}

//Hàm chuyển hướng website
function redirect($route)
{
    header("location:" . ROOT_PATH . $route);
    die;
}
