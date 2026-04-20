<?php
require_once "../../app/Models/Laporan.php";

    class LaporanController {
        private $model;

        public function __construct($pdo) {
            $this->model = new Laporan($pdo);
        }

        // Dashboard data
        public function dashboard() {
            $laporan = $this->model->getAll();
            $stats = $this->model->stats();

            return [
                'laporan' => $laporan,
                'stats' => $stats
            ];
        }

        // detail laporan
        public function detail($id) {
            return $this->model->find($id);
        }

        // update status laporan
        public function updateStatus($id, $status, $catatan) {
            return $this->model->updateStatus($id, $status, $catatan);
        }
        
        // Hapus laporan
         public function delete($id) {
            return $this->model->delete($id);
        }

    }
?>