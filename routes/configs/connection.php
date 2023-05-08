<?php

header('Content-Type: application/json'); 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$host = 'localhost';
$dbname = 'tcc';
$username = 'root';
$password = '';

try {
    $pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['error' => true, 'msgError' => 'Erro ao se conectar ao banco!']);
}

?>