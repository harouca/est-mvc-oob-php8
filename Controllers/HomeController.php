<?php
// app/Controllers/HomeController.php

class HomeController {
    public function index() {
        echo "<h1>Bem-vindo ao seu site!</h1>";
    }

    public function teste() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT NOW() as agora");
        $row = $stmt->fetch();
        echo "Hora atual do servidor: " . $row['agora'];
    }
}
