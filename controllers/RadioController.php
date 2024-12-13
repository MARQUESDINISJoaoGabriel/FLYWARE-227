<?php
class RadioController {
    public function index() {
        $model = new MessageModel();
        $messages = $model->getMessages();
        include 'views/radio.php';
    }
}