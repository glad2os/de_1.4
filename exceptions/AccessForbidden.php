<?php


class AccessForbidden extends RuntimeException
{

    protected $code = 403;

    /**
     * AccessForbidden constructor.
     * @param string $message
     */
    public function __construct(string $message = "Логин или пароль неверный")
    {
        $this->message = $message;
    }
}
