<?php
// auth.php — include on the FIRST line of every protected page
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

function is_admin() {
    return $_SESSION['role'] === 'admin';
}

function require_admin() {
    if (!is_admin()) {
        http_response_code(403);
        die("403 - Access denied. This page is for admins only.");
    }
}

// ---- Flash notification (shown once, then removed) ----
// $type: success | warning | danger (Bootstrap alert colors)
function set_flash($type, $message) {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function show_flash() {
    if (isset($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        unset($_SESSION['flash']); // show only once
        echo '<div class="alert alert-' . $f['type'] . ' alert-dismissible fade show" role="alert">'
           . htmlspecialchars($f['message'])
           . '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>'
           . '</div>';
    }
}
?>
