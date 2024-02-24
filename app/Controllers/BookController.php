<?php

namespace App\Controllers;

use App\Interfaces\BookInterface;
use App\Models\BookModel;
use App\Models\CategoryModel;

class BookController extends BaseController implements BookInterface
{

    public function index()
    {
        // TODO: Implement index() method.
        $books = BookModel::all();
        $message = $_COOKIE['message'] ?? "";
        return $this->view(
            "list",
            [
                "books" => $books,
                "message" => $message
            ]
        );
    }

    public function create()
    {
        // TODO: Implement create() method.
        $categories = CategoryModel::all();
        return $this->view(
            "add",
            ["categories" => $categories]
        );
    }

    public function store()
    {
        // TODO: Implement store() method.
        $data = $_POST;
        $file = $_FILES['anh'];
        // validate
        if (empty($data['tensach'])) {
            $errors['tensach'] = "Tên sách không được để trống";
        }

        if (empty($data['gia'])) {
            $errors['gia'] = "Giá sách không được để trống";
        } else if (!is_numeric($data['gia']) || $data['gia'] <= 0) {
            $errors['gia'] = "Giá sách phải là số";
        }

        if (empty($data['soluong'])) {
            $errors['soluong'] = "Giá sách không được để trống";
        } else if (!is_numeric($data['soluong']) || $data['soluong'] <= 0) {
            $errors['soluong'] = "Số lượng sách phải là số";
        }

        // validate email
        if (empty($data['email'])) {
            $errors['email'] = "Email không được để trống";
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email không đúng định dạng";
        }

        // valifate ảnh
        if ($file['size'] <= 0) {
            $errors['anh'] = "Ảnh sách không được để trống";
        } else {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $ext = strtolower($ext);
            if (!in_array($ext, ["jpg", "png", "jpeg", "gif"])) {
                $errors['anh'] = "Ảnh không đúng định dạng";
            }
        }

        if (empty($data['mota'])) {
            $errors['mota'] = "Mô tả sách không được để trống";
        }

        if (empty($data['maloai'])) {
            $errors['maloai'] = "Loại sách không được để trống";
        }

        if (isset($errors)) {
            $categories = CategoryModel::all();
            return $this->view(
                "add",
                [
                    "categories" => $categories,
                    "errors" => $errors,
                    "data" => $data
                ]
            );
        }

        $data['anh'] = $file['name'];
        move_uploaded_file($file['tmp_name'], "images/" . $file['name']);
        BookModel::insert($data);
        setcookie("message", "Thêm sách thành công", time() + 3);
        redirect("");


    }

    public function edit()
    {
        // TODO: Implement edit() method.
        $id = $_GET['id'] ?? "";
        $book = BookModel::find($id);
        $categories = CategoryModel::all();
        $message = $_COOKIE['message'] ?? "";
        return $this->view(
            "edit",
            [
                "book" => $book,
                "categories" => $categories,
                "message" => $message
            ]
        );
    }

    public function update()
    {
        // TODO: Implement update() method.
        $data = $_POST;
        $file = $_FILES['anh'];

        // validate
        if (empty($data['tensach'])) {
            $errors['tensach'] = "Tên sách không được để trống";
        }

        if (empty($data['gia'])) {
            $errors['gia'] = "Giá sách không được để trống";
        } else if (!is_numeric($data['gia']) || $data['gia'] <= 0) {
            $errors['gia'] = "Giá sách phải là số";
        }

        if (empty($data['soluong'])) {
            $errors['soluong'] = "Giá sách không được để trống";
        } else if (!is_numeric($data['soluong']) || $data['soluong'] <= 0) {
            $errors['soluong'] = "Số lượng sách phải là số";
        }

        // validate email
        if (empty($data['email'])) {
            $errors['email'] = "Email không được để trống";
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email không đúng định dạng";
        }

        // valifate ảnh
        if ($file['size'] > 0) {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $ext = strtolower($ext);
            if (!in_array($ext, ["jpg", "png", "jpeg", "gif"])) {
                $errors['anh'] = "Ảnh không đúng định dạng";
            }
            $data['anh'] = $file['name'];
        }

        if (empty($data['mota'])) {
            $errors['mota'] = "Mô tả sách không được để trống";
        }

        if (empty($data['maloai'])) {
            $errors['maloai'] = "Loại sách không được để trống";
        }

        if (isset($errors)) {
            $id = $_GET['id'] ?? "";
            $book = BookModel::find($id);
            $categories = CategoryModel::all();
            return $this->view(
                "edit",
                [
                    "book" => $book,
                    "categories" => $categories,
                    "errors" => $errors,
                    "data" => $data
                ]
            );
        }

        move_uploaded_file($file['tmp_name'], "images/" . $file['name']);
        BookModel::update($data['id'], $data);
        setcookie("message", "Sửa sách thành công", time() + 3);
        redirect("edit?id=" . $data['id']);
    }

    public function delete()
    {
        // TODO: Implement delete() method.

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            BookModel::delete($id);
            setcookie("message", "Xóa sách thành công", time() + 3);
            redirect("");
        }
    }
}
