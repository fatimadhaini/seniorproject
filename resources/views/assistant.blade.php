<x-layouts.app>
    <div class="container-fluid px-3 px-md-5">
        <p class="mt-4 text-center" style="color:#729762;text-shadow:2px 2px 5px white;">
            <button data-text="Awesome" class="buttonpma">
                <span class="actual-text">&nbsp;Assistant&nbsp;</span>
                <span class="hover-text" aria-hidden="true">&nbsp;Assistant&nbsp;</span>
            </button>
        </p>

        <div class="container py-4">
            <div class="chat-box p-4 bg-light rounded shadow" style="max-height: 70vh; overflow-y: auto;">
                <div id="chatLog">
                    <!-- Chat messages will appear here -->
                </div>
            </div>

            <div class="mt-3 d-flex align-items-center gap-2">
                <input type="text" id="assistantQuestion" class="form-control shadow-sm" placeholder="Ask anything...">
                <button onclick="startVoiceInput()" class="btn btn-outline-secondary">🎙</button>
                <button onclick="askAssistant()" class="btn btn-primary">Send</button>
            </div>
        </div>

        <script>
            function addMessage(role, text) {
                const chatLog = document.getElementById('chatLog');
                const msg = document.createElement('div');
                msg.className = `mb-3 p-3 rounded ${role === 'user' ? 'bg-primary text-white text-end' : 'bg-white border text-start'}`;
                msg.innerHTML = `<strong>${role === 'user' ? 'You' : 'Assistant'}:</strong> <br>${text}`;
                chatLog.appendChild(msg);
                chatLog.scrollTop = chatLog.scrollHeight;
            }

            async function askAssistant() {
                const input = document.getElementById('assistantQuestion');
                const rawInput = input.value.trim();
                if (!rawInput) return;

                addMessage('user', rawInput);
                input.value = '';
                const cleaned = rawInput.toLowerCase()
                    .replace(/^(what is|who is|where is|define|explain|tell me about|describe|how does|what are|how to)\s+/i, '')
                    .replace(/[^a-zA-Z0-9\s]/g, '')
                    .trim()
                    .replace(/\s+/g, '_');

                const query = encodeURIComponent(cleaned.charAt(0).toUpperCase() + cleaned.slice(1));

                try {
                    const res = await fetch(`https://en.wikipedia.org/api/rest_v1/page/summary/${query}`);
                    if (!res.ok) throw new Error("No matching article found.");

                    const data = await res.json();
                    let reply = `<strong>${data.title}</strong><br>${data.extract}`;
                    if (data.thumbnail && data.thumbnail.source) {
                        reply += `<br><img src="${data.thumbnail.source}" alt="${data.title}" style="max-height:100px;">`;
                    }
                    reply += `<br><a href="${data.content_urls.desktop.page}" target="_blank">Read more</a>`;

                    addMessage('assistant', reply);
                    const utter = new SpeechSynthesisUtterance(data.extract);
                    speechSynthesis.speak(utter);
                } catch (err) {
                    console.error(err);
                    addMessage('assistant', '❌ No matching Wikipedia article found.');
                }
            }

            function startVoiceInput() {
                const recognition = new(window.SpeechRecognition || window.webkitSpeechRecognition)();
                recognition.lang = 'en-US';
                recognition.interimResults = false;
                recognition.maxAlternatives = 1;

                recognition.onresult = function(event) {
                    const transcript = event.results[0][0].transcript;
                    document.getElementById('assistantQuestion').value = transcript;
                    askAssistant();
                };

                recognition.onerror = function(event) {
                    alert("Voice input error: " + event.error);
                };

                recognition.start();
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    </div>
</x-layouts.app>