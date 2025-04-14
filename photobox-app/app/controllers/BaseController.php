<?php
namespace App\Controllers;

class BaseController {
    protected $db;

    public function __construct() {
        global $pdo;
        $this->db = $pdo;
    }

    protected function view($viewName, $data = []) {
        extract($data);
        require_once __DIR__."/../views/$viewName.php";
    }

    protected function redirect($url) {
        header("Location: $url");
        exit();
    }

    protected function jsonResponse($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}
?>
