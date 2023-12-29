<?php
class MessageService {
    private $filePath = "messages.json";

    public function getAllMessages() {
        return json_decode(file_get_contents($this->filePath), true);
    }

    public function addMessage($data) {
        $messages = $this->getAllMessages();
        $data["message"] = $this->filterProfanity($data["message"]);
        if ($this->isValidMessage($data)) {
            $messages[] = $data;
            file_put_contents($this->filePath, json_encode($messages, JSON_PRETTY_PRINT));
            return ["success" => true];
        } else {
            return ["success" => false];
        }
    }

    public function deleteMessage($data) {
        $messages = $this->getAllMessages();
        if (isset($data["id"]) && isset($messages[$data["id"]])) {
            array_splice($messages, $data["id"], 1);
            file_put_contents($this->filePath, json_encode($messages, JSON_PRETTY_PRINT));
            return ["success" => true];
        } else {
            return ["success" => false];
        }
    }

    private function isValidMessage($data) {
        return isset($data["name"]) && isset($data["email"]) && isset($data["message"]);
    }

    private function filterProfanity($text) {
        $profanityWords = ['fuck', 'dick', 'asshole', 'motherfucker', 'bitch', 'retard', 'shit', 'cock', 'wtf', 'nahui', 'kurwa', 'pizda'];
        return str_replace($profanityWords, '*****', $text);
    }
}
?>
