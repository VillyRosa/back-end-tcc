<?php

// Função que retornar o objeto final da requisição
function returnObject($obj) {
    echo json_encode($obj, JSON_PRETTY_PRINT);
    return;
}

// Função que limpa o valor recebido para ser enviado ao banco
function clearPost($dados){
    $dados = trim($dados);
    $dados = stripslashes($dados);
    $dados = htmlspecialchars($dados);
    return $dados;
}

// Função que verifica se a senha tem todos os requisitos
function verifyPassword($password) {
    if (strlen($password) < 6) return returnObject(['error' => true, 'msgErro' => 'A senha deve conter pelo menos 6 caracteres!']);
    return true;
}

// Função que verifica se a senha e repete senha são iguais
function verifyPasswordRepeat($password, $repeat) {
    if ($password === $repeat) return true;
    return false;
}

// Função que verifica se o email é válido
function verifyEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Função que verifica se a data de aniversário é válida;
function verifyBirthDate($birthDate) {

    if ( strlen($birthDate) === 10 ) {

        $day = '';
        $month = '';
        $year = '';

        for ($i = 0; $i < 10; $i++) {

            // Verificando se a posição não é o traço
            if ($birthDate[$i] !== '-') {

                if ($i < 5) {
                    $year = $year . $birthDate[$i];
                } else if ($i < 8) {
                    $month = $month . $birthDate[$i];
                } else {
                    $day = $day . $birthDate[$i];
                }

            }

        }

        if (!checkdate( intval($month), intval($day), intval($year) )) return returnObject(['error' => true, 'msgError' => 'A data precisa ser válida!']);

    } else return returnObject(['error' => true, 'msgError' => 'O formato de data esta incorreto! Formato correto: yyyy-mm-dd']);

    return true;

}

?>