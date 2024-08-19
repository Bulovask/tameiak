<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

$filename = "sem_funcao";

if(isset($_COOKIE['access_token']) && isset($_SESSION["token_list"][$_COOKIE['access_token']])) {
    $usuario = $_SESSION["token_list"][$_COOKIE['access_token']];
    $usuario["time"] = time() + 1860;
    setcookie("access_token", $_COOKIE["access_token"], time() + 1830, "/tameiak", "", false, true);
}

if(isset($usuario)) {
    switch ($usuario["user-function"]) {
        case '2':
            $filename = "admin.php";
            $menu_type = "admin";
            break;
        
        default:
            # code...
            break;
    }
    $page_title = "Tameiak System";
    $content = "contents/home/$filename";
    
    include_once "view/template.php";
} else {
    header("Location: /tameiak/login.php");
    exit();
}
