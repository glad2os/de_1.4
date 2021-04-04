<?php
/*
 * API
 */

include_once __DIR__ . "/../../utils/User.php";
include_once __DIR__ . "/../../business-logic/user/getInfo.php";
include_once __DIR__ . "/../../exceptions/AccessForbidden.php";

header('Content-Type: application/json');
$request = json_decode(file_get_contents("php://input"), true);


try {
    if (empty($_COOKIE['token'])) throw new RuntimeException(json_encode(['error' => "Не задан токен"]));
    $getInfo = new getInfo();
    $user = $getInfo->getUser();

    switch ($request['get']) {
        case "id":
            print json_encode(['user' => $user->getId()]);
            break;
        case 'fio':
            print json_encode(['user' => $user->getFio()]);
            break;
        case "email":
            print json_encode(['user' => $user->getEmail()]);
            break;
        case 'login':
            print json_encode(['user' => $user->getLogin()]);
            break;
        default:
            print json_encode([]);
            break;
    }

    http_response_code(200);
} catch (RuntimeException $exception) {
    print json_encode(['error' => $exception->getMessage()]);
    http_response_code(403);
}