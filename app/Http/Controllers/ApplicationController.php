<?php
namespace App\Http\Controllers;

use App\Models\StudentParent; // This is your renamed parent model


use Twilio\Rest\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Grade;
use App\Models\Disability;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\WelcomeStudentMail;
use App\Models\User;
use App\Models\Student;
use App\Models\Section;

class ApplicationController extends Controller
{
    // Show the application form
    public function create(){
        $grades = Grade::all();
        $disabilities = Disability::all();
        $currentDate = now();
        $academicYear = AcademicYear::where('application_opening', '<=', $currentDate)
            ->where('application_expiry', '>=', $currentDate)
            ->first();

        if (!$academicYear) {
            return redirect()->route('apply')->with('error', 'No academic year is currently open for applications.');
        }

        return view('client.apply', compact('grades', 'disabilities', 'academicYear'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'academic_year_id' => 'required|integer|exists:academic_years,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'disabilities' => 'required|array',  // Disabilities should be an array of IDs
            'parents_contact_numbers' => 'required|string',
            'address' => 'required|string',
            'parents_names' => 'required|string',
            'grade_id' => 'required|integer',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'precertificate' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'id_card_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file uploads
        $profileImgPath = $request->hasFile('profile_img')
            ? $request->file('profile_img')->store('uploads', 'public')
            : null;

        $precertificatePath = $request->hasFile('precertificate')
            ? $request->file('precertificate')->store('uploads', 'public')
            : null;

        $idCardImgPath = $request->hasFile('id_card_img')
            ? $request->file('id_card_img')->store('uploads', 'public')
            : null;

        // Save application data
        $application = Application::create([
            'academic_year_id' => $request->academic_year_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'parents_contact_numbers' => $request->parents_contact_numbers,
            'address' => $request->address,
            'parents_names' => $request->parents_names,
            'grade_id' => $request->grade_id,
            'profile_img' => $profileImgPath,
            'precertificate' => $precertificatePath,
            'id_card_img' => $idCardImgPath,
            'status' => 'pending',
        ]);

        // Attach disabilities (array of disability IDs)
        $application->disabilities()->attach($request->disabilities);

        return response()->json(['success' => true, 'message' => 'Application submitted successfully!']);
    }
    public function index(Request $request)
    {
        $status = $request->query('status');

        $applications = Application::with(['academicYear', 'grade', 'disabilities']);

        if ($status) {
            $applications->where('status', $status);
        }

        return view('application.index', [
            'applications' => $applications->get()
        ]);
    }

   

    // Show the form for editing the specified application
    public function edit(Request $request)
    {
        $application = Application::findOrFail($request->query('id'));
        $grades = Grade::all();
        $disabilities = Disability::all();
        return view('application.edit', compact('application', 'grades', 'disabilities'));
    }

    // Update the specified application in storage
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'profile_img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'disabilities' => 'array',
            'disabilities.*' => 'exists:disabilities,id',
            'parents_names' => 'required|string|max:255',
            'parents_contact_numbers' => 'required|string|max:15',
            'id_card_img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'precertificate' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $application = Application::findOrFail($request->query('id'));

        if ($request->hasFile('profile_img')) {
            if ($application->profile_img) {
                Storage::delete($application->profile_img);
            }
            $profileImgPath = $request->file('profile_img')->store('profile_imgs');
            $application->profile_img = $profileImgPath;
        }

        if ($request->hasFile('id_card_img')) {
            if ($application->id_card_img) {
                Storage::delete($application->id_card_img);
            }
            $idCardImgPath = $request->file('id_card_img')->store('id_card_imgs');
            $application->id_card_img = $idCardImgPath;
        }

        if ($request->hasFile('precertificate')) {
            if ($application->precertificate) {
                Storage::delete($application->precertificate);
            }
            $precertificatePath = $request->file('precertificate')->store('precertificates');
            $application->precertificate = $precertificatePath;
        }

        $application->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'grade_id' => $request->grade_id,
            'parents_names' => $request->parents_names,
            'parents_contact_numbers' => $request->parents_contact_numbers,
        ]);

        $application->disabilities()->sync($request->disabilities);

        return redirect()->route('application.index')->with('success', 'Application updated successfully');
    }

    // Remove the specified application from storage
    public function destroy(Request $request)
    {
        try {
            $application = Application::findOrFail($request->query('id'));
            if ($application->profile_img) {
                Storage::delete($application->profile_img);
            }
          
            if ($application->id_card_img) {
                Storage::delete($application->id_card_img);
            }
            if ($application->precertificate) {
                Storage::delete($application->precertificate);
            }
            $application->disabilities()->detach();
            $application->delete();
            return redirect()->route('application.index')->with('success', 'Application deleted successfully');
        } catch (\Exception $exception) {
            report($exception);
            return redirect()->route('application.index')->with('error', 'There was an error deleting the application');
        }
    }

    public function updateStatus($id, $status)
    {
        $application = Application::findOrFail($id);

        // Update the application status
        $application->status = $status;
        $application->save();

        if ($status == 'approved') {
            // Check if the section already exists
            $section = Section::where('academic_year_id', $application->academic_year_id)
                ->where('grade_id', $application->grade_id)
                ->first();

            // If no section exists, create one
            if (!$section) {
                $section = Section::create([
                    'academic_year_id' => $application->academic_year_id,
                    'grade_id' => $application->grade_id,
                    'capacity' => 1,
                    'status' => 'active',
                ]);
            } else {
                $section->increment('capacity', 1);
            }

            // Attach the application to the section
            $section->applications()->attach($application->id);

            // Generate student credentials
            $email = strtolower($application->first_name . '.' . $application->last_name . '@school.com');
           $password = strtolower(Str::random(10));

           

            $user = User::create([
                'name' => $application->first_name . ' ' . $application->last_name,
                'email' => $email,
                'password' => bcrypt($password),
                'role_id' => 3, // Student
            ]);

            // Create student
            $student = Student::create([
                'user_id' => $user->id,
                'application_id' => $application->id,
                'status' => 'active',
            ]);

            $student->sections()->attach($section->id, ['academic_year_id' => $application->academic_year_id]);

            // ✅ Create parent account
            $parentEmail = strtolower('parent.' . $application->first_name . '.' . $application->last_name . '@school.com');
            $parentPassword = strtolower(Str::random(10));

            $parentUser = User::create([
                'name' => 'Parent of ' . $application->first_name,
                'email' => $parentEmail,
                'password' => bcrypt($parentPassword),
                'role_id' => 4, // Parent
            ]);

            $studentParent = StudentParent::create([
                'user_id' => $parentUser->id,
                'phone_number' => $application->parents_contact_numbers,
            ]);

            // ✅ Link student to parent
            $student->parent_id = $studentParent->id;
            $student->save();

            // ✅ Send WhatsApp message
            try {
                $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

                Log::info('SID: ' . config('services.twilio.sid'));
                Log::info('TOKEN: ' . config('services.twilio.token') ? 'OK' : 'Missing');

                $message = "🎉 Your application has been approved!\n\n" .
                    "👧 Student Account:\n" .
                    "Email: $email\n" .
                    "Password: $password\n\n" .
                    "👨‍👩‍👧 Parent Account:\n" .
                    "Email: $parentEmail\n" .
                    "Password: $parentPassword\n\n" .
                    "Please use these credentials to log in.";

                $twilio->messages->create(
                    'whatsapp:' . $application->parents_contact_numbers,
                    [
                        'from' => config('services.twilio.from'),
                        'body' => $message,
                    ]
                );
            } catch (\Exception $e) {
                Log::error('Failed to send WhatsApp message: ' . $e->getMessage());
            }

            return redirect()->back()->with('success', 'Application approved and accounts created successfully.');
        }

        if ($status == 'rejected') {
            $message = "We regret to inform you that your application has been rejected.\n\n" .
                "We appreciate your interest and encourage you to apply again in the future.\n\n" .
                "If you have any questions, feel free to reach out to us.";

            try {
                $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

                $twilio->messages->create(
                    'whatsapp:' . $application->parents_contact_numbers,
                    [
                        'from' => env('TWILIO_WHATSAPP_NUMBER'),
                        'body' => $message,
                    ]
                );
            } catch (\Exception $e) {
                Log::error('Failed to send WhatsApp message: ' . $e->getMessage());
            }

            return redirect()->back()->with('success', 'Application rejected. Apology message sent.');
        }

        return redirect()->back()->with('success', 'Application status updated successfully.');
    }
}
