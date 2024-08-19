<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["msgs"])) {
    $_SESSION["msgs"] = [];
}

function sendMsg($type, $msg) {
    $_SESSION["msgs"][$type] = $msg;
}