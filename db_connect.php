<?php
$servername = "localhost";   // ถ้าเป็น XAMPP ปกติใช้ localhost
$username   = "root";        // ค่า default ของ XAMPP
$password   = "";            // ค่า default ของ XAMPP จะว่าง
$dbname     = "website_yj";  // ใส่ชื่อ Database ของคุณ (จาก phpMyAdmin)

$conn = mysqli_connect($servername, $username, $password, $dbname);

// เช็คการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
