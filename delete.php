<?php
// delete.php
include 'auth.php';
include 'config.php';
require_admin(); // Staff typing the URL directly are rejected (403)

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the student first so the notification can name them
    $stmt = mysqli_prepare($conn, "SELECT nim, name FROM students WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $student = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    if ($student) {
        $stmt = mysqli_prepare($conn, "DELETE FROM students WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        set_flash('danger', "Student \"" . $student['name'] . "\" (NIM " . $student['nim'] . ") was deleted.");
    }
}

header("Location: index.php");
exit;
?>
