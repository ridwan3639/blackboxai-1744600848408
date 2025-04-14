<?php
namespace App\Controllers;

class PhotoController extends BaseController {
    public function showPhotoCapture() {
        // Get available backgrounds and frames from database
        $backgrounds = $this->db->query("SELECT * FROM background WHERE aktif = TRUE")->fetchAll();
        $frames = $this->db->query("SELECT * FROM frame WHERE aktif = TRUE")->fetchAll();
        
        $this->view('photo_capture_view', [
            'backgrounds' => $backgrounds,
            'frames' => $frames
        ]);
    }

    public function capturePhoto() {
        $photoData = $_POST['photo'];
        $backgroundId = $_POST['background_id'];
        $frameId = $_POST['frame_id'];
        
        // Save photo to database
        $stmt = $this->db->prepare("INSERT INTO foto 
            (data_foto, id_background, id_frame, waktu_pengambilan) 
            VALUES (?, ?, ?, NOW())");
        $stmt->execute([$photoData, $backgroundId, $frameId]);
        
        $this->jsonResponse([
            'success' => true,
            'photo_id' => $this->db->lastInsertId()
        ]);
    }

    public function applyFilter() {
        $photoId = $_POST['photo_id'];
        $filterType = $_POST['filter_type'];
        
        // Apply filter and update photo in database
        $stmt = $this->db->prepare("UPDATE foto SET filter = ? WHERE id = ?");
        $stmt->execute([$filterType, $photoId]);
        
        $this->jsonResponse(['success' => true]);
    }

    public function savePhotoLayout() {
        $photoId = $_POST['photo_id'];
        $layoutType = $_POST['layout_type'];
        
        // Save layout selection
        $stmt = $this->db->prepare("UPDATE foto SET layout = ? WHERE id = ?");
        $stmt->execute([$layoutType, $photoId]);
        
        $this->jsonResponse(['success' => true]);
    }
}
?>
