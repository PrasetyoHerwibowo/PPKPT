<?php
require_once '../../auth/check_session.php';
check_role(['superadmin']);

$pdo = require '../../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $status = $_POST['status'] ?? '';
    $catatan_admin = $_POST['catatan_admin'] ?? '';

    if (!empty($id) && !empty($status)) {
        try {
            $stmt = $pdo->prepare("UPDATE laporan SET status = ?, catatan_admin = ? WHERE id = ?");
            $stmt->execute([$status, $catatan_admin, $id]);

            header("Location: index.php?success=update");
            exit();
        } catch (PDOException $e) {
            header("Location: index.php?error=update_failed");
            exit();
        }
    } else {
        header("Location: index.php?error=missing_fields");
        exit();
    }
}
