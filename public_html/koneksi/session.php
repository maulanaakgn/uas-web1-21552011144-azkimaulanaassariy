<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function check_login() {
    if (empty($_SESSION['username'])) {
        header('Lokasi: login.php');
        exit();
    }
}

function logout() {
    session_destroy();
    header('Lokasi: login.php');
    exit();
}
?>