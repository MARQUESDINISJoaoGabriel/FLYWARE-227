<?php

namespace src\model;

class RadioModel {
    private $messages = [
        ["id" => 1, "title" => "Signal perdu", "content" => "Un message mystérieux trouvé sur les ondes."],
        ["id" => 2, "title" => "Alerte tempête", "content" => "Une tempête approche du secteur 5."],
    ];

    public function getMessages() {
        return $this->messages;
    }

    public function getMessageById($id) {
        foreach ($this->messages as $message) {
            if ($message['id'] == $id) {
                return $message;
            }
        }
        return null;
    }
}
