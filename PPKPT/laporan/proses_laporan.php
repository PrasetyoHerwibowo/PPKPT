<?php
$pdo = require '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $nim = $_POST['nim'] ?? '';
    $nik = $_POST['nik'] ?? '';
    $hp = $_POST['hp'] ?? '';
    $email = $_POST['email'] ?? '';
    $tkp = $_POST['tkp'] ?? '';
    $bukti = $_POST['bukti'] ?? '';
    $tanggal = $_POST['tanggal'] ?? '';
    $kronologi = $_POST['kronologi'] ?? '';
    $status = 'Pending';

    if (!empty($nama) && !empty($kronologi)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO laporan (nama, nim, nik, hp, email, tkp, bukti, tanggal, kronologi, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nama, $nim, $nik, $hp, $email, $tkp, $bukti, $tanggal, $kronologi, $status]);

            // Return JSON for AJAX submission in index.php
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Laporan berhasil dikirim']);
            exit();
        } catch (PDOException $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan laporan: ' . $e->getMessage()]);
            exit();
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
        exit();
    }
}
