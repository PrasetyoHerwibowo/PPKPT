<?php

$pdo = require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $nik = $_POST['nik'];
    $hp = $_POST['hp'];
    $email = $_POST['email'];
    $tkp = $_POST['tkp'];
    $bukti = $_POST['bukti'];
    $tanggal = $_POST['tanggal'];
    $kronologi = $_POST['kronologi'];

    $sql = "INSERT INTO laporan
    (nama,nim,nik,hp,email,tkp,bukti,tanggal,kronologi)
    VALUES (?,?,?,?,?,?,?,?,?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nama,
        $nim,
        $nik,
        $hp,
        $email,
        $tkp,
        $bukti,
        $tanggal,
        $kronologi
    ]);

    echo json_encode([
        "status" => "success",
        "message" => "Laporan berhasil dikirim"
    ]);
}
?>
