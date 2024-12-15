<?php
class RadioModel {
    private $logFile;

    public function __construct($logFile = '../../logbook.txt') {
        $this->logFile = $logFile;
    }

    public function getLogs() {
        return file_exists($this->logFile) ? file($this->logFile) : [];
    }

    public function addLog($frequency, $message) {
        $timestamp = date('Y-m-d H:i:s');
        $entry = "[$timestamp] Fréquence : $frequency MHz - Message : $message" . PHP_EOL;
        file_put_contents($this->logFile, $entry, FILE_APPEND);
    }

    public function clearLogs() {
        file_put_contents($this->logFile, '');
    }
}
?>
