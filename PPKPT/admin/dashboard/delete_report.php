<?php
require_once '../../auth/check_session.php';
check_role(['superadmin']);

$pdo = require '../../config/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM laporan WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: index.php?success=delete");
        exit();
    } catch (PDOException $e) {
        header("Location: index.php?error=delete_failed");
        exit();
    }
} else {
    header("Location: index.php?error=missing_id");
    exit();
}
