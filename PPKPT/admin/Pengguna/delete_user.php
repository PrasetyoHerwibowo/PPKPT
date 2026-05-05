<?php
require_once '../../auth/check_session.php';
check_role(['superadmin']);

$pdo = require '../../config/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prevent deleting self
    if ($id == $_SESSION['user_id']) {
        header("Location: pengguna.php?error=delete_self");
        exit();
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: pengguna.php?success=delete");
        exit();
    } catch (PDOException $e) {
        header("Location: pengguna.php?error=delete_failed");
        exit();
    }
} else {
    header("Location: pengguna.php?error=missing_id");
    exit();
}


