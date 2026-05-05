<?php
require_once '../../auth/check_session.php';
check_role(['superadmin']);

$pdo = require '../../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $status = $_POST['status'] ?? 'aktif';
    $role = $_POST['role'] ?? 'admin';
    $password = $_POST['password'] ?? '';

    // Proteksi: Cek role user saat ini di database
    $stmt_check = $pdo->prepare("SELECT role FROM users WHERE id = ?");
    $stmt_check->execute([$id]);
    $currentUser = $stmt_check->fetch();

    // Jika user adalah superadmin, role-nya tidak boleh diubah menjadi admin
    if ($currentUser && $currentUser['role'] === 'superadmin') {
        $role = 'superadmin';
    }

    if (!empty($id)) {
        try {
            if (!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE users SET status = ?, role = ?, password = ? WHERE id = ?");
                $stmt->execute([$status, $role, $hashed_password, $id]);
            } else {
                $stmt = $pdo->prepare("UPDATE users SET status = ?, role = ? WHERE id = ?");
                $stmt->execute([$status, $role, $id]);
            }

            header("Location: pengguna.php?success=update");
            exit();
        } catch (PDOException $e) {
            header("Location: pengguna.php?error=update_failed");
            exit();
        }
    } else {
        header("Location: pengguna.php?error=missing_id");
        exit();
    }
}
