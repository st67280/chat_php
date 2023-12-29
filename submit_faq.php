<?php
require_once 'FaqService.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$faqService = new FaqService();

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        echo json_encode($faqService->getAllFaqs());
        break;
    case "POST":
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data["action"])) {
            switch ($data["action"]) {
                case "add":
                    echo json_encode($faqService->addFaq($data));
                    break;
                case "update":
                    echo json_encode($faqService->updateFaq($data));
                    break;
                case "delete":
                    echo json_encode($faqService->deleteFaq($data));
                    break;
            }
        }
        break;
}
?>
