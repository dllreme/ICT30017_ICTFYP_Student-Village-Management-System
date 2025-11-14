<?php
// login_handler.php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Read user data from file
    $users = [];
    if (file_exists('users.txt')) {
        $users = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
    
    $authenticated = false;
    $user_role = '';
    $user_email = '';
    
    foreach ($users as $user) {
        $user_data = explode(':', $user);
        if (count($user_data) >= 3) {
            list($stored_email, $stored_password, $role) = $user_data;
            
            if ($email === $stored_email && $password === $stored_password) {
                $authenticated = true;
                $user_role = $role;
                $user_email = $stored_email;
                break;
            }
        }
    }
    
    if ($authenticated) {
        $_SESSION['user'] = $user_email;
        $_SESSION['role'] = $user_role;
        
        // Log login activity
        $log_message = date('Y-m-d H:i:s') . " - User " . $_SESSION['user'] . " (" . $_SESSION['role'] . ") logged in from " . $_SERVER['REMOTE_ADDR'] . PHP_EOL;
        file_put_contents('login_log.txt', $log_message, FILE_APPEND | LOCK_EX);
        
        // Redirect to appropriate dashboard based on role
        switch ($user_role) {
            case 'admin':
                header("Location: admin_mainpage.php");
                break;
            case 'student':
                header("Location: student_mainpage.php"); // CHANGED THIS LINE
                break;
            case 'tenant':
                header("Location: tenant_mainpage.php");
                break;
            default:
                header("Location: student_mainpage.php"); // CHANGED THIS LINE
        }
        exit;
    } else {
        // Log failed login attempt
        $log_message = date('Y-m-d H:i:s') . " - Failed login attempt for email: " . $email . " from " . $_SERVER['REMOTE_ADDR'] . PHP_EOL;
        file_put_contents('login_log.txt', $log_message, FILE_APPEND | LOCK_EX);
        
        // Redirect back to login with error message
        header("Location: mainpage.php?error=Invalid email or password");
        exit;
    }
} else {
    // If not POST request, redirect to main page
    header("Location: mainpage.php");
    exit;
}
?>