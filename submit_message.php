<?php
require_once 'MessageService.php';

header("Content-Type: application/json");

$messageService = new MessageService();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    echo json_encode($messageService->getAllMessages());
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($messageService->addMessage($data));
}
?>



