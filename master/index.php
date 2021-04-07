<?php
include_once __DIR__ . "/../utils/User.php";
include_once __DIR__ . "/../business-logic/user/getInfo.php";

try {
    if (!isset($_COOKIE['token'])) header("Location: /signin");
    $userInfo = new  getInfo();
    $user = $userInfo->getUser();
    if ($user->getUserType() != 3) throw new RuntimeException('Нет права доступа');

    print file_get_contents(__DIR__ . "/../templates/master.html");

} catch (RuntimeException $exception) {
    die($exception->getMessage());
}