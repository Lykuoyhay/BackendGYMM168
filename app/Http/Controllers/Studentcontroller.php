<?php
// app/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')->orderBy('id', 'desc')->paginate(10);
        return view("dashboards.index", compact("students"));
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'gender' => 'required|string',
            'telephone' => 'required|string',
            'image' => 'nullable', // max 2MB
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/' . $filename;
            $image->move(public_path('uploads'), $filename);
        } else {
            $path = null;
        }

        // Create the user
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'student',
            'gender' => $validatedData['gender'],
            'telephone' => $validatedData['telephone'],
            'image' => $path,
        ]);

        return redirect()->route('dashboards.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $student = User::find($id);
        if ($student && $student->role == 'student') {
            return response()->json($student);
        } else {
            return response()->json(['error' => 'Student not found'], 404);
        }
    }
    public function edit($id)
    {
        $student = User::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'gender' => 'nullable|string',
            'telephone' => 'nullable|string',
            'image' => 'nullable', // max 2MB
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/' . $filename;
            $image->move(public_path('uploads'), $filename);
        } else {
            $path = null;
        }

        // Update the student record
        $student = User::findOrFail($id);
        $student->name = $validatedData['name'];
        $student->email = $validatedData['email'];
        if ($request->filled('password')) {
            $student->password = Hash::make($validatedData['password']);
        }
        $student->gender = $validatedData['gender'];
        $student->telephone = $validatedData['telephone'];
        if ($path) {
            $student->image = $path;
        }
        $student->save();

        return redirect()->route('dashboards.index')->with('success', 'Student updated successfully.');
    }

    public function delete($id)
    {
        // Find the student by ID
        $student = User::findOrFail($id);

        // Delete the student's image if it exists


        // Delete the student
        $student->delete();

        return redirect()->route('dashboards.index')->with('success', 'Student deleted successfully.');
    }

    public function search(Request $request)
    {
        
        $search = $request->input('search');

        $students = User::where('role', 'student')
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
            //with search not found
            if ($students->isEmpty()) {
                $request->session()->flash('status', 'No results found for your search criteria.');
            } else {
                $request->session()->forget('status'); // Clear status if results found
            }
        return view('dashboards.index', compact('students'));
    }
}
