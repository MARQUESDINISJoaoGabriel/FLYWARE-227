<?php

namespace src\controller;

use src\model\RadioModel;

class RadioController {
    public function list() {
        $model = new RadioModel();
        $messages = $model->getMessages();
        include __DIR__ . '/../view/radioList.php';
    }

    public function interface() {
        $model = new RadioModel();
        include __DIR__ . '/../view/radioInterface.php';
    }
    

    public function message() {
        $model = new RadioModel();
        $id = $_GET['id'] ?? null;
        if ($id !== null) {
            $message = $model->getMessageById($id);
            if ($message) {
                include __DIR__ . '/../view/radioMessage.php';
            } else {
                echo "Message introuvable.";
            }
        } else {
            echo "ID non fourni.";
        }
    }
}
