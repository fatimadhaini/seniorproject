<x-layouts.app>
    <div class="container-fluid px-3 px-md-5">
        <p class="mt-4 text-center" style="color:#729762;text-shadow:2px 2px 5px white;">
            <button data-text="Awesome" class="buttonpma">
                <span class="actual-text">&nbsp;Dashboard&nbsp;</span>
                <span class="hover-text" aria-hidden="true">&nbsp;Dashboard&nbsp;</span>
            </button>
        </p>

        <div class="row">
            <!-- Left Column: ID Card + Flip Card -->
            <div class="col-12 col-md-4 mt-5 mb-4 d-flex flex-column align-items-center">
                <div class="id-card-tag"></div>
                <div class="id-card-tag-strip"></div>
                <div class="id-card-hook"></div>

                <div class="id-card-holder mb-4">
                    <div class="id-card">
                        <div class="header">
                            <img src="../assets/img/visionvoicelogo.png" class="img-fluid" alt="Vision Voice Logo">
                        </div>
                        <div class="photo text-center">
                            @if($student->application->profile_img)
                            <img src="{{ Storage::url($student->application->profile_img) }}" alt="Profile Image" class="img-fluid mb-2" style="max-height: 100px;">
                            @else
                            <p>N/A</p>
                            @endif
                            <h2 class="fs-5">{{ $student->application->first_name }} {{ $student->application->last_name }}</h2>
                            <h3 class="fs-6">{{ $student->user->email }}</h3>
                            <hr>
                            <p class="p"><strong>Email:</strong> Visionvoice@gmail.com</p>
                            <p class="p"><strong>Phone:</strong> +961 70074639</p>
                        </div>
                    </div>
                </div>

                <!-- Flip Card -->
                <div class="flip-card-wrapper d-flex justify-content-center">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <div class="p-3 bg-white">
                                    <p class="heading_8264">Student - Vision Voice</p>
                                    <img src="../assets/img/visionvoicelogo.png" class="logo" width="36" height="36">

                                    <div class="row">
                                        <div class="col-4">
                                            <img class="chip rounded-pill" id="image0" width="70" height="70" src="{{ Storage::url($student->application->profile_img) }}">
                                        </div>
                                        <div class="col-8 text-start">
                                            <p class="ppp">
                                                <span class="fw-bold" style="font-size: 1.2em">{{ $student->application->first_name }} {{ $student->application->last_name }}</span><br>
                                                {{ $student->user->email }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flip-card-back d-flex flex-column justify-content-center align-items-center">
                                <div class="strip text-center">Vision Voice School</div>
                                <div class="mstrip text-center p-2">
                                    <p>Email: Visionvoice@gmail.com<br>Phone: +961 70074639</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Calendar -->
            <div class="col-12 col-md-8 mb-4">
                <div class="card mt-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Upcoming Exams & Events</h5>
                    </div>
                    <div class="card-body">
                        <div id="dashboard-calendar"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- External Assets -->
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    </div>
</x-layouts.app>

<style>
    h5 {
        color: white;
    }

    .flip-card {
        background-color: transparent;
        width: 240px;
        height: 154px;
        perspective: 1000px;
        color: white;
    }

    .heading_8264 {
        position: absolute;
        letter-spacing: .2em;
        font-size: 0.5em;
        top: 2em;
        left: 13.6em;
    }

    .logo {
        position: absolute;
        top: 6.8em;
        left: 11.7em;
    }

    .chip {
        position: absolute;
        top: 2.3em;
        left: 1em;
    }

    .contactless {
        position: absolute;
        top: 3.5em;
        left: 12.4em;
    }

    .number {
        padding-left: 7px;
        padding: 2px;

        /* font-weight: bold; */
        font-size: .6em;
        /* top: 9em; */
        /* left: 5em; */
    }


    .name {
        position: absolute;
        font-weight: bold;
        font-size: 0.5em;
        top: 16.1em;
        left: 2em;
    }

    .strip {
        color: #3674B5;
        position: absolute;
        background-color: #EEF7FF;
        width: 15em;
        height: 1.5em;
        top: 2.4em;
        background: repeating-linear-gradient(45deg,
                #EEF7FF,
                #EEF7FF 10px,
                #CDE8E5 10px,
                #CDE8E5 20px);
    }



    .mstrip p {

        font-size: 0.7em;
        padding: 2px;
    }

    .ppp {
        color: #3674B5;
        font-size: 0.7em;

    }

    .mstrip {
        justify-content: start;
        color: #3674B5;
        position: absolute;
        background-color: #EEF7FF;
        width: 90%;
        height: 30%;
        top: 5em;
        left: .8em;
        border-radius: 4px;
    }

    .sstrip {
        position: absolute;
        background-color: #EEF7FF;
        width: 4.1em;
        height: 0.8em;
        top: 5em;
        left: 10em;
        border-radius: 2.5px;
    }

    .code {
        font-weight: bold;
        text-align: center;
        margin: .2em;
        color: black;
    }

    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.8s;
        transform-style: preserve-3d;
    }

    .flip-card:hover .flip-card-inner {
        transform: rotateY(180deg);
    }

    .flip-card-front,
    .flip-card-back {
        box-shadow: 0 8px 14px 0 rgba(0, 0, 0, 0.2);
        position: absolute;
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 100%;
        height: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        border-radius: 1rem;
    }

    .flip-card-front {
        /* margin-left: 70px; */
        box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 2px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -1px 0px inset;
        background-color: #3674B5;
    }

    .flip-card-back {
        /* margin-left: -70px; */
        box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 2px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -1px 0px inset;
        background-color: #3674B5;
        transform: rotateY(180deg);
    }

    .id-card-holder {
        width: 225px;
        padding: 4px;
        margin: 0 auto;
        background-color: #3674B5;
        border-radius: 5px;
        position: relative;
    }

    .id-card-holder:after {
        content: '';
        width: 7px;
        display: block;
        background-color: #3674B5;
        height: 100px;
        position: absolute;
        top: 105px;
        border-radius: 0 5px 5px 0;
    }

    .id-card-holder:before {
        content: '';
        width: 7px;
        display: block;
        background-color: #3674B5;
        height: 100px;
        position: absolute;
        top: 105px;
        left: 222px;
        border-radius: 5px 0 0 5px;
    }

    .id-card {

        background-color: #fff;
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 0 1.5px 0px #fff;
    }

    .id-card img {
        margin: 0 auto;
    }

    .header img {
        width: 100px;
        margin-top: 15px;
    }

    .photo img {
        width: 80px;
        margin-top: 15px;
    }

    h2 {
        font-size: 15px;
        margin: 5px 0;
        color: #3674B5;
    }

    h3 {
        font-size: 12px;
        margin: 2.5px 0;
        font-weight: 300;
    }

    .qr-code img {
        width: 50px;
    }

    .p {
        font-size: 10px;
        margin: 2px;
    }

    .id-card-hook {
        background-color: #000;
        width: 70px;
        margin: 0 auto;
        height: 15px;
        border-radius: 5px 5px 0 0;
    }

    .id-card-hook:after {
        content: '';
        background-color: #fff;
        width: 47px;
        height: 6px;
        display: block;
        margin: 0px auto;
        position: relative;
        top: 6px;
        border-radius: 4px;
    }

    .id-card-tag-strip {
        width: 45px;
        height: 40px;
        background-color: #3674B5;
        margin: 0 auto;
        border-radius: 5px;
        position: relative;
        top: 9px;
        z-index: 1;
        border: 1px solid #3674B5;
    }

    .id-card-tag-strip:after {
        content: '';
        display: block;
        width: 100%;
        height: 1px;
        background-color: #fff;
        position: relative;
        top: 10px;
    }

    .id-card-tag {
        width: 0;
        height: 0;
        border-left: 100px solid transparent;
        border-right: 100px solid transparent;
        border-top: 100px solid #3674B5;
        margin: -10px auto -30px auto;
    }

    .id-card-tag:after {
        content: '';
        display: block;
        width: 0;
        height: 0;
        border-left: 50px solid transparent;
        border-right: 50px solid transparent;
        border-top: 100px solid #f8f9fa;
        margin: -10px auto -30px auto;
        position: relative;
        top: -130px;
        left: -50px;
    }
</style>

<script>
    let calendarInstance = null;
    let active = true;

    document.addEventListener('DOMContentLoaded', function() {
        // === Setup FullCalendar ===
        const calendarEl = document.getElementById('dashboard-calendar');
        calendarInstance = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 'auto',
            events: '/calendar/events',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            eventColor: '#0d6efd',
            eventDisplay: 'block',
            eventClick: function(info) {
                const event = info.event;
                Swal.fire({
                    title: event.title,
                    html: `
                        <p><strong>Date:</strong> ${event.start.toLocaleDateString()}</p>
                        ${event.extendedProps.description ? `<p><strong>Description:</strong> ${event.extendedProps.description}</p>` : ''}
                        ${event.extendedProps.type ? `<p><strong>Type:</strong> ${event.extendedProps.type}</p>` : ''}
                    `,
                    icon: 'info',
                    confirmButtonColor: '#3674B5'
                });
            }
        });
        calendarInstance.render();

        // === Voice Assistant + Navigation ===
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        const synth = window.speechSynthesis;

        if (!SpeechRecognition || !synth) return alert("Speech features not supported.");

        const recognition = new SpeechRecognition();
        recognition.continuous = false;
        recognition.lang = 'en-US';
        recognition.interimResults = false;
        recognition.maxAlternatives = 1;

        function speak(text, callback) {
            if (synth.speaking) synth.cancel();
            const utter = new SpeechSynthesisUtterance(text);
            utter.lang = 'en-US';
            utter.rate = 1;
            if (callback) utter.onend = () => setTimeout(callback, 500);
            synth.speak(utter);
        }

        function getCalendarEvents() {
            return calendarInstance ? calendarInstance.getEvents() : [];
        }

        function isSameDay(d1, d2) {
            return d1.getFullYear() === d2.getFullYear() &&
                d1.getMonth() === d2.getMonth() &&
                d1.getDate() === d2.getDate();
        }

        function speakCalendarEvents(callback) {
            const now = new Date();
            now.setHours(0, 0, 0, 0);

            const upcoming = getCalendarEvents().filter(e => {
                const eventDate = new Date(e.start instanceof Date ? e.start : e.start.replace(" ", "T"));
                eventDate.setHours(0, 0, 0, 0);
                return eventDate >= now;
            });

            if (upcoming.length === 0) return speak("You have no upcoming events.", callback);

            let message = "Here are your upcoming events: ";
            upcoming.slice(0, 5).forEach(e => {
                message += `${e.title} on ${new Date(e.start).toLocaleDateString()}. `;
            });
            speak(message, callback);
        }

        function askForSpecificDate(callback) {
            const date = {
                year: '',
                month: '',
                day: ''
            };

            function askYear() {
                speak("What year?", () => {
                    recognition.start();
                    recognition.onresult = e => {
                        date.year = e.results[0][0].transcript.match(/\d{4}/)?.[0];
                        if (!date.year) return speak("Please say a valid year.", askYear);
                        askMonth();
                    };
                });
            }

            function askMonth() {
                speak("Which month?", () => {
                    recognition.start();
                    recognition.onresult = e => {
                        const spoken = e.results[0][0].transcript.toLowerCase();
                        const months = ["january", "february", "march", "april", "may", "june",
                            "july", "august", "september", "october", "november", "december"
                        ];

                        let matchedIndex = months.findIndex(m => spoken.includes(m));
                        if (matchedIndex === -1) {
                            const fuzzy = {
                                jan: 0,
                                feb: 1,
                                mar: 2,
                                apr: 3,
                                may: 4,
                                jun: 5,
                                jul: 6,
                                aug: 7,
                                sep: 8,
                                oct: 9,
                                nov: 10,
                                dec: 11
                            };
                            for (const [key, index] of Object.entries(fuzzy)) {
                                if (spoken.includes(key)) {
                                    matchedIndex = index;
                                    break;
                                }
                            }
                        }

                        if (matchedIndex === -1) return speak("Sorry, I couldn't understand the month. Please say it again.", askMonth);

                        date.month = matchedIndex + 1;
                        askDay();
                    };
                });
            }

            function askDay() {
                speak("Which day?", () => {
                    recognition.start();
                    recognition.onresult = e => {
                        date.day = e.results[0][0].transcript.match(/\d{1,2}/)?.[0];
                        if (!date.day) return speak("Please say a valid day.", askDay);
                        readEventsOnDate(callback);
                    };
                });
            }

            function readEventsOnDate(cb) {
                const parsedDate = new Date(`${date.year}-${date.month}-${date.day}`);
                if (isNaN(parsedDate)) return speak("Invalid date. Try again.", cb);

                const matching = getCalendarEvents().filter(e =>
                    isSameDay(new Date(e.start instanceof Date ? e.start : e.start.replace(" ", "T")), parsedDate)
                );
                if (matching.length === 0) return speak(`No events found on ${parsedDate.toDateString()}.`, cb);

                let message = `On ${parsedDate.toDateString()}, you have: `;
                matching.forEach(e => message += `${e.title}. `);
                speak(message, cb);
            }

            askYear();
        }

        function handleCommand(text) {
            const command = text.toLowerCase();
            const has = (keywords) => keywords.every(k => command.includes(k));

            // Navigation
            if (has(['enter', 'dashboard'])) {
                return window.location.href = "{{ route('studentdash.dashboard') }}";
            }
            if (has(['enter', 'classes'])) {
                return window.location.href = "{{ route('studentdash.classes') }}";
            }
            if (has(['enter', 'active', 'class'])) {
                return window.location.href = "{{ route('studentdash.activeclass') }}";
            }

            // Assistant
            if (command.includes("stop") || command.includes("exit")) {
                active = false;
                return speak("Voice assistant stopped.");
            }

            if (command.includes("calendar") || command.includes("read events") || command.includes("upcoming")) {
                document.getElementById('dashboard-calendar')?.scrollIntoView({
                    behavior: 'smooth'
                });
                return speak("Here are your upcoming events.", () => speakCalendarEvents(startListening));
            }

            if (command.includes("specific day") || command.includes("events on") || command.includes("check date")) {
                return askForSpecificDate(startListening);
            }

            speak("You can say: read my calendar or check events on a specific date.", startListening);
        }

        function startListening() {
            if (!active) return;
            recognition.start();
            recognition.onresult = e => handleCommand(e.results[0][0].transcript);
            recognition.onerror = () => speak("Try again, please.", startListening);
        }

        // Initial greeting
        setTimeout(() => {
            speak("Welcome to your dashboard. You can say: read my calendar, or check events on a specific date or Enter my classes or enter my active class", startListening);
        }, 1000);
    });
</script>



<style>
    #dashboard-calendar {
        max-width: 100%;
        margin: 0 auto;
    }

    .fc-toolbar-title {
        font-size: 1.25rem;
    }
</style>


