<?php
include_once __DIR__ . "/../../utils/User.php";
include_once __DIR__ . "/../../business-logic/user/getInfo.php";
include_once __DIR__ . "/../../business-logic/master/addCategory.php";
include_once __DIR__ . "/../../exceptions/AccessForbidden.php";

header('Content-Type: application/json');
$request = json_decode(file_get_contents("php://input"), true);


try {
    if (empty($_COOKIE['token'])) throw new RuntimeException(json_encode(['error' => "Не задан токен"]));
    $getInfo = new getInfo();
    $user = $getInfo->getUser();

    if ($user->getUserType() !== 3) throw new RuntimeException('Не разрешено');

    $category = $request['category'];

    if (!isset($category) || empty($category)) throw new RuntimeException('Нет категории');

    $categoryClass = new addCategory();

    if ($request['action'] == "add") {
        $categoryClass->addCategory($category);
    }
    if ($request['action'] == "remove") {
        $categoryClass->removeCategory($category);
    }

    print json_encode('done');
    http_response_code(200);

} catch (RuntimeException $exception) {
    print json_encode(['error' => $exception->getMessage()]);
    http_response_code(403);
}