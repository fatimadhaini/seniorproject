<x-layouts.app>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4">
            <!-- Dashboard Cards -->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Number of Students</p>
                                        <h2 class="font-weight-bolder mb-0">
                                            {{ $studentCount }}
                                            <span class="text-success text-sm font-weight-bolder">Students</span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">

                                        <img width="48" height="48" src="https://img.icons8.com/emoji/48/man-student.png" alt="man-student" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Number of Teachers</p>
                                        <h2 class="font-weight-bolder mb-0">
                                            {{ $teacherCount }}
                                            <span class="text-success text-sm font-weight-bolder">Teachers</span>

                                        </h2>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <img width="48" height="48" src="https://img.icons8.com/emoji/48/woman-teacher.png" alt="woman-teacher" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Pending Applications</p>
                                        <h2 class="font-weight-bolder mb-0">
                                            {{ $pendingApplicationCount }}
                                            <span class="text-warning text-sm font-weight-bolder">Pending</span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                                        <img width="48" height="48" src="https://img.icons8.com/color/48/edit-property.png" alt="pending-applications" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Open Sections</p>
                                        <h2 class="font-weight-bolder mb-0">
                                            {{ $openSectionCount }}
                                            <span class="text-info text-sm font-weight-bolder">This Year</span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                        <img width="48" height="48" src="https://img.icons8.com/color/48/classroom.png" alt="open-section" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Calendar Section -->
            <div class="row mt-4">
                <!-- Calendar Section -->
                <div class="col-12 col-lg-8 mb-4">
                    <div class="card p-4 h-100">
                        <div class="row mb-3">
                            <div class="col-12 d-flex flex-column flex-sm-row gap-2">
                                <button class="bn" data-bs-toggle="modal" data-bs-target="#eventModal">
                                    Add Event
                                    <svg fill="currentColor" viewBox="0 0 24 24" class="ic">
                                        <path
                                            clip-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                            fill-rule="evenodd"></path>
                                    </svg>
                                </button>

                                <button class="bn" data-bs-toggle="modal" data-bs-target="#addExamModal">
                                    Add Exam
                                    <svg fill="currentColor" viewBox="0 0 24 24" class="ic">
                                        <path
                                            clip-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                            fill-rule="evenodd"></path>
                                    </svg>
                                </button>

                                <button class="bn">

                                    <a href="{{ route('apply') }}" style="color:white;">Add Application</a>
                                    <svg fill="currentColor" viewBox="0 0 24 24" class="ic">
                                        <path
                                            clip-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                            fill-rule="evenodd"></path>
                                    </svg>
                                </button>

                                <button class="bn">

                                    <a href="{{ route('application.index') }}" style="color:white;">Review Applications</a>
                                    <svg fill="currentColor" viewBox="0 0 24 24" class="ic">
                                        <path
                                            clip-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                            fill-rule="evenodd"></path>
                                    </svg>
                                </button>

                                <button class="bn">
                                    <a href="{{ route('teacher.create') }}" style="color:white;">Add Teacher</a>
                                    <svg fill="currentColor" viewBox="0 0 24 24" class="ic">
                                        <path
                                            clip-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                            fill-rule="evenodd"></path>
                                    </svg>
                                </button>

                            </div>
                        </div>

                        <div id="calendar"></div>
                    </div>
                </div>

                <!-- Academic Year Chart Section -->
                <div class="col-12 col-lg-4">
                    @if($academicYear)
                    <div class="card shadow-lg border-0 h-40" style="border-radius: 1rem;">
                        <div class="card-body text-center py-4">
                            <h6 class="text-uppercase text-secondary mb-2">
                                Academic Year Progress — {{ $academicYear->name }}
                            </h6>

                            <canvas id="academicProgressChart" width="160" height="160" class="mx-auto"></canvas>
                            <p class="text-muted mt-3 mb-0 small">
                                {{ \Carbon\Carbon::parse($academicYear->start_date)->format('M d, Y') }}
                                → {{ \Carbon\Carbon::parse($academicYear->end_date)->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="card shadow-lg border-0 h-40 mt-2" style="border-radius: 1rem;">
                        <div class="row mt-4">
                                <div class="card-body text-center">
                                    <h6 class="text-uppercase text-secondary mb-3">Section Capacity Overview</h6>
                                    <canvas id="sectionCapacityChart" height="260"></canvas>
                                </div>
                            

                        </div>
                    </div>

                    @endif
                </div>
            </div>

            <!-- Add Exam Modal -->
            <div class="modal fade" id="addExamModal" tabindex="-1" aria-labelledby="addExamModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="addExamForm">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addExamModalLabel">Create New Exam Event</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <!-- Event Fields -->
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Exam Title" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" placeholder="Exam Description"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Start Date & Time</label>
                                    <input type="datetime-local" name="start" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">End Date & Time</label>
                                    <input type="datetime-local" name="end" class="form-control">
                                </div>

                                <!-- Link to Section and Subject -->
                                <div class="mb-3">
                                    <label class="form-label">Section and Subject</label>
                                    <select name="section_subject_teacher_id" class="form-select" required>
                                        @foreach($sectionsSubjects as $sst)
                                        <option value="{{ $sst->id }}">{{ $sst->section->grade->name }} - {{ $sst->subject->name }}-{{ $sst->teacher->first_name }} {{ $sst->teacher->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Hidden audience (teachers) -->
                                <input type="hidden" name="audience[]" value="teachers">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Create Exam</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="eventForm">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="eventModalLabel">Create Event</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="start" class="form-label">Start Date & Time</label>
                                    <input type="datetime-local" name="start" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="end" class="form-label">End Date & Time</label>
                                    <input type="datetime-local" name="end" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Audience</label><br>

                                    <div class="checkbox-btn">
                                        <input type="checkbox" id="audienceStudents" name="audience[]" value="students">
                                        <label for="audienceStudents">Students</label>
                                        <span class="checkmark"></span>
                                    </div>

                                    <div class="checkbox-btn">
                                        <input type="checkbox" id="audienceParents" name="audience[]" value="parents">
                                        <label for="audienceParents">Parents</label>
                                        <span class="checkmark"></span>
                                    </div>

                                    <div class="checkbox-btn">
                                        <input type="checkbox" id="audienceTeachers" name="audience[]" value="teachers">
                                        <label for="audienceTeachers">Teachers</label>
                                        <span class="checkmark"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Event</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- View Event Modal -->
        <!-- View Event Modal -->
        <div class="modal fade" id="viewEventModal" tabindex="-1" aria-labelledby="viewEventModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editEventForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewEventModalLabel">Event Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="event_id" id="modalEventId">

                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" id="modalEventTitle" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="modalEventDescription" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Start</label>
                                <input type="datetime-local" name="start" id="modalEventStart" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">End</label>
                                <input type="datetime-local" name="end" id="modalEventEnd" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Audience</label><br>

                                <div class="checkbox-btn">
                                    <input type="checkbox" id="modalAudienceStudents" name="audience[]" value="Student">
                                    <label for="modalAudienceStudents">Students</label>
                                    <span class="checkmark"></span>
                                </div>

                                <div class="checkbox-btn">
                                    <input type="checkbox" id="modalAudienceParents" name="audience[]" value="Parent">
                                    <label for="modalAudienceParents">Parents</label>
                                    <span class="checkmark"></span>
                                </div>

                                <div class="checkbox-btn">
                                    <input type="checkbox" id="modalAudienceTeachers" name="audience[]" value="Teacher">
                                    <label for="modalAudienceTeachers">Teachers</label>
                                    <span class="checkmark"></span>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="deleteEventBtn">Delete</button>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @push('styles')
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- FullCalendar CSS (optional if you want) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.css">
    <style>
        /* From Uiverse.io by jackson_2777 */
        .bn {
            position: relative;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            padding-block: 0.5rem;
            padding-inline: 1.25rem;
            background-color: rgb(0 107 179);
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffff;
            gap: 10px;
            font-weight: bold;
            border: 3px solid #ffffff4d;
            outline: none;
            overflow: hidden;
            font-size: 15px;
            cursor: pointer;
        }

        .ic {
            width: 50px;
            height: 50px;
            transition: all 0.3s ease-in-out;
        }

        .bn:hover {
            transform: scale(1.05);
            border-color: #fff9;
        }

        .bn:hover .icon {
            transform: translate(4px);
        }

        .bn:hover::before {
            animation: shine 1.5s ease-out infinite;
        }

        .bn::before {
            content: "";
            position: absolute;
            width: 100px;
            height: 100%;
            /* background-image: linear-gradient(
    120deg,
    rgba(255, 255, 255, 0) 30%,
    rgba(255, 255, 255, 0.8),
    rgba(255, 255, 255, 0) 70%
  ); */
            top: 0;
            left: -100px;
            opacity: 0.6;
        }

        @keyframes shine {
            0% {
                left: -100px;
            }

            60% {
                left: 100%;
            }

            to {
                left: 100%;
            }
        }


        #calendar {

            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            min-height: 600px;
        }

        .btn-close {
            background-color: #f44336;
            color: white;
        }
    </style>
    <style>
        .checkbox-btn {
            display: block;
            position: relative;
            padding-left: 30px;
            margin-bottom: 10px;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .checkbox-btn input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkbox-btn label {
            cursor: pointer;
            font-size: 14px;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            border: 2.5px solid #3674B5;
            transition: .2s linear;
        }

        .checkbox-btn input:checked~.checkmark {
            background-color: #3674B5;
            color: white;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            visibility: hidden;
            opacity: 0;
            left: 50%;
            top: 40%;
            width: 10px;
            height: 14px;
            border: 2px solid white;
            filter: drop-shadow(0px 0px 10px #0ea021);
            border-width: 0 2.5px 2.5px 0;
            transition: .2s linear;
            transform: translate(-50%, -50%) rotate(-90deg) scale(0.2);
        }

        /* Show the checkmark when checked */
        .checkbox-btn input:checked~.checkmark:after {
            visibility: visible;
            opacity: 1;
            transform: translate(-50%, -50%) rotate(0deg) scale(1);
            animation: pulse 1s ease-in;
        }

        .checkbox-btn input:checked~.checkmark {
            transform: rotate(45deg);
            border: none;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: translate(-50%, -50%) rotate(0deg) scale(1);
            }

            50% {
                transform: translate(-50%, -50%) rotate(0deg) scale(1.6);
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const canvas = document.getElementById('academicProgressChart');
            const ctx = canvas.getContext('2d');

            const progress = JSON.parse('{!! json_encode($academicYearProgress) !!}');
            const bgColor = progress >= 100 ? '#28a745' : (progress <= 0 ? '#dc3545' : '#3674B5');

            // Plugin to draw center text
            const centerTextPlugin = {
                id: 'centerText',
                beforeDraw(chart) {
                    const {
                        width,
                        height
                    } = chart;
                    const ctx = chart.ctx;
                    ctx.restore();

                    const fontSize = (height / 5).toFixed(2);
                    ctx.font = `bold ${fontSize}px Poppins, sans-serif`;
                    ctx.textBaseline = 'middle';
                    ctx.textAlign = 'center';
                    ctx.fillStyle = bgColor;

                    const text = progress + '%';
                    const x = width / 2;
                    const y = height / 2;

                    ctx.fillText(text, x, y);
                    ctx.save();
                }
            };

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [progress, 100 - progress],
                        backgroundColor: [bgColor, '#e9ecef'],
                        borderWidth: 4,
                        hoverOffset: 6
                    }]
                },
                options: {
                    cutout: '72%',
                    animation: {
                        animateRotate: true,
                        duration: 1200,
                        easing: 'easeOutBounce'
                    },
                    plugins: {
                        tooltip: {
                            enabled: false
                        },
                        legend: {
                            display: false
                        }
                    }
                },
                plugins: [centerTextPlugin]
            });
        });
    </script>


    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>

    <!-- Initialize FullCalendar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var currentEventId = null;

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: {
                    url: '/events',
                    failure: function() {
                        Swal.fire('Error', 'Could not load events!', 'error');
                    }
                },
                eventDataTransform: function(eventData) {
                    // Set color based on audience
                    let color = '#3788d8'; // default blue
                    if (eventData.audience === 'students') color = '#4285F4'; // Blue
                    else if (eventData.audience === 'teachers') color = '#34A853'; // Green
                    else if (eventData.audience === 'parents') color = '#FBBC05'; // Yellow
                    return {
                        ...eventData,
                        color: color
                    };
                },
                eventClick: function(info) {
                    currentEventId = info.event.id;

                    document.getElementById('modalEventId').value = info.event.id;
                    document.getElementById('modalEventTitle').value = info.event.title || '';
                    document.getElementById('modalEventDescription').value = info.event.extendedProps.description || '';
                    document.getElementById('modalEventStart').value = formatDateTimeInput(info.event.start);
                    document.getElementById('modalEventEnd').value = info.event.end ? formatDateTimeInput(info.event.end) : '';
                    ['modalAudienceStudents', 'modalAudienceParents', 'modalAudienceTeachers'].forEach(id => {
                        document.getElementById(id).checked = false;
                    });
                    // Check audience
                    const audience = info.event.extendedProps.audience || [];
                    if (audience.includes('students')) document.getElementById('modalAudienceStudents').checked = true;
                    if (audience.includes('parents')) document.getElementById('modalAudienceParents').checked = true;
                    if (audience.includes('teachers')) document.getElementById('modalAudienceTeachers').checked = true;
                    var viewModal = new bootstrap.Modal(document.getElementById('viewEventModal'));
                    viewModal.show();
                }
            });

            calendar.render();

            // Create New Event Form Submission
            document.getElementById('eventForm').addEventListener('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                fetch('/events', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(async response => {
                        if (!response.ok) {
                            const text = await response.text();
                            throw new Error(text);
                        }
                        return response.json();
                    })
                    .then(data => {
                        var modal = bootstrap.Modal.getInstance(document.getElementById('eventModal'));
                        modal.hide();

                        // ✅ Fix stuck dark backdrop
                        document.body.classList.remove('modal-open');
                        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message || 'Event created successfully!',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        calendar.refetchEvents();
                        document.getElementById('eventForm').reset();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Something went wrong, please try again.', 'error');
                    });
            });

            // Edit Event Form Submission
            document.getElementById('editEventForm').addEventListener('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                fetch('/events/' + currentEventId, {
                        method: 'POST', // Laravel HTML forms don't support PUT, so use POST + _method
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire('Success', 'Event updated!', 'success');
                        var viewModal = bootstrap.Modal.getInstance(document.getElementById('viewEventModal'));
                        viewModal.hide();
                        calendar.refetchEvents();
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire('Error', 'Could not update event.', 'error');
                    });
            });

            // Delete Event
            document.getElementById('deleteEventBtn').addEventListener('click', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This event will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('/events/' + currentEventId, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                Swal.fire('Deleted!', 'Event deleted.', 'success');
                                var viewModal = bootstrap.Modal.getInstance(document.getElementById('viewEventModal'));
                                viewModal.hide();
                                calendar.refetchEvents();
                            })
                            .catch(error => {
                                console.error(error);
                                Swal.fire('Error', 'Could not delete event.', 'error');
                            });
                    }
                });
            });

            // Helper: Format datetime-local input
            function formatDateTimeInput(date) {
                if (!date) return '';
                return new Date(date).toISOString().slice(0, 16);
            }
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addExamForm = document.getElementById('addExamForm'); // your modal form

            addExamForm.addEventListener('submit', function(e) {
                e.preventDefault(); // prevent normal form submit

                const formData = new FormData(addExamForm);

                fetch("{{ route('exams.store') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    })
                    .then(async response => {
                        if (!response.ok) {
                            const errorData = await response.json();
                            throw errorData;
                        }
                        return response.json();
                    })
                    .then(data => {
                        // ✅ SweetAlert Success
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // ✅ Close the modal
                        var myModalEl = document.getElementById('addExamModal');
                        var modal = bootstrap.Modal.getInstance(myModalEl);
                        modal.hide();

                        // ✅ Reset the form
                        addExamForm.reset();

                        // ✅ Optional: Reload after 2 seconds
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    })
                    .catch(error => {
                        console.error('Error:', error);

                        let errorMessages = '';

                        if (error.errors) {
                            for (let field in error.errors) {
                                errorMessages += error.errors[field].join(' ') + '\n';
                            }
                        } else {
                            errorMessages = 'Something went wrong. Please try again.';
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessages,
                        });
                    });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('sectionCapacityChart').getContext('2d');

            const sectionData = @json($sectionCapacities);

            const labels = sectionData.map(item => item.name);
            const studentCounts = sectionData.map(item => item.students);
            const capacities = sectionData.map(item => item.capacity);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Current Students',
                            data: studentCounts,
                            backgroundColor: '#3674B5'
                        },
                        {
                            label: 'Capacity',
                            data: capacities,
                            backgroundColor: '#e0e0e0'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Students'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    }
                }
            });
        });
    </script>

    @endpush
</x-layouts.app>