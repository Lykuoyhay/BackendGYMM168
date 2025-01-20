<?php

namespace App\Http\Controllers;

use App\Models\CoachStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CoachController extends Controller
{
    // CoachController.php

    public function index()
    {
        $coaches = User::where('role', 'coach')->orderBy('id', 'desc')->paginate(5);
        $students = User::where('role', 'student')->orderBy('id', 'desc')->get();
        $coachstudents = CoachStudent::with(['coach', 'student'])->orderBy('id', 'desc')->paginate(5);

        return view('coaches.index', compact('coaches', 'students', 'coachstudents'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data for coach
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'gender' => 'required|string',
            'telephone' => 'required|string',
            'image' => 'nullable',
        ]);

        // Handle file upload for coach
        $path = $this->handleImageUpload($request);

        // Create the coach
        $coach = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'coach',
            'gender' => $validatedData['gender'],
            'telephone' => $validatedData['telephone'],
            'image' => $path,
        ]);

        // // Handle coach-student relationship creation
        // $coachStudentData = [
        //     'coach_id' => $coach->id,
        //     'student_id' => $request->input('student_id'), // Adjust as per your form input name
        // ];
        // CoachStudent::create($coachStudentData);

        return redirect()->route('coaches.index')->with('success', 'Coach created successfully.');
    }

    public function edit($id)
    {
        $coach = User::findOrFail($id);
        return view('coaches.edit', compact('coach'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data for coach
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'gender' => 'required|string',
            'telephone' => 'required|string',
            'image' => 'nullable',
        ]);

        // Handle file upload for coach
        $path = $this->handleImageUpload($request);

        // Update the coach record
        $coach = User::findOrFail($id);
        $coach->name = $validatedData['name'];
        $coach->email = $validatedData['email'];
        if ($request->filled('password')) {
            $coach->password = Hash::make($validatedData['password']);
        }
        $coach->gender = $validatedData['gender'];
        $coach->telephone = $validatedData['telephone'];
        if ($path) {
            $coach->image = $path;
        }
        $coach->save();

        return redirect()->route('coaches.index')->with('success', 'Coach updated successfully.');
    }

    public function delete($id)
    {
        // Find the coach by ID
        $coach = User::findOrFail($id);

        // Delete the coach
        $coach->delete();

        return redirect()->route('coaches.index')->with('success', 'Coach deleted successfully.');
    }

    public function storeCoachStudent(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'coach_id' => 'required|exists:users,id,role,coach',
            'student_id' => 'required|exists:users,id,role,student',
        ]);

        // Create the Coach-Student relationship
        CoachStudent::create([
            'coach_id' => $validatedData['coach_id'],
            'student_id' => $validatedData['student_id'],
        ]);

        return redirect()->route('coaches.index')->with('success', 'Coach-Student relationship created successfully.');
    }
    public function updateCoachStudent(Request $request, $id)
    {
        // Validate the incoming request data for coach-student relationship
        $validatedData = $request->validate([
            'coach_id' => 'required|exists:users,id,role,coach',
            'student_id' => 'required|exists:users,id,role,student',
        ]);

        // Update the coach-student relationship
        $coachStudent = CoachStudent::findOrFail($id);
        $coachStudent->coach_id = $validatedData['coach_id'];
        $coachStudent->student_id = $validatedData['student_id'];
        $coachStudent->save();

        return redirect()->route('coaches.index')->with('success', 'Coach-Student relationship updated successfully.');
    }

    public function deleteCoachStudent($id)
    {
        // Find the coach-student relationship by ID
        $coachStudent = CoachStudent::findOrFail($id);

        // Delete the coach-student relationship
        $coachStudent->delete();

        return redirect()->route('coaches.index')->with('success', 'Coach-Student relationship deleted successfully.');
    }

    private function handleImageUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/' . $filename;
            $image->move(public_path('uploads'), $filename);
            return $path;
        }
        return null;
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $coaches = User::where('role', 'coach')
            ->where(function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    // Search for name starting with $search (case insensitive)
                    $query->whereRaw('LOWER(name) LIKE ?', [strtolower($search) . '%']);
                })
                    ->orWhere('email', '=', $search) // Exact match for email
                    ->orWhere(function ($query) use ($search) {
                        // Numeric search for ID
                        if (is_numeric($search)) {
                            $query->where('id', $search);
                        }
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($coaches->isEmpty()) {
            $request->session()->flash('status', 'No coaches found for your search criteria.');
        } else {
            $request->session()->forget('status'); // Clear status if coaches found
        }
        $coachstudents = CoachStudent::orderBy('id', 'desc')->paginate(10);
        $students = User::where('role', 'student')->orderBy('id', 'desc')->get(); // Fetch students data
        return view('coaches.index', compact('coaches', 'students', 'coachstudents'));
    }



}
