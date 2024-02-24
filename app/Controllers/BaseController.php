<?php
namespace App\Controllers;
class BaseController
{
    public function view($path, $data = [])
    {
        extract($data);
        include_once "./app/Views/$path.php";
    }
}
