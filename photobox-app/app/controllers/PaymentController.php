<?php
class PaymentController {
    public function showPaymentOptions() {
        // Include the payment view
        require_once __DIR__.'/../../views/payment_view.php';
    }

    public function processQrisPayment() {
        // Generate QR code data
        $transactionId = uniqid();
        $amount = 25000; // Default amount
        
        // Save transaction to database
        $stmt = $this->db->prepare("INSERT INTO transaksi 
            (metode_pembayaran, status, total) 
            VALUES ('qris', 'pending', ?)");
        $stmt->execute([$amount]);
        
        // Here you would generate the QR code and return it
        $qrData = "https://example.com/payment?transaction_id=$transactionId"; // Example QR data
        
        $this->jsonResponse([
            'success' => true,
            'qr_data' => $qrData,
            'transaction_id' => $transactionId
        ]);
    }

    public function processVoucherPayment() {
        // Validate voucher code
        $voucherCode = $_POST['voucherCode'];
        $stmt = $this->db->prepare("SELECT * FROM voucher WHERE kode = ? AND digunakan = FALSE");
        $stmt->execute([$voucherCode]);
        $voucher = $stmt->fetch();

        if ($voucher) {
            // Mark voucher as used
            $updateStmt = $this->db->prepare("UPDATE voucher SET digunakan = TRUE WHERE id = ?");
            $updateStmt->execute([$voucher['id']]);
            
            // Create transaction
            $stmt = $this->db->prepare("INSERT INTO transaksi 
                (metode_pembayaran, status, total, id_voucher) 
                VALUES ('voucher', 'sukses', ?, ?)");
            $stmt->execute([$voucher['nilai'], $voucher['id']]);
            
            $this->jsonResponse(['success' => true, 'message' => 'Pembayaran berhasil!']);
        } else {
            $this->jsonResponse(['success' => false, 'message' => 'Voucher tidak valid atau sudah digunakan.']);
        }
    }
}
?>

    public function processVoucherPayment() {
        // Logic to validate voucher and process payment
    }
}
?>
