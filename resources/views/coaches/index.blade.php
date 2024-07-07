@extends('layouts.master')

@section('title', 'Coaches')
@section('content')


    <div class="container-fluid px-4">
        <!-- page title -->
        <div class="pageTitle pt-3 pb-3 md-pt-0">
            <h3 class="md-mb-0">Coach</h3>
            <div class="btn-toolbar mb-2 d-flex justify-content-end">
                <form class="col-xl-6 col-md-auto col-lg-auto mb-0 me-xl-3" role="search"
                    action="{{ route('coaches.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="search here" />
                        <button type="submit" class="btn">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                        data-bs-target="#modalInsert">
                        Insert data +
                    </button>
                </div>

            </div>
        </div>
        <!-- page title ends -->
        <!-- table coach-->
        <div class="row sm-pt-0">
            <div class="col">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="table-responsive">
                            <table class="table overflow-scroll table-hover">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Gender</th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                        <th>Coach Id</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (session('status'))
                                        <div class="alert alert-info">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @foreach ($coaches as $coach)
                                        <tr>
                                            <td class="d-flex align-items-center">
                                                <img src="{{ asset($coach->image) }}" class="productImg me-2"
                                                    alt="Student Image" />
                                                <a href="" class="text-white amj-a">
                                                    {{ $coach->name }}
                                                </a>
                                            </td>
                                            <td>{{ $coach->gender }}</td>
                                            <td>{{ $coach->telephone }}</td>
                                            <td>{{ $coach->email }}</td>
                                            <td>{{ $coach->id }}</td>
                                            <td>
                                                <a href="#" class="amj-a me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modalDetail" data-name="{{ $coach->name }}"
                                                    data-gender="{{ $coach->gender }}"
                                                    data-telephone="{{ $coach->telephone }}"
                                                    data-email="{{ $coach->email }}"
                                                    data-image="{{ asset($coach->image) }}"
                                                    data-coach-id="{{ $coach->id }}">
                                                    <i class="bi bi-link-45deg"></i>
                                                </a>
                                                <a href="javascript:;" class="amj-a me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit{{ $coach->id }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="javascript:;" class="amj-a me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modalDeleteConfirmation{{ $coach->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- pagination -->
                        {{ $coaches->links() }}
                        <!-- pagination ends -->
                    </div>
                </div>
            </div>
        </div>
        <!-- table coach ends -->

        <!-- modal for coach detail -->
        <div class="modal" id="modalDetail" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Coach</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3 d-flex justify-content-center align-item-center">
                                <img class="img-fluid img-thumbnail" src="https://placehold.co/200x200.png" alt=""
                                    id="coachImage" />
                            </div>
                            <div class="col-lg-8 sm-mt-1">
                                <div>
                                    <h4>Fullname: <span id="coachName"></span></h4>
                                </div>
                                <div>
                                    <h4>Gender: <span id="coachGender"></span></h4>
                                </div>
                                <div>
                                    <h4>Contact Number: <span id="coachTelephone"></span></h4>
                                </div>
                                <div>
                                    <h4>Email: <span id="coachEmail"></span></h4>
                                </div>
                                <div>
                                    <h4>Coach ID: <span id="coachId"></span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal for coach detail ends -->

        <!-- modal for coach insert -->
        <div class="modal modal-dark" tabindex="-1" id="modalInsert">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h6 class="modal-title">Insert New Coach</h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('coaches.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="nameInput" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="nameInput" name="name"
                                        placeholder="fullname" required />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="genderSelect" class="form-label">Gender</label>
                                    <select id="genderSelect" class="form-select" name="gender" required>
                                        <option selected value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="telephoneInput" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="telephoneInput" name="telephone"
                                        placeholder="eg. 095656234" required />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="emailInput" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emailInput" name="email"
                                        placeholder="eg. lsout@paragoniu.edu.kh" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="passwordInput" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="passwordInput" name="password"
                                        placeholder="Password" required />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="roleInput" class="form-label">Role</label>
                                    <input type="text" class="form-control" id="roleInput" name="role"
                                        value="coach" readonly />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-12">
                                    <label for="imageInput" class="form-label">Upload Image</label>
                                    <input class="form-control" type="file" id="imageInput" name="image" />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal for coach insert ends -->

        <!-- modal for coach edit -->
        @foreach ($coaches as $coach)
            <div class="modal modal-dark" tabindex="-1" id="modalEdit{{ $coach->id }}">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h6 class="modal-title">Update Coach</h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('coaches.update', ['id' => $coach->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="mb-3 col-lg-6">
                                        <label for="nameInput" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="nameInput" name="name"
                                            value="{{ $coach->name }}" required />
                                    </div>
                                    <div class="mb-3 col-lg-6">
                                        <label for="genderSelect" class="form-label">Gender</label>
                                        <select id="genderSelect" class="form-select" name="gender" required>
                                            <option value="Male" {{ $coach->gender == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="Female" {{ $coach->gender == 'Female' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-6">
                                        <label for="telephoneInput" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="telephoneInput" name="telephone"
                                            value="{{ $coach->telephone }}" required />
                                    </div>
                                    <div class="mb-3 col-lg-6">
                                        <label for="emailInput" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="emailInput" name="email"
                                            value="{{ $coach->email }}" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-6">
                                        <label for="passwordInput" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="passwordInput" name="password"
                                            placeholder="Leave blank to keep current password" />
                                    </div>
                                    <div class="mb-3 col-lg-6">
                                        <label for="imageInput" class="form-label">Upload image</label>
                                        <input class="form-control" type="file" id="imageInput" name="image" />
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

        <!-- modal for coach delete -->
        @foreach ($coaches as $coach)
            <div class="modal modal-dark" tabindex="-1" id="modalDeleteConfirmation{{ $coach->id }}">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h6 class="modal-title">You are about to delete</h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger mb-0" role="alert">
                                Are you sure you want to delete this coach?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="{{ route('coaches.delete', ['id' => $coach->id]) }}" class="btn btn-danger">Yes, I
                                am
                                sure</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- modal for coach delete ends -->


        <!-- insert liststudent -->
        <div class="pageTitle pt-3 pb-3 md-pt-0">
            <h3 class="md-mb-0">List Student</h3>
            <div class="btn-toolbar mb-2 d-flex justify-content-end">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                        data-bs-target="#modalInsertCoachStudent">
                        Insert data +
                    </button>
                </div>
            </div>
        </div>


        <!-- table liststudent -->
        <div class="row sm-pt-0">
            <div class="col">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="table-responsive">
                            <table class="table overflow-scroll table-hover">
                                <thead>
                                    <tr>
                                        <th>Coach</th>
                                        <th>Student</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (session('status'))
                                        <div class="alert alert-info">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @foreach ($coachstudents as $coachstudent)
                                        <tr>
                                            <td class="d-flex align-items-center">
                                                @if ($coachstudent->coach)
                                                    <img src="{{ asset($coachstudent->coach->image) }}"
                                                        class="productImg me-2" alt="Coach Image" />
                                                    <a href="#" class="text-white amj-a" data-bs-toggle="modal"
                                                        data-bs-target="#modalDetail"
                                                        data-name="{{ $coachstudent->coach->name }}"
                                                        data-gender="{{ $coachstudent->coach->gender }}"
                                                        data-telephone="{{ $coachstudent->coach->telephone }}"
                                                        data-email="{{ $coachstudent->coach->email }}"
                                                        data-image="{{ asset($coachstudent->coach->image) }}"
                                                        data-coach-id="{{ $coachstudent->coach->id }}">
                                                        {{ $coachstudent->coach->name }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">No Coach</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($coachstudent->student)
                                                    {{ $coachstudent->student->name }}
                                                @else
                                                    <span class="text-muted">No Student</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="amj-a me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditCoachStudent{{ $coachstudent->id }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="javascript:;" class="amj-a me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modalDeleteCoachStudent{{ $coachstudent->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                                <a href="javascript:;" class="amj-a me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modalDetailCoachStudent"
                                                    @if ($coachstudent->coach) data-coach-name="{{ $coachstudent->coach->name }}"
                    data-coach-gender="{{ $coachstudent->coach->gender }}"
                    data-coach-telephone="{{ $coachstudent->coach->telephone }}"
                    data-coach-email="{{ $coachstudent->coach->email }}"
                    data-coach-image="{{ asset($coachstudent->coach->image) }}" @endif
                                                    @if ($coachstudent->student) data-student-name="{{ $coachstudent->student->name }}"
                    data-student-gender="{{ $coachstudent->student->gender }}"
                    data-student-telephone="{{ $coachstudent->student->telephone }}"
                    data-student-email="{{ $coachstudent->student->email }}"
                    data-student-image="{{ asset($coachstudent->student->image) }}" @endif>
                                                    <i class="bi bi-info-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        {{ $coachstudents->links() }}
                        <!-- Pagination ends -->
                    </div>
                </div>
            </div>
        </div>
        <!-- table liststudent ends -->


        <!-- Insert Modal -->
        <!--list table-->
        <div class="modal fade" id="modalInsertCoachStudent" tabindex="-1"
            aria-labelledby="modalInsertCoachStudentLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('coaches.storeCoachStudent') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalInsertCoachStudentLabel">Insert Coach-Student
                                Relationship</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="coach_id" class="form-label">Coach</label>
                                <select class="form-select" id="coach_id" name="coach_id" required>
                                    @foreach ($coaches as $coach)
                                        <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="student_id" class="form-label">Student</label>
                                <select class="form-select" id="student_id" name="student_id" required>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Insert</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Detail Modal -->
        <div class="modal fade" id="modalDetailCoachStudent" tabindex="-1"
            aria-labelledby="modalDetailCoachStudentLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetailCoachStudentLabel">Coach-Student Relationship
                            Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-center">
                            <img id="detailCoachImage" src="" class="productImg me-2" alt="Coach Image" />
                            <p><strong>Coach:</strong> <span id="detailCoachName"></span></p>
                        </div>
                        <p class="pt-2"><strong>Gender:</strong> <span id="detailCoachGender"></span></p>
                        <p class="pt-2"><strong>Telephone:</strong> <span id="detailCoachTelephone"></span></p>
                        <p class="pt-2"><strong>Email:</strong> <span id="detailCoachEmail"></span></p>
                        <div class="d-flex align-items-center pt-2">
                            <img id="detailStudentImage" src="" class="productImg me-2" alt="Student Image" />
                            <p><strong>Student:</strong> <span id="detailStudentName"></span></p>
                        </div>
                        <p class="pt-2"><strong>Gender:</strong> <span id="detailStudentGender"></span></p>
                        <p class="pt-2"><strong>Telephone:</strong> <span id="detailStudentTelephone"></span></p>
                        <p class="pt-2"><strong>Email:</strong> <span id="detailStudentEmail"></span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        @foreach ($coachstudents as $coachstudent)
            <div class="modal fade" id="modalEditCoachStudent{{ $coachstudent->id }}" tabindex="-1"
                aria-labelledby="modalEditCoachStudentLabel{{ $coachstudent->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('coaches.updateCoachStudent', ['id' => $coachstudent->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditCoachStudentLabel{{ $coachstudent->id }}">Edit
                                    Coach-Student Relationship</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="edit_coach_id{{ $coachstudent->id }}" class="form-label">Coach</label>
                                    <select class="form-select" id="edit_coach_id{{ $coachstudent->id }}"
                                        name="coach_id" required>
                                        @foreach ($coaches as $coach)
                                            <option value="{{ $coach->id }}"
                                                {{ $coach->id == $coachstudent->coach_id ? 'selected' : '' }}>
                                                {{ $coach->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_student_id{{ $coachstudent->id }}"
                                        class="form-label">Student</label>
                                    <select class="form-select" id="edit_student_id{{ $coachstudent->id }}"
                                        name="student_id" required>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}"
                                                {{ $student->id == $coachstudent->student_id ? 'selected' : '' }}>
                                                {{ $student->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        <!-- Delete Modal -->
        @foreach ($coachstudents as $coachstudent)
            <div class="modal fade" id="modalDeleteCoachStudent{{ $coachstudent->id }}" tabindex="-1"
                aria-labelledby="modalDeleteCoachStudentLabel{{ $coachstudent->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('coaches.deleteCoachStudent', ['id' => $coachstudent->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDeleteCoachStudentLabel{{ $coachstudent->id }}">Delete
                                    Coach-Student Relationship</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this Coach-Student relationship?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
        <!-- main_content ends -->
    </div>

    <!-- #pageContent ends -->

    <!-- for coach -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalDetail = document.getElementById('modalDetail');
            modalDetail.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var name = button.getAttribute('data-name');
                var gender = button.getAttribute('data-gender');
                var telephone = button.getAttribute('data-telephone');
                var email = button.getAttribute('data-email');
                var image = button.getAttribute('data-image');
                var coachId = button.getAttribute('data-coach-id');

                var modalTitle = modalDetail.querySelector('.modal-title');
                var coachImage = modalDetail.querySelector('#coachImage');
                var coachName = modalDetail.querySelector('#coachName');
                var coachGender = modalDetail.querySelector('#coachGender');
                var coachTelephone = modalDetail.querySelector('#coachTelephone');
                var coachEmail = modalDetail.querySelector('#coachEmail');
                var coachIdSpan = modalDetail.querySelector('#coachId');

                modalTitle.textContent = 'Coach Details';
                coachImage.src = image;
                coachName.textContent = name;
                coachGender.textContent = gender;
                coachTelephone.textContent = telephone;
                coachEmail.textContent = email;
                coachIdSpan.textContent = coachId;
            });
        });
    </script>
    <!-- /for coach -->
    <!-- for studentcoach -->
    <script>
        // Add this script at the bottom of your Blade template or in a separate JS file
        document.addEventListener('DOMContentLoaded', function() {
            var detailModal = document.getElementById('modalDetailCoachStudent');
            detailModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;

                var coachName = button.getAttribute('data-coach-name');
                var coachGender = button.getAttribute('data-coach-gender');
                var coachTelephone = button.getAttribute('data-coach-telephone');
                var coachEmail = button.getAttribute('data-coach-email');
                var coachImage = button.getAttribute('data-coach-image');

                var studentName = button.getAttribute('data-student-name');
                var studentGender = button.getAttribute('data-student-gender');
                var studentTelephone = button.getAttribute('data-student-telephone');
                var studentEmail = button.getAttribute('data-student-email');
                var studentImage = button.getAttribute('data-student-image');

                var modalTitle = detailModal.querySelector('.modal-title');
                var detailCoachName = detailModal.querySelector('#detailCoachName');
                var detailCoachGender = detailModal.querySelector('#detailCoachGender');
                var detailCoachTelephone = detailModal.querySelector('#detailCoachTelephone');
                var detailCoachEmail = detailModal.querySelector('#detailCoachEmail');
                var detailCoachImage = detailModal.querySelector('#detailCoachImage');

                var detailStudentName = detailModal.querySelector('#detailStudentName');
                var detailStudentGender = detailModal.querySelector('#detailStudentGender');
                var detailStudentTelephone = detailModal.querySelector('#detailStudentTelephone');
                var detailStudentEmail = detailModal.querySelector('#detailStudentEmail');
                var detailStudentImage = detailModal.querySelector('#detailStudentImage');

                detailCoachName.textContent = coachName;
                detailCoachGender.textContent = coachGender;
                detailCoachTelephone.textContent = coachTelephone;
                detailCoachEmail.textContent = coachEmail;
                detailCoachImage.src = coachImage;

                detailStudentName.textContent = studentName;
                detailStudentGender.textContent = studentGender;
                detailStudentTelephone.textContent = studentTelephone;
                detailStudentEmail.textContent = studentEmail;
                detailStudentImage.src = studentImage;
            });
        });
    </script>
    <!-- /for studentcoach -->
@stop
