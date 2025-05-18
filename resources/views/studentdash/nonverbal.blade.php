<x-layouts.app>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Page Title --}}
    <div class="container text-center my-4">
        <button data-text="Awesome" class="buttonpma">
            <span class="actual-text">&nbsp;Features&nbsp;</span>
            <span class="hover-text" aria-hidden="true">&nbsp;Features&nbsp;</span>
        </button>
    </div>

    {{-- Full Feature Panel --}}
    <div class="container mb-5">
        <div class="tts-section">

            {{-- Text-to-Speech --}}
            <label for="ttsInput" class="tts-label">💬 Type your message</label>
            <textarea id="ttsInput" placeholder="Type here and I’ll speak it..." oninput="detectLanguage()"></textarea>
            <div class="tts-label">🎙️ Voice auto-selected based on your input</div>

            <div class="row">
                <div class="col-md-6">
                    <button onclick="pauseResume()" class="tts-btn secondary-btn">⏸️</button>
                </div>
                <div class="col-md-6">
                    <button onclick="speakText()" class="tts-btn secondary-btn">🔊</button>
                </div>
                <div class="col-md-6 mt-2">
                    <button onclick="repeatLastSpoken()" class="tts-btn secondary-btn">🔁</button>
                </div>
                <div class="col-md-6 mt-2">
                    <button onclick="clearText()" class="tts-btn secondary-btn clear-btn">🧹</button>
                </div>
            </div>

            <hr class="my-4">

            {{-- Quick Speak Buttons --}}
            <div class="row text-center">
                <div class="col-md-4">
                    <button onclick="quickSpeak('I want to go to the bathroom')" class="tts-btn secondary-btn">Bathroom 🚽</button>
                </div>
                <div class="col-md-4 mt-2 mt-md-0">
                    <button onclick="quickSpeak('I want to drink water')" class="tts-btn secondary-btn">Water 💧</button>
                </div>
                <div class="col-md-4 mt-2 mt-md-0">
                    <button onclick="quickSpeak('I didnt understand, can you repeat please')" class="tts-btn secondary-btn">Didn't Understand ❓</button>
                </div>
            </div>

            <hr class="my-4">
            <div class="row">

                <div class="col-md-6 mb-4">
                    {{-- Sign Language Recognition --}}
                    <div class="tts-label">🖐️ Sign Language Recognition</div>
                    <video id="signVideo" autoplay muted playsinline width="100%" style="border-radius: 10px; margin-bottom: 10px;"></video>
                    <button onclick="initSignRecognition()" class="tts-btn secondary-btn">Start Recognition</button>
                    <div class="tts-label mt-2">Detected: <span id="signText">None</span></div>
                </div>
                
                <div class="col-md-6 mb-4">
                    {{-- Teach New Sign --}}
                    <div class="tts-label">🎓 Teach a New Sign</div>
                    <input type="text" id="signLabelInput" class="tts-btn" placeholder="Enter phrase (e.g. Hello)">
                    <button onclick="trainNewSign()" class="tts-btn secondary-btn mt-2">✋ Train Sign</button>
                    <button onclick="clearSigns()" class="tts-btn secondary-btn clear-btn mt-2">🗑️ Clear All</button>
                </div>
            </div>
        </div>
            </div>

            {{-- Save Sign Form --}}
            <form id="saveSignForm" method="POST" action="{{ url('/signs/save') }}">
                @csrf
                <input type="hidden" id="signLabelHidden" name="label">
                <input type="hidden" id="landmarksHidden" name="landmarks">
            </form>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                // Global assistant toggle from sidebar
                if (typeof window.assistantEnabled === 'undefined') {
                    window.assistantEnabled = true;
                }

                document.addEventListener("DOMContentLoaded", function() {
                    const openBtn = document.getElementById("openSidebarBtn");
                    const sidebar = document.getElementById("sidebar");

                    openBtn.onclick = function() {
                        sidebar.style.width = "250px";
                        window.assistantEnabled = false;
                        if (window.speechSynthesis?.speaking) {
                            window.speechSynthesis.cancel();
                        }
                        console.log("🔇 Assistant disabled while sidebar is open.");
                    }

                    window.closeSidebar = function() {
                        sidebar.style.width = "0";
                        window.assistantEnabled = true;
                        console.log("✅ Assistant re-enabled after closing sidebar.");
                    }

                    window.toggleVoiceAssistant = function() {
                        window.assistantEnabled = !window.assistantEnabled;
                        const label = window.assistantEnabled ? '🔇 Disable Assistant' : '🔊 Enable Assistant';
                        document.getElementById("toggleAssistantBtn").innerText = label;
                    }
                });
            </script>

            <style>
                .secondary-btn {
                    background-color: transparent;
                    border: 2px solid white;
                    color: white;
                    margin-top: 10px;
                }

                .secondary-btn:hover {
                    background-color: white;
                    color: #3674B5;
                }

                .clear-btn {
                    border-color: #ff6666;
                    color: #ff6666;
                }

                .clear-btn:hover {
                    background-color: #ff6666;
                    color: white;
                }

                .tts-section {
                    padding: 20px 30px;

                    border-radius: 12px;
                    margin: 20px 0;
                }

                .tts-label {
                    display: block;
                    color: #3674B5;
                    font-weight: bold;
                    margin-bottom: 5px;
                    font-size: 14px;
                }

                .tts-section textarea {
                    width: 100%;
                    height: 80px;
                    resize: none;
                    border: none;
                    border-radius: 10px;
                    padding: 10px;
                    font-size: 15px;
                    margin-bottom: 15px;
                    outline: none;
                    background: white;
                    color: #333;
                }

                .tts-options select {
                    width: 100%;
                    padding: 10px;
                    font-size: 15px;
                    border-radius: 8px;
                    border: none;
                    margin-bottom: 15px;
                }

                .tts-btn {
                    background-color: #3674B5;
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 10px;
                    cursor: pointer;
                    font-weight: bold;
                    width: 100%;
                    font-size: 16px;
                    transition: background-color 0.3s ease;

                }

                .tts-btn::placeholder {
                    color: white;
                    font-style: italic;
                }

                .tts-btn:hover {
                    background-color: #e6e6e6;
                }

                .fixed-btn {
                    position: fixed;
                    bottom: 30px;
                    right: 30px;
                    background-color: #3674B5;
                    color: white;
                    border: none;
                    padding: 15px 20px;
                    border-radius: 50px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                    cursor: pointer;
                    font-size: 16px;
                    z-index: 1000;
                    transition: background-color 0.3s ease;
                }

                .fixed-btn:hover {
                    background-color: #2b5f94;
                }

                .sidebar-title {
                    color: white;
                    font-size: 22px;
                    font-weight: bold;
                    text-align: start;
                    margin-bottom: 25px;
                    border-bottom: 1px solid white;
                    padding-bottom: 10px;
                    margin: 0 30px 25px 30px;
                }

                .sidebar {
                    height: 100%;
                    width: 0;
                    position: fixed;
                    top: 0;
                    right: 0;
                    background-color: #3674B5;
                    overflow-x: hidden;
                    transition: 0.3s;
                    padding-top: 60px;
                    z-index: 999;
                }

                .sidebar a {
                    padding: 10px 30px;
                    text-decoration: none;
                    font-size: 18px;
                    color: white;
                    display: block;
                    transition: 0.3s;
                }

                .sidebar a:hover {
                    background-color: white;
                    color: #3674B5;
                    border-radius: 200px;

                }

                .sidebar .closebtn {
                    position: absolute;
                    top: 40px;
                    right: 25px;
                    font-size: 25px;
                    color: white;
                    text-decoration: none;
                }

                #aslOutput {
                    font-size: 16px;
                    color: white;
                    background: #2b5f94;
                    padding: 8px;
                    border-radius: 10px;
                    text-align: center;
                }
            </style>

            <script>
                function forceStopAllRecognition() {
                    // Loop over all properties of the window to find any SpeechRecognition instances
                    for (const key in window) {
                        if (window.hasOwnProperty(key)) {
                            const obj = window[key];
                            if (
                                obj &&
                                typeof obj === 'object' &&
                                obj.constructor &&
                                (obj.constructor.name === 'SpeechRecognition' || obj.constructor.name === 'webkitSpeechRecognition') &&
                                typeof obj.stop === 'function'
                            ) {
                                try {
                                    obj.stop();
                                    console.log("🎤 Force-stopped recognition:", key);
                                } catch (err) {
                                    console.warn("⚠️ Error stopping recognition:", err);
                                }
                            }
                        }
                    }
                    if (speechSynthesis && speechSynthesis.speaking) {
                        speechSynthesis.cancel();
                        console.log("🔇 Speech synthesis cancelled.");
                    }
                }
                let voices = [];
                let lastSpokenText = '';

                // Load voices safely with fallback retry
                function loadVoices(callback) {
                    voices = speechSynthesis.getVoices();

                    if (voices.length === 0) {
                        // Retry after slight delay
                        setTimeout(() => loadVoices(callback), 100);
                    } else {
                        if (callback) callback();
                    }
                }

                function detectLanguage(text) {
                    if (/[\u0600-\u06FF]/.test(text)) return 'ar'; // Arabic
                    if (/[àâçéèêëîïôûùüÿñæœ]/i.test(text)) return 'fr'; // French
                    if (/[áéíóúñ¿¡]/i.test(text)) return 'es'; // Spanish
                    return 'en'; // Default English
                }

                function findBestVoice(langCode) {
                    return voices.find(v => v.lang.toLowerCase().startsWith(langCode)) ||
                        voices.find(v => v.lang.toLowerCase().startsWith(langCode.split('-')[0])) ||
                        voices.find(v => v.lang.toLowerCase().includes(langCode)) ||
                        voices[0];
                }

                function speakText() {
                    const text = document.getElementById('ttsInput').value.trim();
                    if (!text) return;
                    lastSpokenText = text;
                    loadVoices(() => {
                        const lang = detectLanguage(text);
                        const voice = findBestVoice(lang);

                        const utterance = new SpeechSynthesisUtterance(text);
                        utterance.voice = voice;
                        utterance.lang = voice.lang;

                        speechSynthesis.speak(utterance);
                    });
                }

                function repeatLastSpoken() {
                    if (!lastSpokenText) return;

                    speechSynthesis.cancel(); // Stop any current speech

                    loadVoices(() => {
                        const lang = detectLanguage(lastSpokenText);
                        const voice = findBestVoice(lang);

                        const utterance = new SpeechSynthesisUtterance(lastSpokenText);
                        utterance.voice = voice;
                        utterance.lang = voice.lang;

                        speechSynthesis.speak(utterance);
                    });
                }

                function pauseResume() {
                    if (speechSynthesis.speaking) {
                        if (speechSynthesis.paused) {
                            speechSynthesis.resume();
                        } else {
                            speechSynthesis.pause();
                        }
                    }
                }

                function clearText() {
                    const input = document.getElementById('ttsInput');
                    input.value = '';
                    speechSynthesis.cancel(); // stop any current speech
                }




                function quickSpeak(message) {
                    lastSpokenText = message;
                    loadVoices(() => {
                        const lang = detectLanguage(message);
                        const voice = findBestVoice(lang);

                        const utterance = new SpeechSynthesisUtterance(message);
                        utterance.voice = voice;
                        utterance.lang = voice.lang;

                        speechSynthesis.cancel(); // Stop any current speech
                        speechSynthesis.speak(utterance);
                    });
                }
                document.addEventListener("DOMContentLoaded", function() {
                    const openBtn = document.getElementById("openSidebarBtn");
                    const sidebar = document.getElementById("sidebar");

                    openBtn.onclick = function() {
                        sidebar.style.width = "250px";
                        forceStopAllRecognition(); // 💥 Force stops any live mic and speech
                    }

                    window.closeSidebar = function() {
                        sidebar.style.width = "0";
                    }

                    // Load initial voices
                    if (typeof speechSynthesis !== 'undefined') {
                        speechSynthesis.onvoiceschanged = () => {
                            loadVoices();
                        };
                        loadVoices();
                    }

                });
            </script>
            <!-- TensorFlow & HandPose -->
            <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs-core"></script>
            <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs-converter"></script>
            <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs-backend-webgl"></script>
            <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/handpose"></script>
            <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/knn-classifier"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <!-- Hidden Form for Laravel POST -->
            <form id="saveSignForm" method="POST" action="{{ url('/signs/save') }}">
                @csrf
                <input type="hidden" id="signLabelHidden" name="label">
                <input type="hidden" id="landmarksHidden" name="landmarks">
            </form>

            <script>
                let signModel, signVideo, knnClassifier;
                let lastSpokenSign = '';
                let lastSpokenTime = 0;
                let detecting = false;

                async function initSignRecognition() {
                    if (detecting) return;
                    detecting = true;

                    try {
                        signVideo = document.getElementById("signVideo");
                        const stream = await navigator.mediaDevices.getUserMedia({
                            video: true
                        });
                        signVideo.srcObject = stream;

                        signModel = await handpose.load();
                        knnClassifier = window.knnClassifier.create();

                        await loadSavedSigns();
                        detectSignLoop();
                        console.log("✅ Sign recognition initialized successfully.");
                    } catch (error) {
                        console.error("❌ Initialization Error:", error);
                        Swal.fire("Error", "Unable to access webcam or load model.", "error");
                    }
                }

                function detectSignLoop() {
                    const resultText = document.getElementById("signText");

                    async function loop() {
                        try {
                            if (!signModel || !signVideo || knnClassifier.getNumClasses() === 0) return setTimeout(loop, 1000);

                            const predictions = await signModel.estimateHands(signVideo);
                            if (predictions.length === 0) return setTimeout(loop, 1000);

                            const landmarks = predictions[0].landmarks.flat();
                            const logits = tf.tensor(landmarks, [1, 63], 'float32');

                            const prediction = await knnClassifier.predictClass(logits, 1);
                            logits.dispose();

                            const now = Date.now();
                            const topLabel = prediction.label;
                            const topConfidence = prediction.confidences[topLabel] || 0;

                            console.log("📊 Confidences:", prediction.confidences);

                            if (topConfidence > 0.8 && (topLabel !== lastSpokenSign || now - lastSpokenTime > 3000)) {
                                lastSpokenSign = topLabel;
                                lastSpokenTime = now;
                                resultText.innerText = topLabel;
                                console.log("🧠 Detected Sign:", topLabel);
                                quickSpeak(topLabel);
                            }
                        } catch (error) {
                            console.error("⚠️ Error in detection loop:", error);
                        }

                        setTimeout(loop, 1000);
                    }

                    loop();
                }

                async function trainNewSign() {
                    const label = document.getElementById("signLabelInput").value.trim().toLowerCase();
                    if (!label || !signModel) {
                        Swal.fire("Missing Input", "Please enter a label and start recognition first.", "warning");
                        return;
                    }

                    try {
                        const predictions = await signModel.estimateHands(signVideo);
                        if (predictions.length === 0) {
                            Swal.fire("No Hand Detected", "Make sure your hand is visible in front of the camera.", "info");
                            return;
                        }

                        const landmarks = predictions[0].landmarks.flat();
                        const tensor = tf.tensor(landmarks, [1, 63], 'float32');
                        knnClassifier.addExample(tensor, label);

                        await fetch("/signs/save", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                },
                                body: JSON.stringify({
                                    label: label,
                                    landmarks: JSON.stringify(landmarks)
                                })
                            }).then(res => res.json())
                            .then(data => {
                                Swal.fire({
                                    icon: 'success',
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                document.getElementById("signLabelInput").value = '';
                            }).catch(async (err) => {
                                const errorText = await err?.response?.text?.() || err.message || 'Unknown error';
                                Swal.fire("Error", errorText, "error");
                                console.error("Fetch error:", err);
                            });


                        console.log("✅ Trained and saved label:", label);

                        document.getElementById("signLabelInput").value = '';
                    } catch (error) {
                        console.error("❌ Training Error:", error);
                        Swal.fire("Error", "An error occurred while training the sign.", "error");
                    }
                }

                async function loadSavedSigns() {
                    try {
                        const response = await fetch("/signs/load", {
                            method: "GET",
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        if (!response.ok) throw new Error("Failed to load saved signs");

                        const signs = await response.json();
                        knnClassifier.clearAllClasses();

                        signs.forEach(sign => {
                            const flatLandmarks = sign.landmarks.flat();
                            if (flatLandmarks.length !== 63) {
                                console.warn(`⚠️ Skipping invalid sign: ${sign.label}`);
                                return;
                            }
                            const tensor = tf.tensor(flatLandmarks, [1, 63], 'float32');
                            knnClassifier.addExample(tensor, sign.label.toLowerCase());
                            console.log("📥 Loaded sign:", sign.label);
                        });

                        console.log(`📦 Total signs loaded: ${signs.length}`);
                    } catch (error) {
                        console.error("❌ Load Error:", error);
                        Swal.fire("Error", "Failed to load saved signs from server.", "error");
                    }
                }

                function clearSigns() {
                    if (knnClassifier) {
                        knnClassifier.clearAllClasses();
                        lastSpokenSign = '';
                        document.getElementById("signText").innerText = "None";
                        Swal.fire("Cleared", "All signs cleared from memory.", "success");
                        console.log("🧹 Signs cleared.");
                    }
                }

                document.addEventListener("DOMContentLoaded", function() {
                    const openBtn = document.getElementById("openSidebarBtn");
                    const sidebar = document.getElementById("sidebar");

                    openBtn.onclick = function() {
                        sidebar.style.width = "250px";
                    }

                    window.closeSidebar = function() {
                        sidebar.style.width = "0";
                    }
                });
            </script>
</x-layouts.app>