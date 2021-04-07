<?php

class removeTicket extends Mysql
{
    public function __construct($id)
    {
        try {
            parent::__construct();
            $this->removeTicket($id);
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    public function removeTicket($id)
    {
        try {
            $stmt = $this->prepare("DELETE FROM `tickets` WHERE `ticket_id` = (?)");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            if ($stmt->errno != 0) throw new RuntimeException($stmt->error, $stmt->errno);
            $stmt->close();
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }
}