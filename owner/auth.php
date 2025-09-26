<?php
session_start();
if (!isset($_SESSION['is_owner']) || $_SESSION['is_owner'] !== true) {
    header("Location: login.php");
    exit();
}
?>
