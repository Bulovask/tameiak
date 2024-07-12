<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ssm.bk/control/token.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ssm.bk/model/DAO/usuarioDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ssm.bk/control/login.php";

$user_id       = $_POST["user-id"];
$user_password = $_POST["user-password"];
$user_type     = $_POST["user-type"];

login(array("id" => $user_id, "type" => $user_type, "password" => $user_password));