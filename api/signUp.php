<?php
/*
 * API
 */
include_once __DIR__ . "/../utils/User.php";
include_once __DIR__ . "/../business-logic/signUp.php";

header('Content-Type: application/json');
$request = json_decode(file_get_contents("php://input"), true);
if (empty($request)) die(json_encode([]));
$user = new User();
$user->setEmail($request['email']);
$user->setFio($request['fio']);
$user->setLogin($request['login']);
$user->setPasswd($request['passwd']);
try {
    new signUp($user);
    http_response_code(204);
} catch (RuntimeException $exception) {
    print $exception->getMessage();
    http_response_code(403);
}