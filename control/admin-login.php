<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/ssm.bk/model/DAO/usuarioDAO.php";

$user_id = $_POST['user-id'];
$user_password = $_POST['user-password'];
$user_type = $_POST['user-type'];

if(isset($user_id, $user_password, $user_type)) {
    if($user_type == "admin") {
        //echo password_hash($user_password, PASSWORD_DEFAULT);
        echo UsuarioDAO::valid_login($user_id, $user_password);
    } else {
        echo "Só um administrador pode acessar a área administrativa";
    }
};