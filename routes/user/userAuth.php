<?php

require_once("../configs/connection.php");
require_once("../configs/functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $body = json_decode(file_get_contents('php://input'), true);

    if (isset($body['useremail']) && isset($body['userpassword'])){

        $useremail = clearPost($body['useremail']);
        $userpassword = clearPost($body['userpassword']);

        try {

            $sql = $pdo->prepare('SELECT * FROM usuarios WHERE email_usuario=? AND senha_usuario=?');
            $sql->execute([ $useremail, sha1($userpassword) ]);

            return returnObject(['error' => false, 'data' => $sql->fetch(PDO::FETCH_ASSOC)]);

        } catch (PDOException $e) {
            return returnObject(['error' => true, 'msgError' => 'Erro ao se comunicar com o banco!']);
        }
        
    } else return returnObject(['error' => true, 'msgError' => 'Informações faltando!']);

} else return returnObject(['error' => true, 'msgError' => 'Requisição inválida!']);

?>