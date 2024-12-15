<?php
require_once __DIR__ . '/../model/RadioModel.php';

class RadioController {
    private $model;

    public function __construct() {
        $this->model = new RadioModel();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'], $_POST['frequency'])) {
            $this->model->addLog($_POST['frequency'], $_POST['message']);
        }
        $this->showRadioPage();
    }

    public function showRadioPage() {
        require 'view/radioInterface.php';
    }

    public function showLogbook() {
        $logs = $this->model->getLogs();
        require 'view/radioList.php';
    }

    public function clearLogbook() {
        $this->model->clearLogs();
        $this->showLogbook();
    }
}
?>