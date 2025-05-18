<section class="login-section">
    <script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>

    <!-- Background Video -->
    <video autoplay muted loop playsinline class="bg-video">
        <source src="{{ asset('assets/videos/bg.mp4') }}" type="video/mp4">
    </video>
    <div class="dark-overlay"></div>

    <!-- Content -->
    <div class="container d-flex flex-column align-items-center justify-content-center text-white text-center section-height-100">
        <img src="{{ asset('assets/img/visionvoicelogo.png') }}" alt="Logo" class="mb-4 animated-logo">

        <h1 class=" mb-5 text-white">Welcome to Vision Voice</h1>

        <div class="row w-100 justify-content-center">
            <!-- Face ID Login -->
            <div class="col-lg-5 col-md-6 mb-4 ">
                <div class="glass-card p-4 h-100 ">
                    <h4 class="mb-3 text-info text-white">Face ID Login</h4>
                    <div class="glow-frame mb-3">
                        <video id="faceLoginCam" width="100%" height="240" autoplay muted></video>
                    </div>
                    <button id="faceLogin" class="btn pulse-button w-100">Login with Face</button>
                </div>
            </div>

            <!-- Email Login -->
            <div class="col-lg-5 col-md-6 mb-4">
                <div class="glass-card p-4 h-100 ">
                    <h4 class="mb-3 text-info text-white">Email Login</h4>
                    <form wire:submit.prevent="login" action="{{ route('login') }}" method="POST">
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label text-white">Email</label>
                            <input wire:model.live="email" id="email" type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="mb-3 text-start">
                            <label for="password" class="form-label text-white">Password</label>
                            <input wire:model.live="password" id="password" type="password" class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" style="background-color:#3674B5" class="btn pulse-button btn-info w-100 mt-2">Sign In</button>
                    </form>
                    <!-- From Uiverse.io by Nawsome -->
                    <div class="container">
                        <div class="loader"></div>
                        <div class="loader"></div>
                        <div class="loader"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        .dark-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        .section-height-100 {
            min-height: 100vh;
        }

        .animated-logo {
            width: 120px;
            animation: float 5s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .animated-gradient {
            font-size: 2.5rem;
            background: linear-gradient(90deg, #3674B5, #4facfe, #3674B5);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 4s linear infinite;
        }

        @keyframes shimmer {
            to {
                background-position: -200% center;
            }
        }

        .glass-card {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            color: #fff;
        }

        .glow-frame {
            border: 2px solid #3674B5;
            border-radius: 12px;
            padding: 4px;
            animation: glow-border 1.5s infinite alternate;
        }

        @keyframes glow-border {
            from {
                box-shadow: 0 0 10px #3674B5;
            }

            to {
                box-shadow: 0 0 20px #3674B5, 0 0 30px #3674B5;
            }
        }

        .pulse-button {
            background-color: #3674B5;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            padding: 10px 0;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(0, 194, 255, 0.6);
            }

            70% {
                box-shadow: 0 0 0 12px rgba(0, 194, 255, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(0, 194, 255, 0);
            }
        }

        .pulse-button:hover {
            background-color: #007bbf;
        }
    </style>
</section>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('login-success', event => {
        Swal.fire({
            icon: 'success',
            title: 'Login Approved',
            text: 'Welcome back!',
            confirmButtonColor: '#3085d6',
            showConfirmButton: false, // Remove the OK button
            timer: 1500 // Automatically close the SweetAlert after 1.5 seconds
        });

        // Redirect to the dashboard after SweetAlert closes
        setTimeout(() => {
            window.location.href = "{{ url('/dashboard') }}"; // Redirect after login
        }, 1500); // Match the timer duration to allow for redirection after closing the alert
    });


    window.addEventListener('login-failed', event => {
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: 'Invalid email or password. Please try again!',
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (!('webkitSpeechRecognition' in window) || !window.speechSynthesis) {
            alert("Your browser doesn't support voice features. Please use Chrome.");
            return;
        }

        const synth = window.speechSynthesis;
        const recognition = new webkitSpeechRecognition();
        recognition.lang = 'en-US';
        recognition.interimResults = false;
        recognition.continuous = false;

        let currentStep = 'ask-assist';

        const speak = (text, callback) => {
            const utter = new SpeechSynthesisUtterance(text);
            utter.onend = callback;
            synth.cancel();
            synth.speak(utter);
        };

        const isValidEmail = (email) => {
            const pattern = /^[a-z]+\.[a-z]+@school\.com$/;
            return pattern.test(email);
        };

        const isValidPassword = (password) => {
            return /^[a-z0-9]+$/.test(password);
        };

        const askNext = () => {
            if (currentStep === 'email') {
                speak("Please say your email.", () => recognition.start());
            } else if (currentStep === 'password') {
                speak("Now, say your password.", () => recognition.start());
            } else if (currentStep === 'confirm') {
                speak("Do you want to sign in now? Say yes to continue or no to restart.", () => recognition.start());
            }
        };

        recognition.onresult = (event) => {
            let spokenText = event.results[0][0].transcript.toLowerCase().trim().replace(/\.$/, '');
            console.log("Recognized:", spokenText);
            if (currentStep === 'ask-assist') {
                if (spokenText.includes("yes")) {
                    speak("Would you like to use Face ID login or Voice login?", () => {
                        currentStep = 'choose-method';
                        recognition.start();
                    });
                } else {
                    speak("Voice assistance is turned off.");
                }
                return;
            }

            if (currentStep === 'choose-method') {
                if (spokenText.includes("face")) {
                    speak("Starting Face ID login.", () => {
                        document.getElementById("faceLogin").click(); // Trigger Face ID login
                    });
                } else if (spokenText.includes("voice")) {
                    speak("Great, let's begin voice login.", () => {
                        currentStep = 'email';
                        askNext();
                    });
                } else {
                    speak("Please say Face or Voice.", () => recognition.start());
                }
                return;
            }


            if (currentStep === 'email') {
                spokenText = spokenText
                    .replace(" at ", "@")
                    .replace(" dot ", ".")
                    .replace(/\s/g, '')
                    .replace(/\.$/, '');

                if (!isValidEmail(spokenText)) {
                    speak("Invalid email format. Please try again.", () => askNext());
                    return;
                }

                document.getElementById("email").value = spokenText;
                document.getElementById("email").dispatchEvent(new Event('input'));
                @this.set('email', spokenText);
                speak("Email received.", () => {
                    currentStep = 'password';
                    askNext();
                });
            } else if (currentStep === 'password') {
                // Break down spoken characters and filter only valid ones (letters/numbers)
                const chars = spokenText
                    .toLowerCase()
                    .replace(/\s/g, '') // remove all spaces
                    .split('') // split into characters
                    .filter(c => /[a-z0-9]/.test(c)); // keep only valid characters

                const password = chars.join('');

                if (!isValidPassword(password)) {
                    speak("Invalid password format. Please try again.", () => askNext());
                    return;
                }

                document.getElementById("password").value = password;
                document.getElementById("password").dispatchEvent(new Event('input'));
                @this.set('password', password);

                speak("Password saved.", () => {
                    currentStep = 'confirm';
                    askNext();
                });
            } else if (currentStep === 'confirm') {
                if (spokenText.includes("yes")) {
                    speak("Signing you in now.", () => {
                        document.querySelector('button[type=\"submit\"]').click();
                    });
                } else {
                    speak("Restarting login process.", () => {
                        currentStep = 'email';
                        askNext();
                    });
                }
            }
        };

        recognition.onerror = (event) => {
            console.error('Recognition error:', event.error);
            speak("Sorry, I didn't catch that. Let's try again.", () => askNext());
        };

        setTimeout(() => {
            speak("Welcome. Would you like assistance to log in? Say yes or no.", () => recognition.start());
        }, 1000);
    });

    // Login failed handler with retry
    window.addEventListener('login-failed', () => {
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: 'Invalid email or password. Would you like to try again?',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Try Again'
        }).then(() => {
            const retryUtter = new SpeechSynthesisUtterance("Let's try again from the beginning.");
            retryUtter.onend = () => location.reload();
            window.speechSynthesis.speak(retryUtter);
        });
    });
</script>
<script>
    const faceCam = document.getElementById('faceLoginCam');
    const faceLoginBtn = document.getElementById('faceLogin');

    async function loadFaceLogin() {
        await faceapi.nets.tinyFaceDetector.loadFromUri('/models');
        await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
        await faceapi.nets.faceRecognitionNet.loadFromUri('/models');

        navigator.mediaDevices.getUserMedia({
                video: {}
            })
            .then(stream => faceCam.srcObject = stream);
    }

    faceLoginBtn.addEventListener('click', async () => {
        const detection = await faceapi
            .detectSingleFace(faceCam, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptor();

        if (!detection) {
            Swal.fire("Face not detected.");
            return;
        }

        const userDescriptor = detection.descriptor;

        const response = await fetch('/api/face-login-check', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                descriptor: Array.from(userDescriptor)
            })
        });

        const result = await response.json();
        if (result.success) {
            Swal.fire("Face match successful!", "Redirecting...", "success");
            console.log(result);
            let redirectUrl = "/dashboard"; // default

            switch (result.role) {
                case "admin":
                    redirectUrl = "/dashboard";
                    break;
                case "teacher":
                    redirectUrl = "/teacher/dashboard";
                    break;
                case "student":
                    redirectUrl = "/student/dashboard";
                    break;
                case "parent":
                    redirectUrl = "/parent/dashboard";
                    break;
            }

            setTimeout(() => {
                window.location.href = redirectUrl;
            }, 1500);
        } else {
            Swal.fire("Face not recognized. Please use email/password.");
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        loadFaceLogin();
    });
</script>