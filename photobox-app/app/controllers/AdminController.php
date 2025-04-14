<?php
namespace App\Controllers;

class AdminController extends BaseController {
    public function dashboard() {
        // Get stats for dashboard
        $stats = [
            'total_transactions' => $this->db->query("SELECT COUNT(*) FROM transaksi")->fetchColumn(),
            'today_income' => $this->db->query("SELECT COALESCE(SUM(total), 0) FROM transaksi WHERE DATE(waktu) = CURDATE()")->fetchColumn(),
            'photos_taken' => $this->db->query("SELECT COUNT(*) FROM foto")->fetchColumn()
        ];

        $this->view('admin_dashboard', ['stats' => $stats]);
    }

    public function addBackground() {
        $imagePath = $this->saveUploadedFile($_FILES['background_image'], 'backgrounds');
        
        $stmt = $this->db->prepare("INSERT INTO background 
            (nama, path_gambar, aktif) 
            VALUES (?, ?, TRUE)");
        $stmt->execute([$_POST['background_name'], $imagePath]);
        
        $this->jsonResponse(['success' => true]);
    }

    public function removeBackground() {
        $stmt = $this->db->prepare("UPDATE background SET aktif = FALSE WHERE id = ?");
        $stmt->execute([$_POST['background_id']]);
        
        $this->jsonResponse(['success' => true]);
    }

    public function addFrame() {
        $imagePath = $this->saveUploadedFile($_FILES['frame_image'], 'frames');
        
        $stmt = $this->db->prepare("INSERT INTO frame 
            (nama, path_gambar, aktif) 
            VALUES (?, ?, TRUE)");
        $stmt->execute([$_POST['frame_name'], $imagePath]);
        
        $this->jsonResponse(['success' => true]);
    }

    public function removeFrame() {
        $stmt = $this->db->prepare("UPDATE frame SET aktif = FALSE WHERE id = ?");
        $stmt->execute([$_POST['frame_id']]);
        
        $this->jsonResponse(['success' => true]);
    }

    public function viewTransactionReports() {
        $transactions = $this->db->query("
            SELECT t.*, v.kode as voucher_code 
            FROM transaksi t
            LEFT JOIN voucher v ON t.id_voucher = v.id
            ORDER BY t.waktu DESC
            LIMIT 100
        ")->fetchAll();
        
        $this->jsonResponse($transactions);
    }

    private function saveUploadedFile($file, $subdirectory) {
        $targetDir = __DIR__."/../../public/uploads/$subdirectory/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid().'.'.$extension;
        $targetPath = $targetDir.$filename;
        
        move_uploaded_file($file['tmp_name'], $targetPath);
        
        return "/uploads/$subdirectory/$filename";
    }
}
?>
