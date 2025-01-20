<?php

use App\Http\Controllers\CoachController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Studentcontroller;
use App\Http\Controllers\WorkoutplanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// //http://127.0.0.1:8000/dashboard
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// routes/web.php

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboards', [StudentController::class, 'index'])->name('dashboards.index');
    Route::post('dashboards', [StudentController::class, 'store'])->name('dashboards.store');
    Route::get('/dashboards/{id}', [StudentController::class, 'show'])->where('id', '[0-9]+')->name('dashboards.show'); // Show student details
    Route::get('dashboards/{id}/edit', [StudentController::class, 'edit'])->name('dashboards.edit'); // Edit student form
    Route::post('dashboards/{id}', [StudentController::class, 'update'])->name('dashboards.update'); // Update student
    Route::get('dashboards/{id}/delete', [StudentController::class, 'delete'])->name('dashboards.delete');
    //search
    Route::get('/dashboards/search', [StudentController::class, 'search'])->name('dashboards.search');
});




//coach
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('coaches', [CoachController::class, 'index'])->name('coaches.index');
    Route::post('coaches', [CoachController::class, 'store'])->name('coaches.store');
    Route::get('coaches/{id}/edit', [CoachController::class, 'edit'])->name('coaches.edit'); // Edit coach form
    Route::put('coaches/{id}', [CoachController::class, 'update'])->name('coaches.update'); // Update coach
    Route::get('coaches/{id}/delete', [CoachController::class, 'delete'])->name('coaches.delete');
    Route::post('coaches/storeCoachStudent', [CoachController::class, 'storeCoachStudent'])->name('coaches.storeCoachStudent');
    Route::put('coaches/{id}/updateCoachStudent', [CoachController::class, 'updateCoachStudent'])->name('coaches.updateCoachStudent');
    Route::delete('coaches/{id}/deleteCoachStudent', [CoachController::class, 'deleteCoachStudent'])->name('coaches.deleteCoachStudent');

    //search
    // web.php
    Route::get('/coaches/search', [CoachController::class, 'search'])->name('coaches.search');
    // Route::get('/coaches/coachstudents/search', [CoachController::class, 'searchCoachStudents'])->name('coaches.coachstudents.search');

});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('workoutplans', [WorkoutPlanController::class, 'index'])->name('workoutplans.index');
    Route::post('workoutplans', [WorkoutPlanController::class, 'store'])->name('workoutplans.store');
    Route::get('workoutplans/{workoutplan_id}', [WorkoutPlanController::class, 'show'])->name('workoutplans.show');
    Route::put('/workoutplans/{id}', [WorkoutPlanController::class, 'update'])->name('workoutplans.update');
    Route::delete('/workoutplans/{id}', [WorkoutPlanController::class, 'destroy'])->name('workoutplans.destroy');
    //search
    Route::get('/workoutplans/search', [WorkoutPlanController::class, 'search'])->name('workoutplans.search');
});


//resource
Route::middleware(['auth', 'verified'])->group(function () {
    // Resources (articles and exercises) routes
    Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');
    Route::get('/resources/{id}', [ResourceController::class, 'show'])->name('resources.show');
    Route::post('/resources', [ResourceController::class, 'store'])->name('resources.store');
    Route::put('/resources/{id}', [ResourceController::class, 'update'])->name('resources.update');
    Route::delete('/resources/{id}', [ResourceController::class, 'destroy'])->name('resources.destroy');
});


//progress
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/progresses', [ProgressController::class, 'index'])->name('progresses.index');
    Route::get('/progresses/{id}', [ProgressController::class, 'show'])->name('progresses.show');
    Route::post('/progresses', [ProgressController::class, 'store'])->name('progresses.store');
    Route::put('/progresses/{id}', [ProgressController::class, 'update'])->name('progresses.update');
    Route::delete('/progresses/{id}', [ProgressController::class, 'destroy'])->name('progresses.destroy');
    Route::get('/progresses/search', [ProgressController::class, 'search'])->name('progresses.search');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/liststudents', [ProgressController::class, 'index'])->name('liststudents.index');
    // Route::get('/progresses/{id}', [ProgressController::class, 'show'])->name('progresses.show');
    // Route::post('/progresses', [ProgressController::class, 'store'])->name('progresses.store');
    // Route::put('/progresses/{id}', [ProgressController::class, 'update'])->name('progresses.update');
    // Route::delete('/progresses/{id}', [ProgressController::class, 'destroy'])->name('progresses.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';







