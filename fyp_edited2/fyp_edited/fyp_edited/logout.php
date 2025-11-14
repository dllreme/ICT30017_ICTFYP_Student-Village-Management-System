<?php
// logout.php
session_start();

// Log logout activity
if (isset($_SESSION['user'])) {
    $log_message = date('Y-m-d H:i:s') . " - User " . $_SESSION['user'] . " (" . $_SESSION['role'] . ") logged out from " . $_SERVER['REMOTE_ADDR'] . PHP_EOL;
    file_put_contents('login_log.txt', $log_message, FILE_APPEND | LOCK_EX);
}

// Unset all session variables
$_SESSION = array();

// Delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Clear any existing output buffers
while (ob_get_level()) {
    ob_end_clean();
}

// Redirect to main page with logout success message
header("Location: mainpage.php?message=You have been successfully logged out");
exit;
?>