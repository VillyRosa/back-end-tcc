<?php

require_once("../configs/connection.php");
require_once("../configs/functions.php");

switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET':

        try {

            $sql = $pdo->prepare('SELECT * FROM posts');
            $sql->execute();

            $data = [];
            
            foreach ($sql->fetchAll(PDO::FETCH_ASSOC) as $line) {
                $userid = $line['id_usuario'];
                $json = file_get_contents("http://localhost/tcc/back-end/routes/user/user.php?userid=$userid");
                $convert = json_decode($json, true);
                array_push($data, [
                    'id_post' => $line['id_post'],
                    'conteudo_post' => $line['conteudo_post'],
                    'datahora_post' => $line['datahora_post'],
                    'curtidas_post' => $line['curtidas_post'],
                    'user_post' => $convert['data'][0]
                ]);
            }

            return returnObject(['error' => false, 'qtd' => $sql->rowCount(), 'data' => $data]);

        } catch (PDOException $e) {
            return returnObject(['error' => true, 'msgErro' => 'Erro ao se comunicar com o banco!']);
        }

    break;

    default:
        return returnObject(['error' => true, 'msgErro' => 'Requisição inválida!']);
    break;

}

?>