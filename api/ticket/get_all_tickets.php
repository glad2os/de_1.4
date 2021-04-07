<?php
header('Content-Type: application/json');

include_once __DIR__ . "/../../utils/User.php";
include_once __DIR__ . "/../../business-logic/ticket/getAll_tickets.php";
include_once __DIR__ . "/../../business-logic/user/getInfo.php";

try {
    $cat = new getAll_tickets();
    $getInfo = new getInfo();
    $user = $getInfo->getUser();
    print json_encode($cat->getAllNewTicketsByUserId($user->getId()));

} catch (RuntimeException $exception) {
    print json_encode(['error' => $exception->getMessage()]);
    http_response_code(400);
}