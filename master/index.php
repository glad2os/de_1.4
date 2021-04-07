<?php
include_once __DIR__ . "/../utils/User.php";
include_once __DIR__ . "/../business-logic/user/getInfo.php";

try {
    $userInfo = new  getInfo();
    $user = $userInfo->getUser();
    if ($user->getUserType() != 3) throw new RuntimeException('Нет права доступа');
} catch (RuntimeException $exception) {
    die($exception->getMessage());
}