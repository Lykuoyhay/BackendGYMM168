<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index()
    {
        $articles = Resource::where('type', 'article')->orderBy('resource_id', 'desc')->paginate(10);
        $exercises = Resource::where('type', 'exercise')->orderBy('resource_id', 'desc')->paginate(10);
        return view('resources.index', compact('articles', 'exercises'));
    }

    public function show($id)
    {
        $resource = Resource::findOrFail($id);
        return response()->json($resource);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'type' => 'required|string|in:article,exercise',
            'subtitle' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'img_cover' => 'nullable', // max size 2MB
            'paragraph1' => 'nullable|string',
            'paragraph1_img' => 'nullable', // max size 2MB
            'paragraph2' => 'nullable|string',
            'paragraph2_img' => 'nullable', // max size 2MB
            'exercise_type' => 'nullable|string|max:255',
            'exercise_muscle' => 'nullable|string|max:255',
            'exercise_equipment' => 'nullable|string|max:255',
            'exercise_difficulty' => 'nullable|string|max:255',
            'exercise_description' => 'nullable|string',
        ]);

        // Handle img_cover
        $img_cover_path = $request->file('img_cover') ? $request->file('img_cover')->store('uploads/images', 'public') : null;
        // Handle paragraph1_img
        $paragraph1_img_path = $request->file('paragraph1_img') ? $request->file('paragraph1_img')->store('uploads/images', 'public') : null;
        // Handle paragraph2_img
        $paragraph2_img_path = $request->file('paragraph2_img') ? $request->file('paragraph2_img')->store('uploads/images', 'public') : null;

        $validatedData['img_cover'] = $img_cover_path;
        $validatedData['paragraph1_img'] = $paragraph1_img_path;
        $validatedData['paragraph2_img'] = $paragraph2_img_path;

        Resource::create($validatedData);

        return redirect()->route('resources.index')->with('success', 'Resource created successfully.');
    }

    public function update(Request $request, $id)
    {
        $resource = Resource::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'type' => 'nullable|string|in:article,exercise',
            'subtitle' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'img_cover' => 'nullable', // max size 2MB
            'paragraph1' => 'nullable|string',
            'paragraph1_img' => 'nullable', // max size 2MB
            'paragraph2' => 'nullable|string',
            'paragraph2_img' => 'nullable', // max size 2MB
            'exercise_type' => 'nullable|string|max:255',
            'exercise_muscle' => 'nullable|string|max:255',
            'exercise_equipment' => 'nullable|string|max:255',
            'exercise_difficulty' => 'nullable|string|max:255',
            'exercise_description' => 'nullable|string',
        ]);

        // Handle img_cover
        $img_cover_path = $request->file('img_cover') ? $request->file('img_cover')->store('uploads/images', 'public') : $resource->img_cover;
        // Handle paragraph1_img
        $paragraph1_img_path = $request->file('paragraph1_img') ? $request->file('paragraph1_img')->store('uploads/images', 'public') : $resource->paragraph1_img;
        // Handle paragraph2_img
        $paragraph2_img_path = $request->file('paragraph2_img') ? $request->file('paragraph2_img')->store('uploads/images', 'public') : $resource->paragraph2_img;

        $validatedData['img_cover'] = $img_cover_path;
        $validatedData['paragraph1_img'] = $paragraph1_img_path;
        $validatedData['paragraph2_img'] = $paragraph2_img_path;

        $resource->update($validatedData);

        return redirect()->route('resources.index')->with('success', 'Resource updated successfully.');
    }

    public function destroy($id)
    {
        $resource = Resource::findOrFail($id);

        // // Delete images from storage if they exist
        // if ($resource->img_cover) {
        //     Storage::disk('public')->delete($resource->img_cover);
        // }
        // if ($resource->paragraph1_img) {
        //     Storage::disk('public')->delete($resource->paragraph1_img);
        // }
        // if ($resource->paragraph2_img) {
        //     Storage::disk('public')->delete($resource->paragraph2_img);
        // }

        $resource->delete();

        return redirect()->route('resources.index')->with('success', 'Resource deleted successfully.');
    }
}

