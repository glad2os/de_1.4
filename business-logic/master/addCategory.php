<?php
include_once __DIR__ . "/../Mysql.php";

class addCategory extends Mysql
{
    public function __construct()
    {
        try {
            $this->sql = parent::__construct();

        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    public function addCategory(string $category): int
    {
        try {
            $stmt = $this->prepare("insert into category (category) value (?)");
            $stmt->bind_param("s", $category);
            $stmt->execute();
            if ($stmt->errno != 0) throw new RuntimeException($stmt->error, $stmt->errno);
            $result = $stmt->insert_id;
            $stmt->close();
            return $result;
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }


    public function removeCategory(string $category): int
    {
        try {
            $stmt = $this->prepare("DELETE FROM category WHERE category = ?");
            $stmt->bind_param("s", $category);
            $stmt->execute();
            if ($stmt->errno != 0) throw new RuntimeException($stmt->error, $stmt->errno);
            $result = $stmt->insert_id;
            $stmt->close();
            return $result;
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }
}