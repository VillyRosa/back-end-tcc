<?php

require_once("../configs/connection.php");
require_once("../configs/functions.php");

$body = json_decode(file_get_contents('php://input'), true);

switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET':

        if (isset($_GET['userid'])) {

            try {

                $userid = clearPost($_GET['userid']);

                $sql = $pdo->prepare('SELECT * FROM usuarios WHERE id_usuario=?');
                $sql->execute([ $userid ]);

                return returnObject(['error' => false, 'qtd' => $sql->rowCount(), 'data' => $sql->fetchAll(PDO::FETCH_ASSOC)]);

            } catch (PDOException $e) {
                return returnObject(['error' => true, 'msgErro' => 'Erro ao se comunicar com o banco!']);
            }

        } else {

            try {

                $username = isset($body['username']) ? clearPost($_GET['username']) : '';
                $useremail = isset($body['username']) ? clearPost($_GET['useremail']) : '';
                $userbirthdate = isset($body['username']) ? clearPost($_GET['userbirthdate']) : '';
    
                $sql = $pdo->prepare('SELECT * FROM usuarios WHERE LOCATE(?, nome_usuario) AND LOCATE(?, email_usuario) AND LOCATE(?, dataNascimento_usuario)');
                $sql->execute([ $username, $useremail, $userbirthdate ]);
    
                return returnObject(['error' => false, 'qtd' => $sql->rowCount(), 'data' => $sql->fetchAll(PDO::FETCH_ASSOC)]);
    
            } catch (PDOException $e) {
                return returnObject(['error' => true, 'msgErro' => 'Erro ao se comunicar com o banco!' . $e]);
            }

        }   

    break;
    
    case 'POST':

        if ( !isset($body['useremail']) || !isset($body['userpassword']) || !isset($body['userpasswordrepeat']) ) return returnObject(['error' => true, 'msgErro' => 'Dados faltando!']);

        if (!verifyEmail($body['useremail'])) return returnObject(['error' => true, 'msgErro' => 'Insira um email válido!']);

        if (verifyPassword($body['userpassword']) !== true) return;

        if (!verifyPasswordRepeat($body['userpassword'], $body['userpasswordrepeat'])) return returnObject(['error' => true, 'msgErro' => 'As senhas não conferem!']);

        $useremail = clearPost($body['useremail']);        
        $userpassword = sha1(clearPost($body['userpassword']));        

        try {

            $sql = $pdo->prepare('INSERT INTO usuarios (id_usuario, email_usuario, senha_usuario) VALUES (null, ?, ?)');
            $sql->execute([ $useremail, $userpassword ]);

            return returnObject(['error' => false, 'msgErro' => 'Usuário cadastrado com sucesso!']);

        } catch (PDOException $e) {
            return returnObject(['error' => true, 'msgErro' => 'Erro ao se comunicar com o banco!']);
        }

    break;

    case 'PUT':

        if (!isset($body['userid'])) return returnObject(['error' => true, 'msgErro' => 'Id do usuário faltando!']);
        if (isset($body['userpassword']) && !isset($body['userpasswordrepeat'])) return returnObject(['error' => true, 'msgErro' => 'Campo repete senha faltando!']);
        if (isset($body['userpasswordrepeat'])) if (!verifyPasswordRepeat($body['userpassword'], $body['userpasswordrepeat'])) return returnObject(['error' => true, 'msgErro' => 'As senhas não conferem!']);
        if (!verifyEmail($body['useremail'])) return returnObject(['error' => true, 'msgErro' => 'Insira um email válido!']);
        if (verifyBirthDate($body['userbirthdate']) !== true) return;

        $userid = clearPost($body['userid']);

        $json = file_get_contents("http://localhost/tcc/back-end/routes/user/user.php?userid=$userid");
        $convert = json_decode($json, true);

        if (count($convert['data']) === 0) return returnObject(['error' => true, 'msgErro' => 'Usuário com o id ' . $userid . ' não encontrado!']);
        $userdata = $convert['data'][0];

        $username = $body['username'] ?? $userdata['nome_usuario'];
        $useremail = $body['useremail'] ?? $userdata['email_usuario'];
        $userpassword = isset($body['userpassword']) ? sha1($body['userpassword']) : $userdata['senha_usuario'];
        $userbirthdate = $body['userbirthdate'] ?? $userdata['dataNascimento_usuario'];
        $userphoto = $body['userphoto'] ?? $userdata['foto_usuario'];

        try {

            $sql = $pdo->prepare("UPDATE usuarios SET nome_usuario=?, email_usuario=?, senha_usuario=?, dataNascimento_usuario=?, foto_usuario=? WHERE id_usuario=?");
            $sql->execute([clearPost($username), clearPost($useremail), clearPost($userpassword), clearPost($userbirthdate), clearPost($userphoto), $userid]);

            return returnObject(['error' => false, 'message' => 'Usuário com o id ' . $userid . ' alterado com sucesso!']);

        } catch (PDOException $e) {
            return returnObject(['error' => true, 'msgErro' => 'Erro ao se comunicar com o banco!']);
        }

    break;

    case 'DELETE':
        
        if (!isset($body['userid'])) return returnObject(['error' => true, 'msgErro' => 'Faltando o id do usuário!']);
    
        try {

            $userid = clearPost($body['userid']);

            $sql = $pdo->prepare('DELETE FROM usuarios WHERE id_usuario=?');
            $sql->execute([ $userid ]);

            return returnObject(['error' => false, 'message' => 'Usuário com id ' . $userid . ' excluído com sucesso!']);

        } catch (PDOException $e) {
            return returnObject(['error' => true, 'msgErro' => 'Erro ao se comunicar com o banco!']);
        }

    break;

    default:
        return returnObject(['error' => true, 'msgErro' => 'Requisição inválida!']);
    break;

}

?>