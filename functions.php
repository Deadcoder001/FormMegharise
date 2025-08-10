<?php
require_once 'config.php';

function is_admin_logged_in() {
    return isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin';
}

function redirect_if_not_admin() {
    if (!is_admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function vendor_notifications($mysqli)
{
    $result = $mysqli->query("SELECT COUNT(*) as count FROM vendors WHERE status='pending'");
    $row = $result->fetch_assoc();
    return $row['count'];
}



?>