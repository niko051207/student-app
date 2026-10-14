<?php
// config.php
$host = "localhost";
$user = "root";       // Default XAMPP username
$pass = "";           // Default XAMPP password (empty)
$db   = "db_school";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
