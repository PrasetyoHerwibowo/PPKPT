<?php
$pdo = require '../config/connection.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    
    if ($id && $id > 0) {
        try {
            $sql = "DELETE FROM laporan WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$id]);
            
            if ($result) {
                header("Location: ../admin/dashboard/index.php?delete=success");
            } else {
                header("Location: ../admin/dashboard/index.php?delete=failed");
            }
        } catch (PDOException $e) {
            error_log("Delete error: " . $e->getMessage());
            header("Location: ../admin/dashboard/index.php?delete=error");
        }
    } else {
        header("Location: ../admin/dashboard/index.php?delete=invalid");
    }
} else {
    header("Location: ../admin/dashboard/index.php");
}
exit;
?>