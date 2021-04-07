<?php

include_once __DIR__ . "/../Mysql.php";

class getCategory extends Mysql
{
    private $cat;

    /**
     * @return mixed
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * @param mixed $cat
     */
    public function setCat($cat): void
    {
        $this->cat = $cat;
    }


    public function __construct()
    {
        try {
            $this->sql = parent::__construct();
            $this->setCat($this->getAllCat());

        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    private function getAllCat()
    {
        try {
            $stmt = $this->prepare("select * from category");
            $stmt->execute();
            if ($stmt->errno != 0) throw new RuntimeException($stmt->error, $stmt->errno);
            $result = $stmt->get_result()->fetch_all();
            $stmt->close();
            return $result;
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }
}