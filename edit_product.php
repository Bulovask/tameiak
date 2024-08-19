<?php 
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_COOKIE['access_token']) && isset($_SESSION["token_list"][$_COOKIE["access_token"]])) {
    $usuario = $_SESSION["token_list"][$_COOKIE['access_token']];
    $usuario["time"] = time() + 1860;
    setcookie("access_token", $_COOKIE["access_token"], time() + 1830, "/tameiak", "", false, true);
}

if(isset($usuario) && $usuario["user-function"] == "2") {
    $page_title = "Editar Produto";
    $content = "contents/add_or_edit_product.php";
    $menu_type = "admin";
    
    include_once "view/template.php";
} else {
    header("Location: /tameiak/login.php");
    exit();
}
?>
