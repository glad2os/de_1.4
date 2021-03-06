<?php
header('Content-Type: application/json');
include_once __DIR__ . "/../../exceptions/AccessForbidden.php";
include_once __DIR__ . "/../../exceptions/MovingFileEx.php";
include_once __DIR__ . "/../../utils/User.php";
include_once __DIR__ . "/../../business-logic/user/getInfo.php";
include_once __DIR__ . "/../../business-logic/ticket/create_ticket.php";

$content = file_get_contents('php://input');
try {
    if (!isset($_COOKIE['token'])) throw new AccessForbidden("Вы не вошли в систему!");

    $user = new getInfo();

    $currentUser = $user->getUser();

    if (isset($_FILES['file'])) {
        $check = getimagesize($_FILES['file']['tmp_name']);
        if ($check !== false && ($check["mime"] == "image/png" || $check["mime"] == "image/jpeg")) {

            $upload_file_path = __DIR__ . "/../../uploads/" . basename($_FILES['file']['name']);

            if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file_path)) {

                new create_ticket($currentUser->getId(),
                    $_POST['building_address'], $_POST['description'],
                    $_POST['category'], $_POST['max_price'],
                    "/uploads/" . basename($_FILES['file']['name']), "Новая");
                print json_encode("done");
            } else {
                throw new MovingFileEx('Ошибка перемещения файла');
            }
        } else {
            throw new MovingFileEx('Файл не картинка jpeg или png');
        }
    }
} catch (MovingFileEx $exception) {
    print json_encode(['error' => $exception->getMessage()]);
    http_response_code(400);
} catch (AccessForbidden $exception) {
    print json_encode(['error' => $exception->getMessage()]);
    http_response_code(403);
} catch (RuntimeException $exception) {
    print json_encode(['error' => $exception->getMessage()]);
    http_response_code(400);
}
