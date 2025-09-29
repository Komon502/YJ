<?php
include __DIR__ . '/auth.php';
include __DIR__ . '/../db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($conn, "DELETE FROM event WHERE EventID=$id");
}

header("Location: manage_HOME.php");
exit;
?>
