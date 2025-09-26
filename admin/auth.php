<?php
session_start();

// ถ้ายังไม่ได้ login → redirect ไปหน้า login
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit();
}
?>
