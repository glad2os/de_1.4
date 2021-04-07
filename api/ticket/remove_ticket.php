<?php
header('Content-Type: application/json');

include_once __DIR__ . "/../../utils/User.php";
include_once __DIR__ . "/../../business-logic/user/getInfo.php";
include_once __DIR__ . "/../../business-logic/ticket/removeTicket.php";

$request = json_decode(file_get_contents("php://input"), true);

try {
    new removeTicket($request['id']);
} catch (RuntimeException $exception) {
    print json_encode(['error' => $exception->getMessage()]);
    http_response_code(403);
}