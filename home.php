<?php
session_start();
$filename = "sem_funcao";

if(isset($_COOKIE['access_token']) && $_SESSION["token_list"][$_COOKIE['access_token']]) {
    $usuario = $_SESSION["token_list"][$_COOKIE['access_token']];
    switch ($usuario["user-function"]) {
        case '2':
            $filename = "admin";
            break;
        
        default:
            # code...
            break;
    }
}


$page_title = "Tameiak System";
$content = "contents/home/$filename.html";

include_once "view/template.php";
?>
