<?php
include_once __DIR__ . "/../Mysql.php";

class create_ticket extends Mysql
{
    /**
     * create_ticket constructor.
     * @param $user_id
     * @param $building_address
     * @param $description
     * @param $category_id
     * @param $max_price
     * @param $img_path
     * @param $status
     */
    public function __construct($user_id, $building_address,
                                $description, $category,
                                $max_price, $img_path,
                                $status)
    {
        try {
            parent::__construct();

            $categoryId = $this->getCategoryId($category);

            $this->addTicket($user_id, $building_address,
                $description, $categoryId,
                $max_price, $img_path,
                $status);

        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    public function getCategoryId(string $category): int
    {
        try {
            $stmt = $this->prepare("SELECT id FROM category WHERE category = ?");
            $stmt->bind_param("s", $category);
            $stmt->execute();
            if ($stmt->errno != 0) throw new RuntimeException($stmt->error, $stmt->errno);
            $result = $stmt->get_result()->fetch_array(MYSQLI_NUM)[0];
            $stmt->close();
            return $result;
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    public function addTicket($user_id, $building_address,
                              $description, $category,
                              $max_price, $img_path,
                              $status): int
    {
        try {

            $stmt = $this->prepare("INSERT INTO tickets (user_id, building_address, description, category_id, max_price, img_path, status) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param("issiiss", $user_id, $building_address, $description, $category, $max_price, $img_path, $status);
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