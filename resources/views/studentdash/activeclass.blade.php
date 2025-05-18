<x-layouts.app>
    <div class="custom-container">
        @forelse($sections as $section)
        <p class="mt-4" style="color:#729762;text-align:center;text-shadow:2px 2px 5px white;">
            <button data-text="Awesome" class="buttonpma">
                <span class="actual-text">&nbsp;Class&nbsp;{{ $section->grade->name }}&nbsp;</span>
                <span class="hover-text" aria-hidden="true">&nbsp;Class&nbsp;{{ $section->grade->name }}&nbsp;</span>
            </button>
        </p>

        <div class="custom-options">
            @foreach($section->grade->subjects as $subject)
            <div class="custom-option" style="--custom-option-bg:url('{{ asset('storage/subjects/' . $subject->image_url) }}');">
                <div class="custom-shadow"></div>
                <div class="custom-label">
                    <div class="custom-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="custom-info">
                        <div class="main">{{ $subject->name }}</div>
                        <div class="sub">
                            <form action="{{ route('lessons.bySubject') }}" method="POST">
                                @csrf
                                <input type="hidden" name="subjectId" value="{{ $subject->id }}">
                                <input type="hidden" name="sectionId" value="{{ $section->id }}">
                                <button class="view">
                                    View Lessons
                                    <svg fill="currentColor" viewBox="0 0 24 24" class="i">
                                        <path
                                            clip-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                            fill-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </form>



                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @empty
        <p class="text-center mt-4">No active class available for this student.</p>
        @endforelse
    </div>
</x-layouts.app>
<style>
    /* General reset for consistent layout behavior */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* Container styles */
    .custom-container {
        padding: 20px;
    }

    /* Wrapper for the custom options */
    .custom-options {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin-top: 20px;
    }

    /* Individual custom option */
    .custom-option {
        position: relative;
        overflow: hidden;
        width: 300px;
        height: 200px;
        background: var(--custom-option-bg, #E6E9ED);
        background-size: cover;
        /* background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent); */
        background-position: center;
        border-radius: 15px;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease, filter 0.3s ease;
    }

    /* Hover effect for custom option */
    .custom-option:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        filter: brightness(0.9);
        /* Darken image slightly on hover */
    }

    /* Dark gradient shadow overlay at the bottom of the option */
    .custom-shadow {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 80px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
    }

    /* Label section at the bottom of the option */
    .custom-label {
        position: absolute;
        bottom: 10px;
        left: 10px;
        color: white;
        z-index: 2;
        font-family: 'Roboto', sans-serif;
    }

    /* Icon within the label */
    .custom-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        color: #3674B5;
        margin-bottom: 10px;
    }

    /* Main text inside the label */
    .custom-info .main {
        font-size: 1.2rem;
        font-weight: bold;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        /* Add subtle shadow to text for readability */
    }

    /* Subtext inside the label */
    .custom-info .sub {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    /* Responsive adjustments */
    @media screen and (max-width: 768px) {
        .custom-options {
            gap: 15px;
        }

        .custom-option {
            width: 250px;
            height: 180px;
        }
    }

    @media screen and (max-width: 480px) {
        .custom-options {
            gap: 10px;
        }

        .custom-option {
            width: 200px;
            height: 150px;
        }

        .custom-label {
            font-size: 0.9rem;
        }

        .custom-icon {
            width: 35px;
            height: 35px;
            font-size: 18px;
        }
    }
</style>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const synth = window.speechSynthesis;
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

        if (!SpeechRecognition || !synth) {
            alert("Your browser does not support speech recognition or synthesis.");
            return;
        }

        const recognition = new SpeechRecognition();
        recognition.continuous = true;
        recognition.lang = 'en-US';

        let isListening = true;

        function speak(text, callback) {
            if (synth.speaking) synth.cancel();
            const utter = new SpeechSynthesisUtterance(text);
            utter.lang = 'en-US';
            utter.rate = 1;
            utter.onend = () => {
                if (callback) setTimeout(callback, 300);
            };
            synth.speak(utter);
        }

        function normalize(text) {
            return text.toLowerCase().replace(/[^a-z\s]/gi, '').trim();
        }

        function has(words, transcript) {
            return words.every(word => transcript.includes(word));
        }

        function restartRecognition() {
            try {
                recognition.stop();
                setTimeout(() => {
                    recognition.start();
                }, 500);
            } catch (e) {
                console.warn('Recognition restart failed:', e.message);
            }
        }

        function handleSubjectNavigation(transcript) {
            const cleanedTranscript = normalize(
                transcript
                .replace(/enter|lessons|lesson|for|subject/gi, '')
            );

            console.log('🎯 Searching for subject:', `"${cleanedTranscript}"`);
            let matched = false;

            document.querySelectorAll('.custom-option').forEach(option => {
                const name = option.querySelector('.main')?.textContent.trim().toLowerCase();
                const normalizedName = normalize(name);

                if (normalizedName.includes(cleanedTranscript)) {
                    const form = option.querySelector('form');
                    if (form) {
                        matched = true;
                        console.log(`✅ Matched: "${normalizedName}"`);
                        speak(`Opening lessons for ${normalizedName}`, () => form.submit());
                    }
                }
            });

           
        }

        function processTranscript(transcript) {
            const text = normalize(transcript);
            console.log('🎧 Heard:', text);

            if (has(['enter', 'dashboard'], text)) {
                window.location.href = "{{ route('studentdash.dashboard') }}";

            } else if (has(['enter', 'classes'], text)) {
                window.location.href = "{{ route('studentdash.classes') }}";

            } else if (has(['enter', 'active', 'class'], text)) {
                window.location.href = "{{ route('studentdash.activeclass') }}";

            } else if (text.includes('lesson')) {
                handleSubjectNavigation(text);

            } else if (has(['stop', 'listening'], text)) {
                isListening = false;
                recognition.stop();
                speak("Listening stopped. Say start listening to resume.");

            } else if (has(['start', 'listening'], text)) {
                isListening = true;
                recognition.start();
                speak("Voice control resumed.");

            } else {
                speak("Sorry, I didn't understand that. Try saying: enter my classes or enter lessons for math.", () => {
                    restartRecognition();
                });
            }
        }

        recognition.onresult = (event) => {
            const transcript = event.results[event.resultIndex][0].transcript;
            processTranscript(transcript);
        };

        recognition.onerror = (event) => {
            console.error('❌ Speech recognition error:', event);
            if (event.error !== 'aborted') {
                speak("There was an error. Please try again.", () => {
                    restartRecognition();
                });
            }
        };

        // Greet and start
        setTimeout(() => {
            speak("Welcome to your class dashboard. You can say: enter my classes, enter my active class, or enter lessons for math or science.", () => {
                recognition.start();
            });
        }, 800);
    });
</script>


