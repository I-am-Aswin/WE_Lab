<?php
session_start();

function is_logged_in() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_name']);
}

function redirect($url) {
    header("Location: $url");
    exit();
}
?>