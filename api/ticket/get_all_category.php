<?php
header('Content-Type: application/json');

include_once __DIR__ . "/../../business-logic/category/getCategory.php";

try {
    $cat = new getCategory();
    print json_encode($cat->getCat());

} catch (RuntimeException $exception) {
    print json_encode(['error' => $exception->getMessage()]);
    http_response_code(400);
}