<?php 

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\User;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index()
    {
        $progresses = Progress::orderBy('progress_id', 'desc')->paginate(10);
        $users = User::where('role', 'student')->get();
        return view('progresses.index', compact('progresses', 'users'));
    }

    public function show($id)
    {
        $progress = Progress::find($id);
        if ($progress && $progress->user->role == 'student') {
            return response()->json($progress);
        } else {
            return response()->json(['error' => 'Progress not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:users,id',
            'workout_set' => 'required|integer',
            'workout_duration' => 'required|integer',
            'calories_burn' => 'required|integer',
            'status' => 'nullable|string|max:255'
        ]);

        Progress::create($validatedData);

        return redirect()->route('progresses.index')->with('success', 'Progress created successfully.');
    }

    public function update(Request $request, $id)
    {
        $progress = Progress::findOrFail($id);

        $validatedData = $request->validate([
            'workout_set' => 'required|integer',
            'workout_duration' => 'required|integer',
            'calories_burn' => 'required|integer',
            'status' => 'nullable|string|max:255'
        ]);

        $progress->update($validatedData);

        return redirect()->route('progresses.index')->with('success', 'Progress updated successfully.');
    }

    public function destroy($id)
    {
        $progress = Progress::findOrFail($id);
        $progress->delete();

        return redirect()->route('progresses.index')->with('success', 'Progress deleted successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $progresses = Progress::where(function ($query) use ($search) {
            $query->where('progress_id', 'like', "%$search%")
                ->orWhere('workout_set', 'like', "%$search%");
        })
            ->orWhereHas('user', function ($query) use ($search) {
                $query->whereRaw('LOWER(name) LIKE ?', [strtolower($search) . '%']);
            })
            ->orderBy('progress_id', 'desc')
            ->paginate(10);

        if ($progresses->isEmpty()) {
            $request->session()->flash('status', 'No results found for your search criteria.');
        } else {
            $request->session()->forget('status');
        }

        return view('progresses.index', compact('progresses', 'search'));
    }
}
