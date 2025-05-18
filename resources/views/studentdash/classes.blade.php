<x-layouts.app>
    <div class="container">
        <p class="mt-4" style="color:#729762;text-align:center;text-shadow:2px 2px 5px white;">
            <button data-text="Awesome" class="buttonpma">
                <span class="actual-text">&nbsp;Classes&nbsp;</span>
                <span class="hover-text" aria-hidden="true">&nbsp;Classes&nbsp;</span>
            </button>
        </p>

        <div class="table-responsive">
            <table id="academicyears" class="table table-striped table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Academic Year</th>
                        <th>Class Name</th>
                        <th>Subjects</th>

                        <th>Grades</th>
                        <th>View Attendance</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sections as $section)
                    <tr>
                        <td>{{ $section->academicYear->name ?? 'N/A' }}</td>
                        <td>{{ $section->grade->name ?? 'N/A' }}</td>
                        <td>
                            <ul>
                                @foreach($section->grade->subjects as $subject)
                                <li>{{ $subject->name }}</li>
                                @endforeach
                            </ul>
                        </td>

                        <td class="text-center">

                            <div class="btn-conteiner">
                                <a class="btn-content" href="{{ route('studentdash.viewGrades', $section->id) }}">
                                    <span class="btn-title">View Grades</span>
                                    <span class="icon-arrow">
                                        <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <path id="arrow-icon-one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                                <path id="arrow-icon-two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                                <path id="arrow-icon-three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                            </div>

                        </td>
                        <td class="text-center">

                            <div class="btn-conteiner">
                                <a class="btn-content" href="{{ route('student.attendance.calendar', $section->id) }}">
                                    <span class=" btn-title">View Attendance</span>
                                    <span class="icon-arrow">
                                        <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <path id="arrow-icon-one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                                <path id="arrow-icon-two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                                <path id="arrow-icon-three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                            </div>

                        </td>

                        <td class="text-center">
                            @php
                            $pivot = $section->pivot;
                            @endphp

                            @if($pivot->status === 'active')
                            <span class="badge bg-warning text-dark">⏳ Not finalized yet</span>
                            @elseif($pivot->status === 'pass')
                            <div class="d-flex flex-column align-items-center">
                                <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                                <dotlottie-player src="https://lottie.host/c5b5b45f-720c-4993-bfa4-1ee8078a4ea1/QKp2UNm6GW.lottie" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay></dotlottie-player>
                                <span class="mt-2 badge bg-success">✅ Passed — Grade: {{ $pivot->final_grade ?? 'N/A' }}</span>
                            </div>
                            @elseif($pivot->status === 'fail')
                            <div class="d-flex flex-column align-items-center">
                                <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                                <dotlottie-player src="https://lottie.host/9dc84801-8db6-4bb2-bcb0-e2a5e09ea9a4/7DhZbHxrLb.lottie" background="transparent" speed="1" style="width: 100px; height: 100px;" loop autoplay></dotlottie-player>
                                <span class="mt-2 badge bg-danger">❌ Failed — Grade: {{ $pivot->final_grade ?? 'N/A' }}</span>
                            </div>
                            @endif
                        </td>


                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No sections available for this student.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <style>
        /* From Uiverse.io by Li-Deheng */
        .btn-conteiner {
            margin-top: 25%;
            display: flex;
            justify-content: center;
            --color-text: #ffffff;
            --color-background: #3674B5;
            --color-outline: #3674B5;
            --color-shadow: #00000080;
        }

        .btn-content {
            display: flex;
            align-items: center;
            padding: 5px 30px;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 20px;
            color: var(--color-text);
            background: var(--color-background);
            transition: 1s;
            border-radius: 100px;
            box-shadow: 0 0 0.2em 0 var(--color-background);
        }

        .btn-content:hover,
        .btn-content:focus {
            transition: 0.5s;
            -webkit-animation: btn-content 1s;
            animation: btn-content 1s;
            outline: 0.1em solid transparent;
            outline-offset: 0.2em;
            box-shadow: 0 0 0.4em 0 var(--color-background);
        }

        .btn-title:hover {
            color: white;

        }

        .btn-content .icon-arrow {
            transition: 0.5s;
            margin-right: 0px;
            transform: scale(0.6);
        }

        .btn-content:hover .icon-arrow {
            transition: 0.5s;
            margin-right: 25px;
        }

        .icon-arrow {
            width: 15px;
            margin-left: 15px;
            position: relative;
            top: 6%;
        }

        /* SVG */
        #arrow-icon-one {
            transition: 0.4s;
            transform: translateX(-60%);
        }

        #arrow-icon-two {
            transition: 0.5s;
            transform: translateX(-30%);
        }

        .btn-content:hover #arrow-icon-three {
            animation: color_anim 1s infinite 0.2s;
        }

        .btn-content:hover #arrow-icon-one {
            transform: translateX(0%);
            animation: color_anim 1s infinite 0.6s;
        }

        .btn-content:hover #arrow-icon-two {
            transform: translateX(0%);
            animation: color_anim 1s infinite 0.4s;
        }

        /* SVG animations */
        @keyframes color_anim {
            0% {
                fill: white;
            }

            50% {
                fill: var(--color-background);
            }

            100% {
                fill: white;
            }
        }

        /* Button animations */
        @-webkit-keyframes btn-content {
            0% {
                outline: 0.2em solid var(--color-background);
                outline-offset: 0;
            }
        }

        @keyframes btn-content {
            0% {
                outline: 0.2em solid var(--color-background);
                outline-offset: 0;
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('#academicyears').DataTable();
        });
    </script>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const synth = window.speechSynthesis;
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

            if (!SpeechRecognition || !synth) {
                alert("Speech features are not supported in your browser.");
                return;
            }

            const recognition = new SpeechRecognition();
            recognition.lang = 'en-US';
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;

            let active = true;
            let pendingAction = null; // "grades" or "attendance"

            function speak(text, callbackAfter) {
                if (synth.speaking) synth.cancel();
                const utter = new SpeechSynthesisUtterance(text);
                utter.lang = 'en-US';
                utter.rate = 1;
                if (callbackAfter) {
                    utter.onend = () => setTimeout(callbackAfter, 500);
                }
                synth.speak(utter);
            }

            function normalizeText(text) {
                const numberWords = {
                    "one": "1",
                    "two": "2",
                    "three": "3",
                    "four": "4",
                    "five": "5",
                    "six": "6",
                    "seven": "7",
                    "eight": "8",
                    "nine": "9",
                    "ten": "10"
                };
                let normalized = text.toLowerCase().trim();
                Object.keys(numberWords).forEach(word => {
                    normalized = normalized.replace(new RegExp(`\\b${word}\\b`, 'g'), numberWords[word]);
                });
                return normalized.replace(/[^\w\s]/gi, '').replace(/\s+/g, ' ').trim();
            }

            function readClasses(callback) {
                const rows = document.querySelectorAll('#academicyears tbody tr');
                if (!rows.length || rows[0].textContent.includes("No sections")) {
                    speak("There are no classes available.", callback);
                    return;
                }

                let classList = [];
                rows.forEach(row => {
                    const grade = row.children[1]?.innerText.trim();
                    if (grade) classList.push(grade);
                });

                const message = `You are enrolled in: ${classList.join(", ")}.`;
                speak(message, callback);
            }

            function goToClassLink(classSpoken, type, callback) {
                const rows = document.querySelectorAll('#academicyears tbody tr');
                const normalized = normalizeText(classSpoken);
                const gradeNumber = normalized.match(/\d+/)?.[0]; // Extract number like "10"

                console.log("🧠 Spoken Input:", classSpoken);
                console.log("🔎 Normalized:", normalized);
                console.log("🎯 Extracted Grade Number:", gradeNumber);

                if (!gradeNumber) {
                    console.warn("⚠️ No grade number detected in input.");
                    speak("I couldn't detect a grade number. Please try again, like grade 9 or grade 10.", listenForClassName);
                    return;
                }

                let found = false;

                rows.forEach((row, index) => {
                    const gradeText = normalizeText(row.children[1]?.innerText || '');
                    const match = gradeText.includes(gradeNumber);
                    console.log(`🔍 Row ${index}:`, gradeText, "| Match:", match);

                    if (match) {
                        let actionBtn;
                        const links = row.querySelectorAll('a.btn-content');
                        links.forEach(link => {
                            const btnText = link.innerText.trim().toLowerCase();
                            console.log(`🔗 Checking link: "${btnText}"`);
                            if ((type === 'grades' && btnText.includes('grades')) ||
                                (type === 'attendance' && btnText.includes('attendance'))) {
                                actionBtn = link;
                            }
                        });

                        if (actionBtn) {
                            console.log("✅ Clicking:", actionBtn.href);
                            found = true;
                            speak(`Opening ${type} for grade ${gradeNumber}.`, () => {
                                actionBtn.click();
                            });
                        } else {
                            console.warn(`⚠️ No button labeled '${type}' found in row ${index}`);
                        }
                    }
                });

                if (!found) {
                    console.warn("❌ No matching grade row with button found.");
                    speak(`I couldn't find grade ${gradeNumber}. Please try again.`, listenForClassName);
                }
            }




            function listenForClassName() {
                recognition.start();
                recognition.onresult = (event) => {
                    const className = event.results[0][0].transcript;
                    if (pendingAction) {
                        goToClassLink(className, pendingAction, () => {
                            pendingAction = null;
                        });
                    }
                };

                recognition.onerror = () => {
                    speak("I didn’t hear the class name clearly. Please say it again.", listenForClassName);
                };
            }

            function handleMainCommand(spokenText) {
                spokenText = spokenText.toLowerCase();

                if (spokenText.includes("stop") || spokenText.includes("exit") || spokenText.includes("goodbye")) {
                    active = false;
                    speak("Voice assistant stopped. Goodbye.");
                    return;
                }
                // Navigation
               
                const has = (keywords) => keywords.every(k => spokenText.includes(k));
                if (has(['enter', 'dashboard'])) {
                    return window.location.href = "{{ route('studentdash.dashboard') }}";
                }
                if (has(['enter', 'classes'])) {
                    return window.location.href = "{{ route('studentdash.classes') }}";
                }
                if (has(['enter', 'active', 'class'])) {
                    return window.location.href = "{{ route('studentdash.activeclass') }}";
                }
                if (spokenText.includes("read classes")) {
                    readClasses(() => {
                        if (active) speak("Would you like to hear marks or attendance?", listenForCommand);
                    });
                } else if (spokenText.includes("grades") || spokenText.includes("marks")) {
                    pendingAction = "grades";
                    speak("Which class do you want to hear marks for?", listenForClassName);
                } else if (spokenText.includes("attendance")) {
                    pendingAction = "attendance";
                    speak("Which class do you want to hear attendance for?", listenForClassName);
                } else {
                    speak("Sorry, I didn’t understand. You can say: read classes, hear marks, or hear attendance.", listenForCommand);
                }
            }

            function listenForCommand() {
                if (!active) return;

                recognition.start();
                recognition.onresult = (event) => {
                    const transcript = event.results[0][0].transcript;
                    handleMainCommand(transcript);
                };

                recognition.onerror = () => {
                    speak("Sorry, please try again.", listenForCommand);
                };
            }

            // Initial welcome
            setTimeout(() => {
                speak("Welcome to all your classes! You can say: read classes, hear my marks, or hear attendance. What would you like to do?", listenForCommand);
            }, 1000);
        });
    </script>



</x-layouts.app>


