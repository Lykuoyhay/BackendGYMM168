<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkoutPlan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WorkoutPlanController extends Controller
{
    public function index()
    {
        $workoutplans = WorkoutPlan::orderBy('workoutplan_id', 'desc')->paginate(10);
        return view('workoutplans.index', compact('workoutplans'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'course_name' => 'required|string|max:100',
            'course_type' => 'required|string|max:50',
            'schedule' => 'required|string|max:50',
            'duration' => 'required|string|max:255',
            'requirement' => 'nullable|string',
            'price' => 'required|numeric|between:0,999999.99',
            'course_description' => 'required|string',
            'course_image' => 'required', // Validate image file
            'id' => 'required|exists:users,id',
        ]);

        // Handle file upload
        if ($request->hasFile('course_image')) {
            $image = $request->file('course_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/' . $filename;
            $image->move(public_path('uploads'), $filename);
        } else {
            $path = null;
        }

        // Create the workout plan
        WorkoutPlan::create([
            'course_name' => $validatedData['course_name'],
            'course_type' => $validatedData['course_type'],
            'schedule' => $validatedData['schedule'],
            'duration' => $validatedData['duration'],
            'requirement' => $validatedData['requirement'],
            'price' => $validatedData['price'],
            'course_description' => $validatedData['course_description'],
            'course_image' => $path,
            'id' => $validatedData['id'],
        ]);

        return redirect()->route('workoutplans.index')->with('success', 'Workout Plan created successfully.');
    }

    public function show($workoutplan_id)
    {
        $workoutplan = WorkoutPlan::find($workoutplan_id);

        if ($workoutplan) {
            return response()->json($workoutplan);
        } else {
            return response()->json(['error' => 'Workout plan not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $workoutplan = WorkoutPlan::findOrFail($id);

        $validatedData = $request->validate([
            'course_name' => 'required|string|max:100',
            'course_type' => 'required|string|max:50',
            'schedule' => 'required|string|max:50',
            'duration' => 'required|string|max:255',
            'requirement' => 'nullable|string',
            'price' => 'required|numeric|between:0,999999.99',
            'course_description' => 'required|string',
            'course_image' => 'nullable',
        ]);

        if ($request->hasFile('course_image')) {
            // Delete old image
            if ($workoutplan->course_image) {
                Storage::delete($workoutplan->course_image);
            }

            // Upload new image
            $image = $request->file('course_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/' . $filename;
            $image->move(public_path('uploads'), $filename);
            $validatedData['course_image'] = $path;
        }

        $workoutplan->update($validatedData);

        return redirect()->route('workoutplans.index')->with('success', 'Workout Plan updated successfully.');
    }

    public function destroy($id)
    {
        $workoutplan = WorkoutPlan::findOrFail($id);

        if ($workoutplan->course_image) {
            Storage::delete($workoutplan->course_image);
        }

        $workoutplan->delete();

        return redirect()->route('workoutplans.index')->with('success', 'Workout Plan deleted successfully.');
    }

    // workoutplans/search
    // public function search(Request $request)
    // {
    //     $search = $request->input('search');

    //     $workoutplans = WorkoutPlan::where(function ($query) use ($search) {
    //         $query->where(function ($query) use ($search) {
    //             // Search for course name starting with $search (case insensitive)
    //             $query->whereRaw('LOWER(course_name) LIKE ?', [strtolower($search) . '%']);
    //         })
    //             ->orWhere('course_type', 'like', "%$search%")
    //             ->orWhere('schedule', 'like', "%$search%")
    //             ->orWhere('duration', 'like', "%$search%")
    //             ->orWhere('requirement', 'like', "%$search%")
    //             ->orWhere('course_description', 'like', "%$search%");

    //         // Numeric search for workoutplan_id
    //         if (is_numeric($search)) {
    //             $query->orWhere('workoutplan_id', $search);
    //         }
    //     })
    //         ->orderBy('workoutplan_id', 'desc')
    //         ->paginate(10);

    //     if ($workoutplans->isEmpty()) {
    //         $request->session()->flash('status', 'No results found for your search criteria.');
    //     } else {
    //         $request->session()->forget('status'); // Clear status if results found
    //     }

    //     return view('workoutplans.index', compact('workoutplans'));
    // }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $workoutplans = WorkoutPlan::where('course_type', 'like', '%' . $search . '%')
        
            
        ->get();
            return view('workoutplans.index', compact('workoutplans','search'));
    }
}
