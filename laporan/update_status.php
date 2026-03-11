<?php
$pdo = require '../config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validasi input
    $errors = [];
    
    $id = filter_var($_POST['id'] ?? 0, FILTER_VALIDATE_INT);
    $status = htmlspecialchars(trim($_POST['status'] ?? ''));
    $catatan = htmlspecialchars(trim($_POST['catatan_admin'] ?? ''));

    // Validasi
    if (!$id || $id <= 0) $errors[] = "ID laporan tidak valid";
    if (empty($status)) $errors[] = "Status harus diisi";
    
    $validStatus = ['Pending', 'Diproses', 'Selesai'];
    if (!in_array($status, $validStatus)) $errors[] = "Status tidak valid";

    if (empty($errors)) {
        try {
            $sql = "UPDATE laporan SET status = ?, catatan_admin = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            
            $result = $stmt->execute([$status, $catatan ?: null, $id]);

            if ($result) {
                // Redirect dengan pesan sukses
                header("Location: ../admin/dashboard/index.php?update=success");
            } else {
                header("Location: ../admin/dashboard/index.php?update=failed");
            }
            exit;

        } catch (PDOException $e) {
            error_log("Update error: " . $e->getMessage());
            header("Location: ../admin/dashboard/index.php?update=error");
            exit;
        }
    } else {
        $errorMsg = implode(", ", $errors);
        header("Location: ../admin/dashboard/index.php?update=error&message=" . urlencode($errorMsg));
        exit;
    }
} else {
    // Jika bukan method POST
    header("Location: ../admin/dashboard/index.php");
    exit;
}
?>