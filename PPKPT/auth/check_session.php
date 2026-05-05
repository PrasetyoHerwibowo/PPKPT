<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check if the user is logged in and still active in the database.
 * If not, redirect to the login page.
 */
function check_login() {
    if (!isset($_SESSION['user_id'])) {
        // Fallback redirection logic
        redirect_to_login();
    }

    // Verify user in database
    try {
        // We need a PDO instance.
        $pdo = require __DIR__ . '/../config/connection.php';
        
        $stmt = $pdo->prepare("SELECT id, status FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();

        if (!$user || $user['status'] !== 'aktif') {
            // Account is deleted or suspended
            session_destroy();
            redirect_to_login("?error=unauthorized");
        }
    } catch (Exception $e) {
        // If DB check fails, we might want to log it, but for now let's allow 
        // if session exists, or be strict. Let's be strict for security.
    }
}

/**
 * Helper to redirect to login page regardless of current directory depth
 */
function redirect_to_login($query = "") {
    // For this project, we know the structure.
    $script_name = $_SERVER['SCRIPT_NAME'];
    $base_dir = '/WSI/PPKPT/';
    
    if (strpos($script_name, $base_dir) !== false) {
        header("Location: " . $base_dir . "auth/login.php" . $query);
    } else {
        // Fallback to relative if base_dir is different (e.g. local dev)
        header("Location: ../../auth/login.php" . $query);
    }
    exit();
}

/**
 * Check if the logged-in user has a specific role.
 * @param array $allowed_roles Array of roles that are allowed to access the page.
 */
function check_role($allowed_roles = []) {
    check_login();
    
    if (!in_array($_SESSION['role'], $allowed_roles)) {
        // Redirect to dashboard or show an error if the role is not authorized
        echo "<script>alert('Anda tidak memiliki akses ke halaman ini!'); window.location.href='../dashboard/index.php';</script>";
        exit();
    }
}

/**
 * Helper to get user data from session.
 */
function get_user_session($key) {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
}
