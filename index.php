<?php
session_start();

if (!isset($_SESSION['role'])) {
    header("Location: auth/login.php");
    exit;
}

if ($_SESSION['role'] === 'admin') {
    header("Location: admin/dashboard.php");
    exit;
}

if ($_SESSION['role'] === 'provider') {
    header("Location: provider/dashboard.php");
    exit;
}

if ($_SESSION['role'] === 'customer') {
    header("Location: customer/request_service.php");
    exit;
}
