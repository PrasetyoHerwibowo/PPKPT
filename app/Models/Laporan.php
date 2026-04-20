<?php
class Laporan
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM laporan ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function stats(): array
    {
        $sql = "
            SELECT
                COUNT(*) AS total,
                SUM(status = 'Pending') AS pending,
                SUM(status = 'Diproses') AS diproses,
                SUM(status = 'Selesai') AS selesai
            FROM laporan
        ";

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM laporan WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function updateStatus(int $id, string $status, string $catatan): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE laporan
            SET status = ?, catatan = ?
            WHERE id = ?
        ");

        return $stmt->execute([$status, $catatan, $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM laporan WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>