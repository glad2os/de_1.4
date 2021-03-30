<?php


class NotFoundEx extends RuntimeException
{
    protected $message = "Страница не обнаружена";
    protected $code = 404;
}