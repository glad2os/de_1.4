<?php


class AccessForbidden extends RuntimeException
{
    protected $message = "Логин или пароль неверный";
    protected $code = 403;
}
