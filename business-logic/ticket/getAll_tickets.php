<?php
include_once __DIR__ . "/../Mysql.php";

class getAll_tickets extends Mysql
{
    public function __construct()
    {
        try {
            parent::__construct();
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    public function getAllTickets()
    {
        try {
            $stmt = $this->prepare("select * from tickets");
            $stmt->execute();
            if ($stmt->errno != 0) throw new RuntimeException($stmt->error, $stmt->errno);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $result;
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    public function getAllTicketsByUserId($user_id)
    {
        try {
            $stmt = $this->prepare("select * from tickets where user_id = ?");
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            if ($stmt->errno != 0) throw new RuntimeException($stmt->error, $stmt->errno);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $result;
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    public function getAllNewTickets()
    {
        try {
            $stmt = $this->prepare("select * from tickets where status = \"Новая\"");
            $stmt->execute();
            if ($stmt->errno != 0) throw new RuntimeException($stmt->error, $stmt->errno);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $result;
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    public function getAllNewTicketsByUserId($user_id)
    {
        try {
            $stmt = $this->prepare("SELECT ticket_id, building_address, description, max_price,img_path, category, time FROM `tickets` inner JOIN category c on category_id = c.id where status = \"Новая\"  and user_id = ?");
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            if ($stmt->errno != 0) throw new RuntimeException($stmt->error, $stmt->errno);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $result;
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }
}