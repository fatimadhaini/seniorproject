<x-layouts.app>
    <div class="container py-4">
        <div class="text-center mb-4">
            <button data-text="Awesome" class="buttonpma">
                <span class="actual-text">&nbsp;Lessons&nbsp;for&nbsp;{{ $subjectName }}&nbsp;</span>
                <span class="hover-text" aria-hidden="true">&nbsp;Lessons&nbsp;for&nbsp;{{ $subjectName }}&nbsp;</span>
            </button>
        </div>

        <div class="text-center mb-3">
            <button id="startReadingBtn" onclick="triggerReadingManually()" class="view" style="display:none">📖 Start Reading</button>
        </div>

        <p><strong>Teacher:</strong> {{ $teacherName }}</p>

        <div class="table-responsive">
            <table id="lessonsTable" class="table table-striped table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Lesson Name</th>
                        <th>Description</th>
                        <th>Video</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->title }}</td>
                        <td>{{ $lesson->description }}</td>
                        <td>
                            @if($lesson->video)
                            <a href="{{ Storage::url($lesson->video) }}" target="_blank">View Video</a>
                            @else
                            N/A
                            @endif
                        </td>
                        <td>
                            @if($lesson->pdf)
                            <a href="{{ Storage::url($lesson->pdf) }}" target="_blank">View PDF</a><br>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2 translateBrailleBtn"
                                data-url="{{ Storage::url($lesson->pdf) }}"
                                data-title="{{ $lesson->title }}">
                                ♿ Translate to Braille
                            </button>
                            @else
                            N/A
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No lessons available for this subject in this section.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Voice Control Buttons -->
        <div style="position: fixed; bottom: 20px; left: 300px; z-index: 9999;">
            <button onclick="pauseReading()" style="margin-right: px;">⏸️ Pause</button>
            <button onclick="resumeReading()" style="margin-right: 5px;">▶️ Resume</button>
            <button onclick="stopReading()">⏹️ Stop</button>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>
    <script>
        $(document).ready(() => {
            $('#lessonsTable').DataTable();

            $('.translateBrailleBtn').on('click', function() {
                const fileUrl = $(this).data('url');
                const title = $(this).data('title');

                Swal.fire({
                    title: 'Generating Braille...',
                    html: 'Please wait while we convert this lesson to Braille format.',
                    didOpen: () => Swal.showLoading(),
                    allowOutsideClick: false
                });
                speak('Generating Braille. Please wait while we convert this lesson to Braille format.');

                $.ajax({
                    url: "{{ route('translate-to-braille') }}",
                    method: "POST",
                    data: {
                        fileUrl: fileUrl,
                        lessonTitle: title,
                        _token: "{{ csrf_token() }}"
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(data) {
                        const blob = new Blob([data], {
                            type: "text/plain"
                        });
                        const downloadUrl = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = downloadUrl;
                        a.download = `${title.trim().replace(/\s+/g, '_').toLowerCase()}_braille.txt`;
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);

                        Swal.close();
                        speakAndAlert('✅ Success', 'Braille file downloaded.', 'success');
                    },
                    error: function(xhr) {
                        let message = 'Something went wrong.';
                        if (xhr.responseJSON?.error) {
                            message = xhr.responseJSON.error;
                        }
                        speakAndAlert('Error', message, 'error');
                    }
                });
            });
        });

        function pauseReading() {
            if (synth.speaking && !synth.paused) {
                synth.pause();
                speakAndAlert('Paused', 'Reading paused.', 'success');
            }
        }

        function resumeReading() {
            if (synth.paused) {
                synth.resume();
                speakAndAlert('Resumed', 'Reading resumed.', 'success');
            }
        }

        function stopReading() {
            if (synth.speaking || synth.paused) {
                synth.cancel();
                speakAndAlert('Stopped', 'Reading stopped.', 'success');
            }
        }
    </script>
    <script>
        const synth = window.speechSynthesis;
        let userHasInteracted = false;
        let selectedLessonTitle = null;

        function waitForVoices(callback) {
            let voices = synth.getVoices();
            if (voices.length) return callback(voices);
            const interval = setInterval(() => {
                voices = synth.getVoices();
                if (voices.length) {
                    clearInterval(interval);
                    callback(voices);
                }
            }, 100);
        }

        function speak(text, callback = null) {
            if (!userHasInteracted || !text) return;
            if (synth.speaking) synth.cancel();

            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'en-US';
            waitForVoices((voices) => {
                const voice = voices.find(v => v.name.includes('Google US English') || v.lang.startsWith('en')) || voices[0];
                if (voice) utterance.voice = voice;
                if (callback) utterance.onend = () => setTimeout(callback, 500);
                synth.speak(utterance);
            });
        }

        async function readLessonDocument(title) {
            const rows = document.querySelectorAll('#lessonsTable tbody tr');
            for (const row of rows) {
                const lessonName = row.cells[0]?.textContent.trim().toLowerCase();
                if (lessonName.includes(title.toLowerCase())) {
                    const fileLink = row.cells[3]?.querySelector('a')?.href;
                    const extension = fileLink.split('.').pop().toLowerCase();
                    let text = '';

                    try {
                        if (extension === 'pdf') {
                            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';
                            const pdf = await pdfjsLib.getDocument(fileLink).promise;
                            for (let i = 1; i <= pdf.numPages; i++) {
                                const page = await pdf.getPage(i);
                                const content = await page.getTextContent();
                                text += content.items.map(item => item.str).join(' ') + '\n';
                            }
                        } else if (extension === 'txt') {
                            const res = await fetch(fileLink);
                            text = await res.text();
                        } else if (extension === 'docx') {
                            const res = await fetch(fileLink);
                            const buffer = await res.arrayBuffer();
                            const result = await mammoth.extractRawText({
                                arrayBuffer: buffer
                            });
                            text = result.value;
                        }

                        speak(text, askIfNeedAnythingElse);
                    } catch {
                        speak("I couldn't read the file. Please try again later.", askIfNeedAnythingElse);
                    }
                    return;
                }
            }

            speak("Sorry, I couldn't find that lesson.", askIfNeedAnythingElse);
        }


        function openLessonVideo(title) {
            const rows = document.querySelectorAll('#lessonsTable tbody tr');
            for (const row of rows) {
                const name = row.cells[0]?.textContent.trim().toLowerCase();
                if (name.includes(title.toLowerCase())) {
                    const videoLink = row.cells[2]?.querySelector('a');
                    if (videoLink) {
                        window.open(videoLink.href, '_blank');
                        speak(`Opening video for ${title}`, askIfNeedAnythingElse);
                        return;
                    }
                }
            }
            speak("Sorry, no video found for that lesson.", askIfNeedAnythingElse);
        }


        function convertToBraille(title) {
            const rows = document.querySelectorAll('#lessonsTable tbody tr');
            for (const row of rows) {
                const name = row.cells[0]?.textContent.trim().toLowerCase();
                if (name.includes(title.toLowerCase())) {
                    const btn = row.querySelector('.translateBrailleBtn');
                    if (btn) {
                        btn.click();
                        speak("Converting to Braille. Your download will begin shortly.", askIfNeedAnythingElse);
                        return;
                    }
                }
            }
            speak("No Braille option found for this lesson.", askIfNeedAnythingElse);
        }

        function askIfNeedAnythingElse() {
            speak("Would you like help with anything else for this lesson, or a different one?", () => {
                listenForActionCommand(); // let them say another command
            });
        }

        function readAllLessons() {
            const rows = document.querySelectorAll('#lessonsTable tbody tr');
            if (!rows.length) {
                speak("There are no lessons available right now.", askIfNeedAnythingElse);
                return;
            }

            let message = `You have ${rows.length} lessons. Here they are: `;

            rows.forEach((row, index) => {
                const title = row.cells[0]?.textContent.trim();
                const description = row.cells[1]?.textContent.trim();
                if (title) {
                    message += `Lesson ${index + 1}: ${title}.`;
                    if (description) {
                        message += ` Description: ${description}. `;
                    }
                }
            });

            speak(message, askIfNeedAnythingElse);
        }


        function listenForActionCommand() {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            if (!SpeechRecognition) return;

            const recognition = new SpeechRecognition();
            recognition.continuous = false;
            recognition.lang = 'en-US';

            recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript.toLowerCase().trim();
                console.log("🎤 User said:", transcript);

                if (transcript.includes("read all lessons") || transcript.includes("read the table") || transcript.includes("list lessons")) {
                    speak("Reading all available lessons now.", () => readAllLessons());
                } else if (transcript.includes("video")) {
                    speak("Opening the video now.", () => openLessonVideo(selectedLessonTitle));
                } else if (transcript.includes("read") || transcript.includes("pdf")) {
                    speak("Reading the document out loud.", () => readLessonDocument(selectedLessonTitle));
                } else if (transcript.includes("braille")) {
                    convertToBraille(selectedLessonTitle);
                } else if (transcript.includes("new lesson") || transcript.includes("another lesson")) {
                    startAssistantFlow();
                } else if (transcript.includes("exit") || transcript.includes("no thanks")) {
                    speak("Okay, I'm here if you need me again.");
                } else {
                    speak("Sorry, I didn't catch that. You can say: read all lessons, video, read the PDF, Braille, or another lesson.", () => {
                        setTimeout(listenForActionCommand, 1000);
                    });
                }
            };

            recognition.onerror = (event) => {
                console.error("🎙️ Speech recognition error:", event.error);
                speak("There was an error understanding your command. Please try again.", () => {
                    setTimeout(listenForActionCommand, 1000);
                });
            };

            recognition.start();
        }


        function startAssistantFlow() {
            speak("Welcome to your lesson center. Which lesson would you like me to help you with?", () => {
                const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                if (!SpeechRecognition) return;

                const recognition = new SpeechRecognition();
                recognition.continuous = false;
                recognition.lang = 'en-US';

                recognition.onresult = (event) => {
                    const transcript = event.results[0][0].transcript.toLowerCase().replace(/[.?!]/g, '');
                    selectedLessonTitle = transcript.trim();
                    speak(`Great. For the lesson titled ${selectedLessonTitle}, would you like to enter the video, read the PDF out loud, or convert it to Braille and download it?`, () => {
                        setTimeout(listenForActionCommand, 1000);
                    });
                };

                recognition.onerror = () => {
                    speak("Sorry, I couldn't hear the lesson name. Please try again.");
                };

                recognition.start();
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            let hasStarted = false;

            function tryStartAssistant() {
                if (!userHasInteracted && !hasStarted) {
                    userHasInteracted = true;
                    hasStarted = true;
                    startAssistantFlow();
                }
            }

            // Attempt auto-start (will work if coming from a previously unlocked page)
            setTimeout(tryStartAssistant, 1000);

            // Fallback: enable on first user interaction
            document.body.addEventListener('click', tryStartAssistant, {
                once: true
            });
            document.body.addEventListener('keydown', tryStartAssistant, {
                once: true
            });
        });
    </script>




</x-layouts.app>
