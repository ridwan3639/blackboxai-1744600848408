<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Photobox</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Pilih Metode Pembayaran</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- QRIS Payment Option -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">QRIS</h2>
                <button id="qrisBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Bayar dengan QRIS
                </button>
                <div id="qrisContainer" class="mt-4 hidden">
                    <!-- QR Code will be displayed here -->
                    <div class="border p-4 inline-block">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=photobox-payment" alt="QR Code">
                    </div>
                    <p class="mt-2 text-sm text-gray-600">Scan QR code untuk melakukan pembayaran</p>
                </div>
            </div>

            <!-- Voucher Payment Option -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Voucher</h2>
                <form id="voucherForm">
                    <input type="text" name="voucherCode" placeholder="Masukkan kode voucher" 
                           class="border p-2 rounded w-full mb-2">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Gunakan Voucher
                    </button>
                </form>
                <div id="voucherMessage" class="mt-2 text-sm hidden"></div>
            </div>
        </div>
    </div>

    <script>
        // Handle QRIS button click
        document.getElementById('qrisBtn').addEventListener('click', function() {
            const container = document.getElementById('qrisContainer');
            container.classList.toggle('hidden');
            
            // Start polling for payment status
            // This would be implemented with AJAX in the actual application
        });

        // Handle voucher form submission
        document.getElementById('voucherForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const code = this.voucherCode.value;
            const message = document.getElementById('voucherMessage');
            
            // Validate voucher (would be AJAX call in actual implementation)
            if(code.length > 0) {
                message.textContent = "Memvalidasi voucher...";
                message.classList.remove('hidden', 'text-red-500');
                message.classList.add('text-blue-500');
                
                // Simulate validation
                setTimeout(() => {
                    message.textContent = "Voucher valid! Memproses pembayaran...";
                    // Proceed to next step
                }, 1500);
            } else {
                message.textContent = "Masukkan kode voucher terlebih dahulu";
                message.classList.remove('hidden', 'text-blue-500');
                message.classList.add('text-red-500');
            }
        });
    </script>
</body>
</html>
