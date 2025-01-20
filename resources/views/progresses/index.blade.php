@extends('layouts.master')

@section('title', 'Progresses')
@section('content')

    <div class="container-fluid px-4">
        <!-- main_content -->


        @if (session('status'))
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
        @endif
        <!-- page title -->
        <div class="pageTitle pt-3 pb-3 md-pt-0">
            <h3 class="md-mb-0">Progress</h3>
            <div class="btn-toolbar mb-2 d-flex justify-content-end">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                        data-bs-target="#modalInsert">
                        Insert data +
                    </button>
                </div>
            </div>
        </div>
        <!-- page title ends -->

        <!-- table -->
        <div class="row sm-pt-0">
            <div class="col">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="table-responsive">
                            <table class="table overflow-scroll table-hover">
                                <thead>
                                    <tr>
                                        <th>Progress ID</th>
                                        <th>Student Name</th>
                                        <th>Workout Set Completed</th>
                                        <th>Duration</th>
                                        <th>Calories Burn</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($progresses as $progress)
                                        <tr>
                                            <td>{{ $progress->progress_id }}</td>
                                            <td>{{ $progress->user->name }}</td>
                                            <td>{{ $progress->workout_set }}</td>
                                            <td>{{ $progress->workout_duration }}</td>
                                            <td>{{ $progress->calories_burn }}</td>
                                            <td>{{ $progress->status }}</td>
                                            <td>
                                                <a href="#" class="amj-a me-2" data-id="{{ $progress->progress_id }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalDetail{{ $progress->progress_id }}">
                                                    <i class="bi bi-link-45deg"></i>
                                                </a>
                                                <a href="#" class="amj-a me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit{{ $progress->progress_id }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="#" class="amj-a me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modalDelete{{ $progress->progress_id }}">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- pagination -->
                        {{ $progresses->links() }}
                        <!-- pagination ends -->
                    </div>
                </div>
            </div>
        </div>
        <!-- table ends -->
        @foreach ($progresses as $progress)
            <!-- modal for detail -->
            <div class="modal fade" id="modalDetail{{ $progress->progress_id }}" tabindex="-1"
                aria-labelledby="modalDetailLabel{{ $progress->progress_id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDetailLabel{{ $progress->progress_id }}">
                                Progress
                                Details</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Progress ID:</strong> {{ $progress->progress_id }}</p>
                            <p><strong>User Name:</strong> {{ $progress->user->name }}</p>
                            <p><strong>Workout Set:</strong> {{ $progress->workout_set }}</p>
                            <p><strong>Workout Duration:</strong> {{ $progress->workout_duration }}</p>
                            <p><strong>Calories Burn:</strong> {{ $progress->calories_burn }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- modal for detail ends -->

        <!-- modal for insert -->
        <div class="modal fade" id="modalInsert" tabindex="-1" aria-labelledby="modalInsertLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalInsertLabel">Insert Progress</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('progresses.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="userIdInsert" class="form-label">User</label>
                                    <select class="form-control" id="userIdInsert" name="id" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="workoutSetInsert" class="form-label">Workout Set</label>
                                    <input type="text" class="form-control" id="workoutSetInsert" name="workout_set"
                                        placeholder="Enter workout set" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="workoutDurationInsert" class="form-label">Workout Duration</label>
                                    <input type="text" class="form-control" id="workoutDurationInsert"
                                        name="workout_duration" placeholder="Enter workout duration" required />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="caloriesBurnInsert" class="form-label">Calories Burn</label>
                                    <input type="number" class="form-control" id="caloriesBurnInsert" name="calories_burn"
                                        placeholder="Enter calories burn" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="statusInsert" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="statusInsert" name="status"
                                        placeholder="Enter status (e.g., Done, Rest Day, Skip Day)" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Insert</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- modal for insert ends -->

        <!-- modal for edit -->
        @foreach ($progresses as $progress)
            <div class="modal fade" id="modalEdit{{ $progress->progress_id }}" tabindex="-1"
                aria-labelledby="modalEditLabel{{ $progress->progress_id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditLabel{{ $progress->progress_id }}">Edit
                                Progress
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('progresses.update', ['id' => $progress->progress_id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="mb-3 col-lg-6">
                                        <label for="workoutSetEdit{{ $progress->progress_id }}"
                                            class="form-label">Workout Set</label>
                                        <input type="text" class="form-control"
                                            id="workoutSetEdit{{ $progress->progress_id }}" name="workout_set"
                                            value="{{ $progress->workout_set }}" required />
                                    </div>
                                    <div class="mb-3 col-lg-6">
                                        <label for="workoutDurationEdit{{ $progress->progress_id }}"
                                            class="form-label">Workout Duration</label>
                                        <input type="text" class="form-control"
                                            id="workoutDurationEdit{{ $progress->progress_id }}" name="workout_duration"
                                            value="{{ $progress->workout_duration }}" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-6">
                                        <label for="caloriesBurnEdit{{ $progress->progress_id }}"
                                            class="form-label">Calories Burn</label>
                                        <input type="number" class="form-control"
                                            id="caloriesBurnEdit{{ $progress->progress_id }}" name="calories_burn"
                                            value="{{ $progress->calories_burn }}" required />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- modal for edit ends -->


        <!-- Delete Modal -->
        @foreach ($progresses as $progress)
            <div class="modal fade" id="modalDelete{{ $progress->progress_id }}" tabindex="-1"
                aria-labelledby="modalDeleteLabel{{ $progress->progress_id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDeleteLabel{{ $progress->progress_id }}">Delete
                                Progress</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this progress?</p>
                            <form action="{{ route('progresses.destroy', ['id' => $progress->progress_id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- modal for delete ends -->

        <!-- main_content ends -->
    </div>

@stop
