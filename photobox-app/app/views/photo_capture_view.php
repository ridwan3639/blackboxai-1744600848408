<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengambilan Foto - Photobox</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    <style>
        #countdown {
            font-size: 5rem;
            text-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
        .photo-preview {
            transition: all 0.3s ease;
        }
        .photo-preview:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Pengambilan Foto</h1>
            <div class="text-right">
                <div id="timer" class="text-xl">Sisa waktu: 10:00</div>
                <div class="text-sm">Foto diambil: <span id="photosTaken">0</span>/6</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <!-- Webcam Feed -->
            <div class="lg:col-span-2 relative">
                <div id="countdown" class="absolute inset-0 flex items-center justify-center hidden z-10">3</div>
                <video id="webcam" autoplay playsinline class="w-full h-auto rounded-lg border-4 border-white"></video>
                <div class="mt-4 text-center">
                    <button id="captureBtn" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-full text-lg font-bold">
                        Ambil Foto
                    </button>
                </div>
            </div>

            <!-- Photo Previews -->
            <div class="space-y-4">
                <h2 class="text-xl font-semibold">Hasil Foto</h2>
                <div id="photoPreviews" class="grid grid-cols-2 gap-2">
                    <!-- Photo previews will be added here dynamically -->
                </div>
                <div class="mt-4">
                    <button id="proceedBtn" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded hidden">
                        Lanjut ke Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Webcam elements
        const webcam = document.getElementById('webcam');
        const captureBtn = document.getElementById('captureBtn');
        const countdown = document.getElementById('countdown');
        const photoPreviews = document.getElementById('photoPreviews');
        const photosTaken = document.getElementById('photosTaken');
        const proceedBtn = document.getElementById('proceedBtn');
        const timer = document.getElementById('timer');
        
        let photos = [];
        let sessionTimer = 600; // 10 minutes in seconds
        let countdownInterval;
        let sessionInterval;

        // Start webcam
        async function initWebcam() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { 
                        width: 1280, 
                        height: 720,
                        facingMode: 'user' 
                    },
                    audio: false 
                });
                webcam.srcObject = stream;
            } catch (err) {
                console.error("Error accessing webcam:", err);
                alert("Tidak dapat mengakses webcam. Pastikan izin diberikan.");
            }
        }

        // Countdown timer
        function startCountdown() {
            let count = 3;
            countdown.textContent = count;
            countdown.classList.remove('hidden');
            
            countdownInterval = setInterval(() => {
                count--;
                countdown.textContent = count;
                
                if (count <= 0) {
                    clearInterval(countdownInterval);
                    countdown.classList.add('hidden');
                    capturePhoto();
                }
            }, 1000);
        }

        // Capture photo
        function capturePhoto() {
            const canvas = document.createElement('canvas');
            canvas.width = webcam.videoWidth;
            canvas.height = webcam.videoHeight;
            canvas.getContext('2d').drawImage(webcam, 0, 0, canvas.width, canvas.height);
            
            const photoUrl = canvas.toDataURL('image/jpeg');
            photos.push(photoUrl);
            photosTaken.textContent = photos.length;
            
            // Add to preview
            const preview = document.createElement('div');
            preview.className = 'photo-preview relative';
            preview.innerHTML = `
                <img src="${photoUrl}" class="w-full h-auto rounded border border-white">
                <span class="absolute top-1 right-1 bg-black bg-opacity-50 text-white text-xs px-1 rounded">${photos.length}</span>
            `;
            photoPreviews.appendChild(preview);
            
            // Show proceed button when all photos are taken
            if (photos.length === 6) {
                proceedBtn.classList.remove('hidden');
                captureBtn.disabled = true;
            }
        }

        // Session timer
        function startSessionTimer() {
            sessionInterval = setInterval(() => {
                sessionTimer--;
                const minutes = Math.floor(sessionTimer / 60);
                const seconds = sessionTimer % 60;
                timer.textContent = `Sisa waktu: ${minutes}:${seconds.toString().padStart(2, '0')}`;
                
                if (sessionTimer <= 0) {
                    clearInterval(sessionInterval);
                    alert('Waktu sesi telah habis!');
                    // Redirect or handle session timeout
                }
            }, 1000);
        }

        // Event listeners
        captureBtn.addEventListener('click', startCountdown);
        proceedBtn.addEventListener('click', () => {
            // Save photos and proceed to filter selection
            console.log('Proceeding to filter selection with photos:', photos);
            // In actual implementation, would submit to server
        });

        // Initialize
        initWebcam();
        startSessionTimer();
    </script>
</body>
</html>
