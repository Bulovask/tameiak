<?php
function login($user) {
    if($user['id'] != "" && $user['password'] != "" && $user['type'] != "") {
        if(UsuarioDAO::get_user($user["id"], $user["password"], $user["type"] == "admin")) {
            echo json_encode(array(
                'data'=> Tokens::newToken($user),
                'err' => false
            ));
        }
        else {
            echo json_encode(array(
                'data' => "Identificação ou senha inválido(a)!",
                'err' => true
            ));
        }
    } else {
        echo json_encode(array(
            'data' => "preencha todos os campos",
            'err' => true
        ));
    }
}

