<x-layouts.app>

    <div class="container">
        <p class="mt-4" style="color:#729762;text-align:center;text-shadow:2px 2px 5px white;">
            <button data-text="Awesome" class="buttonpma">
                <span class="actual-text">&nbsp;Classes&nbsp;</span>
                <span class="hover-text" aria-hidden="true">&nbsp;Classes&nbsp;</span>
            </button>
        </p>
        <div class="mb-3">
            <label for="academicYearFilter" class="form-label fw-bold">Filter by Academic Year</label>
            <select id="academicYearFilter" class="form-select">
                <option value="">-- All Years --</option>
                @php
                $academicYears = $classes->pluck('academicYear')->unique('id')->filter()->sortByDesc('start_date');
                @endphp
                @foreach($academicYears as $year)
                <option value="{{ $year->name }}">{{ $year->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="table-responsive">
            <table id="academicyears" class="table table-striped table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Academic Year</th>
                        <th>Grade Name</th>
                        <th>Add A lesson</th>
                        <th>Exams</th>
                        <th>Observe Lessons</th>
                        <th>Capacity</th>
                        <th>Students</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($classes as $section)
                    <tr>
                        <td>{{ $section->academicYear->name ?? 'N/A' }}</td>
                        <td>{{ $section->grade->name ?? 'N/A' }}</td>
                        <td>
                            @php
                            $sectionSubjectTeacher = $section->sectionSubjectTeachers->first();
                            @endphp

                            @if($sectionSubjectTeacher)
                            <button class="view add-lesson-btn" data-section-subject-teacher-id="{{ $sectionSubjectTeacher->id }}"
                                data-bs-toggle="modal" data-bs-target="#addLessonModal">
                                Add Lesson
                                <svg style="color: white" class="i" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" fill="white"></path>
                                </svg>
                            </button>
                            <!-- <button class="btn btn-primary add-lesson-btn"
                                data-section-subject-teacher-id="{{ $sectionSubjectTeacher->id }}"
                                data-bs-toggle="modal" data-bs-target="#addLessonModal">
                                Add Lesson
                            </button> -->
                            @else
                            <span class="text-danger">No assigned teacher</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('teacher.exams.bySection', ['sectionId' => $section->id]) }}">
                                <button class="view">
                                    View Exams
                                    <svg fill="currentColor" viewBox="0 0 24 24" class="i">
                                        <path
                                            clip-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                            fill-rule="evenodd"></path>
                                    </svg>

                                </button></a>
                        </td>
                        <td>
                            <a href="{{ route('lessons.bySection', ['sectionId' => $section->id]) }}"> <button class="view">
                                    View Lessons
                                    <svg fill="currentColor" viewBox="0 0 24 24" class="i">
                                        <path
                                            clip-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                            fill-rule="evenodd"></path>
                                    </svg>

                                </button></a>



                        </td>
                        <td>{{ $section->capacity ?? 'N/A' }}</td>

                        <td><a href="{{ route('students.export', ['sectionId' => $section->id]) }}" class="btn btn-success">
                                <svg
                                    fill="#fff"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 50 50">
                                    <path
                                        d="M28.8125 .03125L.8125 5.34375C.339844 
    5.433594 0 5.863281 0 6.34375L0 43.65625C0 
    44.136719 .339844 44.566406 .8125 44.65625L28.8125 
    49.96875C28.875 49.980469 28.9375 50 29 50C29.230469 
    50 29.445313 49.929688 29.625 49.78125C29.855469 49.589844 
    30 49.296875 30 49L30 1C30 .703125 29.855469 .410156 29.625 
    .21875C29.394531 .0273438 29.105469 -.0234375 28.8125 .03125ZM32 
    6L32 13L34 13L34 15L32 15L32 20L34 20L34 22L32 22L32 27L34 27L34 
    29L32 29L32 35L34 35L34 37L32 37L32 44L47 44C48.101563 44 49 
    43.101563 49 42L49 8C49 6.898438 48.101563 6 47 6ZM36 13L44 
    13L44 15L36 15ZM6.6875 15.6875L11.8125 15.6875L14.5 21.28125C14.710938 
    21.722656 14.898438 22.265625 15.0625 22.875L15.09375 22.875C15.199219 
    22.511719 15.402344 21.941406 15.6875 21.21875L18.65625 15.6875L23.34375 
    15.6875L17.75 24.9375L23.5 34.375L18.53125 34.375L15.28125 
    28.28125C15.160156 28.054688 15.035156 27.636719 14.90625 
    27.03125L14.875 27.03125C14.8125 27.316406 14.664063 27.761719 
    14.4375 28.34375L11.1875 34.375L6.1875 34.375L12.15625 25.03125ZM36 
    20L44 20L44 22L36 22ZM36 27L44 27L44 29L36 29ZM36 35L44 35L44 37L36 37Z"></path>
                                </svg>
                                Download Students List
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No sections available for this teacher.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/smooth-scrollbar@8.6.3/dist/smooth-scrollbar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#academicyears').DataTable();

            // Filter table by academic year
            $('#academicYearFilter').on('change', function() {
                const selectedYear = $(this).val();
                table.columns(0).search(selectedYear).draw();
            });

            // Set sectionSubjectTeacherId in modal
            $(".add-lesson-btn").click(function() {
                var sectionSubjectTeacherId = $(this).data("section-subject-teacher-id");
                $("#sectionSubjectTeacherId").val(sectionSubjectTeacherId);
            });

            // Handle form submission with AJAX
            $("form").on("submit", function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr("action"),
                    method: $(this).attr("method"),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.success,
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.error,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'There was an error adding the lesson.',
                        });
                    }
                });
            });
        });
    </script>
 

    <!-- Add Lesson Modal -->
    <div class="modal fade" id="addLessonModal" tabindex="-1" aria-labelledby="addLessonLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLessonLabel">Add New Lesson</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('lessons.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="section_subject_teacher_id" id="sectionSubjectTeacherId">

                        <div class="form-group">
                            <label for="title">Lesson Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Lesson Description</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="video">Upload Video</label>
                            <input type="file" name="video" id="video" class="form-control" accept="video/*" required>
                        </div>

                        <div class="form-group">
                            <label for="pdf">Upload PDF</label>
                            <input type="file" name="pdf" id="pdf" class="form-control" accept="application/pdf" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Lesson</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>