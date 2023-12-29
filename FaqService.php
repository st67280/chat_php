<?php
class FaqService {
    private $filePath = "faq.json";

    public function getAllFaqs() {
        return json_decode(file_get_contents($this->filePath), true);
    }

    public function addFaq($data) {
        $allFaqs = $this->getAllFaqs();
        $faqs = $allFaqs['faq'] ?? [];

        if (isset($data["question"]) && isset($data["answer"])) {
            $faqs[] = [
                "question" => $data["question"],
                "answer" => $data["answer"]
            ];
            $allFaqs['faq'] = $faqs;
            file_put_contents($this->filePath, json_encode($allFaqs, JSON_PRETTY_PRINT));
            return ["success" => true];
        } else {
            return ["success" => false];
        }
    }


    public function updateFaq($data) {
        $allFaqs = $this->getAllFaqs();
        $faqs = $allFaqs['faq'] ?? [];

        if (isset($data["id"]) && isset($faqs[$data["id"]])) {
            $faqs[$data["id"]] = [
                "question" => $data["question"] ?? $faqs[$data["id"]]["question"],
                "answer" => $data["answer"] ?? $faqs[$data["id"]]["answer"]
            ];
            $allFaqs['faq'] = $faqs;
            file_put_contents($this->filePath, json_encode($allFaqs, JSON_PRETTY_PRINT));
            return ["success" => true];
        } else {
            return ["success" => false];
        }
    }

    public function deleteFaq($data) {
        $allFaqs = $this->getAllFaqs();
        $faqs = $allFaqs['faq'] ?? [];

        if (isset($data["id"]) && isset($faqs[$data["id"]])) {
            array_splice($faqs, $data["id"], 1);
            $allFaqs['faq'] = $faqs;
            file_put_contents($this->filePath, json_encode($allFaqs, JSON_PRETTY_PRINT));
            return ["success" => true];
        } else {
            return ["success" => false];
        }
    }

}
?>
