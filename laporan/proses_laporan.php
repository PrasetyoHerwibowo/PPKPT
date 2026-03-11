<?php
$pdo = require '../config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validasi input
    $errors = [];
    
    // Sanitasi input
    $nama = htmlspecialchars(trim($_POST['nama'] ?? ''));
    $nim = htmlspecialchars(trim($_POST['nim'] ?? ''));
    $nik = htmlspecialchars(trim($_POST['nik'] ?? ''));
    $hp = htmlspecialchars(trim($_POST['hp'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $tkp = htmlspecialchars(trim($_POST['tkp'] ?? ''));
    $bukti = htmlspecialchars(trim($_POST['bukti'] ?? ''));
    $tanggal = $_POST['tanggal'] ?? date('Y-m-d');
    $kronologi = htmlspecialchars(trim($_POST['kronologi'] ?? ''));

    // Validasi required fields
    if (empty($nama)) $errors[] = "Nama harus diisi";
    if (empty($hp)) $errors[] = "Nomor HP harus diisi";
    if (empty($email)) $errors[] = "Email harus diisi";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Format email tidak valid";
    if (empty($tkp)) $errors[] = "Tempat kejadian harus diisi";
    if (empty($kronologi)) $errors[] = "Kronologi harus diisi";

    if (empty($errors)) {
        try {
            $status = "Pending"; // default laporan baru
            $catatan = null; // belum ada catatan admin

            $sql = "INSERT INTO laporan (nama, nim, nik, hp, email, tkp, bukti, tanggal, kronologi, status, catatan_admin) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $pdo->prepare($sql);
            
            $stmt->execute([
                $nama,
                $nim ?: null,
                $nik ?: null,
                $hp,
                $email,
                $tkp,
                $bukti ?: null,
                $tanggal,
                $kronologi,
                $status,
                $catatan
            ]);

            // Cek apakah request dari AJAX
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode([
                    "status" => "success",
                    "message" => "Laporan berhasil dikirim"
                ]);
            } else {
                header("Location: ../admin/dashboard/index.php?success=1");
            }
            exit;

        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    } else {
        $error = implode(", ", $errors);
    }

    // Jika ada error
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode([
            "status" => "error",
            "message" => $error ?? "Terjadi kesalahan"
        ]);
    } else {
        header("Location: ../admin/dashboard/index.php?error=" . urlencode($error ?? "Terjadi kesalahan"));
    }
    exit;
}
?>