<?php


class MovingFileEx extends RuntimeException
{
    protected $message = "";
    protected $code = 403;

    public function __construct(string $message = "Логин или пароль неверный")
    {
        $this->message = $message;
    }
}