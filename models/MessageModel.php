<?php
class MessageModel {
    private $db;

    public function __construct() {
        $config = include 'config/database.php';
        $this->db = new PDO("mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}", $config['user'], $config['pass']);
    }

    public function getMessages() {
        $stmt = $this->db->query("SELECT * FROM messages");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}