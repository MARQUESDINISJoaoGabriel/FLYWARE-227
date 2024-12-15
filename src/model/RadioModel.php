<?php

namespace src\model;

class RadioModel {
    private $messages = [
        ["id" => 1, "title" => "A trouver.", "frequence" => "14.0"],
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
