<?php

require_once("../configs/connection.php");
require_once("../configs/functions.php");

switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET':

        try {

            $sql = $pdo->prepare('SELECT * FROM posts');
            $sql->execute();

            return returnObject(['error' => false, 'qtd' => $sql->rowCount(), 'data' => $sql->fetchAll(PDO::FETCH_ASSOC)]);

        } catch (PDOException $e) {
            return returnObject(['error' => true, 'msgErro' => 'Erro ao se comunicar com o banco!']);
        }

    break;

    default:
        return returnObject(['error' => true, 'msgErro' => 'Requisição inválida!']);
    break;

}

?>