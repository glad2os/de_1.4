<?php
/*
 * API
 */
include_once __DIR__ . "/../utils/User.php";
include_once __DIR__ . "/../business-logic/signIn.php";

header('Content-Type: application/json');
$request = json_decode(file_get_contents("php://input"), true);

if (empty($request)) die(json_encode([]));

$user = new User();
$user->setLogin($request['login']);
$user->setPasswd($request['passwd']);

try {
    $signIn = new signIn($user);
    http_response_code(200);
} catch (RuntimeException $exception) {
    http_response_code(403);
    print($exception->getMessage());
}
