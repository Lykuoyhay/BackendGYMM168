@extends('layouts.master')

@section('title', 'Workout Plans')
@section('content')


<div class="container-fluid px-4">




    <div class="pageTitle pt-3 pb-3 md-pt-0">
        <h3 class="md-mb-0">Workout Plan</h3>
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
                        <table id="workoutPlansTable" class="table mt-3">
                            <thead>
                                <tr>
                                    <th>Course ID</th>
                                    <th>Course Name</th>
                                    <th>Type</th>
                                    <th>Schedule</th>
                                    <th>Duration</th>
                                    <th>Requirement</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($workoutplans as $plan)
                                    <tr>
                                        <td>{{ $plan->workoutplan_id }}</td>
                                        <td>{{ $plan->course_name }}</td>
                                        <td>{{ $plan->course_type }}</td>
                                        <td>{{ $plan->schedule }}</td>
                                        <td>{{ $plan->duration }}</td>
                                        <td>{{ $plan->requirement }}</td>
                                        <td>${{ $plan->price }}</td>
                                        <td>
                                            <a href="#" class="amj-a me-2 view-detail"
                                                data-id="{{ $plan->workoutplan_id }}" data-bs-toggle="modal"
                                                data-bs-target="#modalDetail">
                                                <i class="bi bi-link-45deg"></i>
                                            </a>
                                            <a href="#" class="amj-a me-2" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $plan->workoutplan_id }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="#" class="amj-a me-2" data-bs-toggle="modal"
                                                data-bs-target="#modalDelete{{ $plan->workoutplan_id }}">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>

                    <!-- pagination -->
                    {{ $workoutplans->links() }}
                    <!-- pagination ends -->
                </div>
            </div>
        </div>
    </div>
    <!-- table ends -->


    <!-- Modal for Detail -->
    <div class="modal" id="modalDetail" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h6 class="modal-title">Course Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3 d-flex justify-content-center align-items-center">
                            <img id="modalDetailImage" class="img-fluid img-thumbnail"
                                src="https://placehold.co/200x200.png" alt="Course Image" />
                        </div>
                        <div class="col-lg-8 sm-mt-1">
                            <div>
                                <h4 id="modalDetailCourseName">Course Name: </h4>
                            </div>
                            <div>
                                <h4 id="modalDetailCourseType">Course Type: </h4>
                            </div>
                            <div>
                                <h4 id="modalDetailSchedule">Schedule: </h4>
                            </div>
                            <div>
                                <h4 id="modalDetailDuration">Duration: </h4>
                            </div>
                            <div>
                                <h4 id="modalDetailRequirement">Requirement: </h4>
                            </div>
                            <div>
                                <h4 id="modalDetailPrice">Price: </h4>
                            </div>
                            <div>
                                <h4 id="modalDetailDescription">Course Description: </h4>
                            </div>
                            <div>
                                <h4 id="modalDetailCourseID">Course ID: </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal for detail ends -->


    <!-- Modal for Insert -->
    <div class="modal" tabindex="-1" id="modalInsert">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h6 class="modal-title">Insert New Course</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertCourseForm" method="POST" action="{{ route('workoutplans.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="courseNameInsert" class="form-label">Course Name</label>
                                <input type="text" class="form-control" id="courseNameInsert" name="course_name"
                                    placeholder="Enter course name" required />
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="courseTypeInsert" class="form-label">Course Type</label>
                                <input type="text" class="form-control" id="courseTypeInsert" name="course_type"
                                    placeholder="Enter course type" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="scheduleInsert" class="form-label">Schedule</label>
                                <input type="text" class="form-control" id="scheduleInsert" name="schedule"
                                    placeholder="Enter schedule" required />
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="durationInsert" class="form-label">Duration</label>
                                <input type="text" class="form-control" id="durationInsert" name="duration"
                                    placeholder="Enter duration" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="requirementInsert" class="form-label">Requirement</label>
                                <input type="text" class="form-control" id="requirementInsert" name="requirement"
                                    placeholder="Enter requirement" />
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="priceInsert" class="form-label">Price</label>
                                <input type="number" class="form-control" id="priceInsert" name="price"
                                    placeholder="Enter price" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-lg-12">
                                <label for="courseDescriptionInsert" class="form-label">Course
                                    Description</label>
                                <textarea class="form-control" id="courseDescriptionInsert" name="course_description"
                                    placeholder="Enter course description" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-lg-12">
                                <label for="imageInsert" class="form-label">Upload Image</label>
                                <input type="file" class="form-control" id="imageInsert" name="course_image"
                                    required />
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ auth()->user()->id }}" />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning" form="insertCourseForm">Insert</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal for insert ends -->

    <!-- modal for edit -->
    @foreach ($workoutplans as $plan)
        <div class="modal fade" id="modalEdit{{ $plan->workoutplan_id }}" tabindex="-1"
            aria-labelledby="modalEditLabel{{ $plan->workoutplan_id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel{{ $plan->workoutplan_id }}">Edit
                            Workout
                            Plan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('workoutplans.update', $plan->workoutplan_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="courseNameEdit{{ $plan->workoutplan_id }}" class="form-label">Course
                                        Name</label>
                                    <input type="text" class="form-control"
                                        id="courseNameEdit{{ $plan->workoutplan_id }}" name="course_name"
                                        value="{{ $plan->course_name }}" required />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="courseTypeEdit{{ $plan->workoutplan_id }}" class="form-label">Course
                                        Type</label>
                                    <input type="text" class="form-control"
                                        id="courseTypeEdit{{ $plan->workoutplan_id }}" name="course_type"
                                        value="{{ $plan->course_type }}" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="scheduleEdit{{ $plan->workoutplan_id }}"
                                        class="form-label">Schedule</label>
                                    <input type="text" class="form-control"
                                        id="scheduleEdit{{ $plan->workoutplan_id }}" name="schedule"
                                        value="{{ $plan->schedule }}" required />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="durationEdit{{ $plan->workoutplan_id }}"
                                        class="form-label">Duration</label>
                                    <input type="text" class="form-control"
                                        id="durationEdit{{ $plan->workoutplan_id }}" name="duration"
                                        value="{{ $plan->duration }}" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="requirementEdit{{ $plan->workoutplan_id }}"
                                        class="form-label">Requirement</label>
                                    <input type="text" class="form-control"
                                        id="requirementEdit{{ $plan->workoutplan_id }}" name="requirement"
                                        value="{{ $plan->requirement }}" />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="priceEdit{{ $plan->workoutplan_id }}"
                                        class="form-label">Price</label>
                                    <input type="number" class="form-control"
                                        id="priceEdit{{ $plan->workoutplan_id }}" name="price"
                                        value="{{ $plan->price }}" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-12">
                                    <label for="courseDescriptionEdit{{ $plan->workoutplan_id }}"
                                        class="form-label">Course Description</label>
                                    <textarea class="form-control" id="courseDescriptionEdit{{ $plan->workoutplan_id }}" name="course_description"
                                        required>{{ $plan->course_description }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-12">
                                    <label for="courseImageEdit{{ $plan->workoutplan_id }}" class="form-label">Upload
                                        Image</label>
                                    <input type="file" class="form-control"
                                        id="courseImageEdit{{ $plan->workoutplan_id }}" name="course_image" />
                                    <img src="{{ asset($plan->course_image) }}" class="img-fluid mt-2"
                                        alt="Current Image">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- modal for edit ends -->


    <!-- modal for delete -->
    @foreach ($workoutplans as $plan)
        <div class="modal fade" id="modalDelete{{ $plan->workoutplan_id }}" tabindex="-1"
            aria-labelledby="modalDeleteLabel{{ $plan->workoutplan_id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDeleteLabel{{ $plan->workoutplan_id }}">Delete
                            Workout Plan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the workout plan
                            "<strong>{{ $plan->course_name }}</strong>"?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('workoutplans.destroy', $plan->workoutplan_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- modal for delete ends -->

    <!-- main_content ends -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.view-detail').forEach(function(button) {
            button.addEventListener('click', function() {
                const workoutPlanId = this.dataset.id;

                fetch(`/workoutplans/${workoutPlanId}`)
                    .then(response => response.json())
                    .then(plan => {
                        document.getElementById('modalDetailImage').src = plan
                            .course_image ? `/uploads/${plan.course_image}` :
                            'https://placehold.co/200x200.png';
                        document.getElementById('modalDetailCourseName').textContent =
                            `Course Name: ${plan.course_name}`;
                        document.getElementById('modalDetailCourseType').textContent =
                            `Course Type: ${plan.course_type}`;
                        document.getElementById('modalDetailSchedule').textContent =
                            `Schedule: ${plan.schedule}`;
                        document.getElementById('modalDetailDuration').textContent =
                            `Duration: ${plan.duration}`;
                        document.getElementById('modalDetailRequirement').textContent =
                            `Requirement: ${plan.requirement || 'None'}`;
                        document.getElementById('modalDetailPrice').textContent =
                            `Price: $${plan.price}`;
                        document.getElementById('modalDetailDescription').textContent =
                            `Course Description: ${plan.course_description}`;
                        document.getElementById('modalDetailCourseID').textContent =
                            `Course ID: ${plan.workoutplan_id}`;
                    })
                    .catch(error => console.error('Error fetching course details:', error));
            });
        });
    });
</script>

@stop