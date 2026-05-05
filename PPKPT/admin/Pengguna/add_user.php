<?php
require_once '../../auth/check_session.php';
check_role(['superadmin']);

$pdo = require '../../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = 'admin'; // Superadmin can only add Admin
    $password = $_POST['password'] ?? 'polije123'; // Default password if not provided

    if (!empty($nama) && !empty($username) && !empty($email)) {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (nama, username, email, role, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nama, $username, $email, $role, $hashed_password]);

            header("Location: pengguna.php?success=add");
            exit();
        } catch (PDOException $e) {
            header("Location: pengguna.php?error=add_failed");
            exit();
        }
    } else {
        header("Location: pengguna.php?error=missing_fields");
        exit();
    }
}
