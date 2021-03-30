<?php


class Mysql extends mysqli
{
    public function __construct($hostname = null, $username = null, $password = null, $database = null, $port = null, $socket = null)
    {
        parent::__construct("localhost", "root", "", "db", $port, $socket);
        $this->set_charset("utf8");
    }
}