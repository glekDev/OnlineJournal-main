<?php

$host = '109.235.184.198'; 
$dbname = 'ChernikovD_bd'; 
$username = 'ChernikovD';
$password = 'NmU0YThiNjYz';

try {
    // Создаем новое подключение к базе данных
    $pdo = new PDO("mysql:host=$host;port=63306;dbname=$dbname", $username, $password);
    
    // Устанавливаем режим отображения ошибок PDO на исключения
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}