<?php

namespace App\Models;

use PDO;

class BaseModel
{


    protected $conn = null;
    protected $tableName;
    protected $sqlBuilder;
    protected $primailder = 'id';

    public function __construct()
    {
        $host = HOSTNAME;
        $dbname = DBNAME;
        $username = USERNAME;
        $password = PASSWORD;

        try {
            $this->conn = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo "Lỗi kết nối dữ liệu: " . $e->getMessage();
        }
    }

    public static function all()
    {
        $model = new static();
        $model->sqlBuilder = "SELECT * FROM $model->tableName";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public static function find($id)
    {
        $model = new static();
        $model->sqlBuilder = "SELECT * FROM $model->tableName WHERE $model->primailder=:$model->primailder";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = ["$model->primailder" => $id];
        $stmt->execute($data);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        //Trong trường hợp có dữ liệu
        if ($result) {
            return $result[0];
        }
        return $result;
    }

    public static function insert($data)
    {
        $model = new static();
        $model->sqlBuilder = "INSERT INTO $model->tableName( ";

        //Biến values để nối các tham số cho value
        $values = "";
        foreach ($data as $column => $value) {
            $model->sqlBuilder .= "`{$column}`, ";
            $values .= ":$column, ";
        }
        //thực loại bỏ dấu ", " ở bên phải chuỗi bằng hàm rtrim
        $model->sqlBuilder = rtrim($model->sqlBuilder, ", ") . ") ";
        $values = "VALUES( " . rtrim($values, ", ") . ")";
        //Nối chuỗi sqlbuilder với values
        $model->sqlBuilder .= $values;

        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->execute($data);
        //trả lại giá trị id mới nhất
        return $model->conn->lastInsertId();
    }

    public static function update($id, $data)
    {
        $model = new static();
        $model->sqlBuilder = "UPDATE $model->tableName SET ";
        foreach ($data as $column => $value) {
            $model->sqlBuilder .= "`{$column}`=:$column, ";
        }
        //Xóa dấu ", " ở cuối chuỗi
        $model->sqlBuilder = rtrim($model->sqlBuilder, ", ");
        //Thêm điều kiện cho câu lệnh SQL
        $model->sqlBuilder .= " WHERE `$model->primailder`=:$model->primailder";

        $stmt = $model->conn->prepare($model->sqlBuilder);
        //Thêm $id vào $data
        $data["$model->primailder"] = $id;
        return $stmt->execute($data);
    }

    /**
     * method delete: để xóa dữ liệu theo id
     */
    public static function delete($id)
    {
        $model = new static();
        $model->sqlBuilder = "DELETE FROM $model->tableName WHERE `$model->primailder`=:$model->primailder";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        return $stmt->execute(["$model->primailder" => $id]);
    }
}