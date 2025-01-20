@extends('layouts.master')

@section('title', 'Students')
@section('content')

    <div class="container-fluid px-4">
        <!-- page title -->
        <div class="pageTitle pt-3 pb-3 md-pt-0">
            <h3 class="md-mb-0">Students</h3>
            <div class="btn-toolbar mb-2 d-flex justify-content-end">
                <form class="col-xl-6 col-md-auto col-lg-auto mb-0 me-xl-3" role="search"
                    action="{{ route('dashboards.search') }}" method="GET">
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

        <!-- table -->
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
                                        <th>Student Id</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (session('status'))
                                        <div class="alert alert-info">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @foreach ($students as $student)
                                        <tr>
                                            <td class="d-flex align-items-center">
                                                <img src="{{ asset($student->image) }}" class="productImg me-2"
                                                    alt="Student Image" />
                                                <a href="#" class="text-white amj-a" data-bs-toggle="modal"
                                                    data-bs-target="#modalDetail" data-name="{{ $student->name }}"
                                                    data-gender="{{ $student->gender }}"
                                                    data-telephone="{{ $student->telephone }}"
                                                    data-email="{{ $student->email }}"
                                                    data-image="{{ asset($student->image) }}"
                                                    data-student-id="{{ $student->id }}">
                                                    {{ $student->name }}
                                                </a>
                                            </td>
                                            <td>{{ $student->gender }}</td>
                                            <td>{{ $student->telephone }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->id }}</td>
                                            <td>
                                                <a href="#" class="amj-a me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modalDetail" data-name="{{ $student->name }}"
                                                    data-gender="{{ $student->gender }}"
                                                    data-telephone="{{ $student->telephone }}"
                                                    data-email="{{ $student->email }}"
                                                    data-image="{{ asset($student->image) }}"
                                                    data-student-id="{{ $student->id }}">
                                                    <i class="bi bi-link-45deg"></i>
                                                </a>
                                                <a href="#" class="amj-a me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit{{ $student->id }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="javascript:;" class="amj-a me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modalDeleteConfirmation{{ $student->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- pagination -->
                        {{ $students->links() }}
                        <!-- pagination ends -->
                    </div>
                </div>
            </div>
        </div>
        <!-- table ends -->
        <!-- modal for detail -->
        <div class="modal" id="modalDetail" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h6 class="modal-title">Student</h6>
                        <a href="dashboards" class="btn-close"></a>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3 d-flex justify-content-center align-item-center">
                                <img id="student-image" class="img-fluid img-thumbnail" src="" alt="" />
                            </div>
                            <div class="col-lg-8 sm-mt-1">
                                <div>
                                    <h4 id="student-name"></h4>
                                </div>
                                <div>
                                    <h4 id="student-gender"></h4>
                                </div>
                                <div>
                                    <h4 id="student-telephone"></h4>
                                </div>
                                <div>
                                    <h4 id="student-email"></h4>
                                </div>
                                <div>
                                    <h4 id="student-id"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- modal for detail ends -->

        <!-- modal for insert -->
        <!-- Modal -->
        <div class="modal modal-dark" tabindex="-1" id="modalInsert">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h6 class="modal-title">Insert New Student</h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('dashboards.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="nameInput" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="nameInput" placeholder="fullname"
                                        name="name" required />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="genderSelect" class="form-label">Gender</label>
                                    <select id="genderSelect" class="form-select" name="gender"
                                        aria-label="Default select example">
                                        <option selected value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <label for="telephoneInput" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="telephoneInput"
                                        placeholder="eg. 095656234" name="telephone" required />
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="emailInput" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emailInput"
                                        placeholder="eg. lsout@paragoniu.edu.kh" name="email" required />
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="passwordInput" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="passwordInput"
                                        placeholder="Hay#6929" name="password" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-12">
                                    <label for="imageInput" class="form-label">Upload image</label>
                                    <input class="form-control" type="file" id="imageInput" name="image" />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal for insert ends -->

        <!-- Modal for Edit -->
        @foreach ($students as $student)
            <!-- Modal for Edit -->
            <div class="modal modal-dark" tabindex="-1" id="modalEdit{{ $student->id }}">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h6 class="modal-title">Update Student</h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">


                            <form method="POST" action="{{ route('dashboards.update', ['id' => $student->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-lg-6">
                                        <label for="nameInput" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="nameInput" name="name"
                                            value="{{ $student->name }}" required />
                                    </div>
                                    <div class="mb-3 col-lg-6">
                                        <label for="genderSelect" class="form-label">Gender</label>
                                        <select id="genderSelect" class="form-select" name="gender" required>
                                            <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-6">
                                        <label for="telephoneInput" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="telephoneInput" name="telephone"
                                            value="{{ $student->telephone }}" required />
                                    </div>
                                    <div class="mb-3 col-lg-6">
                                        <label for="emailInput" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="emailInput" name="email"
                                            value="{{ $student->email }}" required />
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
        <!-- modal for delete -->
        @foreach ($students as $student)
            <div class="modal modal-dark" tabindex="-1" id="modalDeleteConfirmation{{ $student->id }}">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h6 class="modal-title">You are about to delete</h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger mb-0" role="alert">
                                Are you sure you want to delete this student?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="{{ route('dashboards.delete', ['id' => $student->id]) }}"
                                class="btn btn-danger">Yes, I am
                                sure</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- modal for delete ends -->

    </div>
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
                var studentId = button.getAttribute('data-student-id');

                var modalTitle = modalDetail.querySelector('.modal-title');
                var studentImage = modalDetail.querySelector('#student-image');
                var studentName = modalDetail.querySelector('#student-name');
                var studentGender = modalDetail.querySelector('#student-gender');
                var studentTelephone = modalDetail.querySelector('#student-telephone');
                var studentEmail = modalDetail.querySelector('#student-email');
                var studentIdSpan = modalDetail.querySelector('#student-id');

                modalTitle.textContent = 'Student Details';
                studentImage.src = image;
                studentName.textContent = "Name: " + name;
                studentGender.textContent = "Gender: " + gender;
                studentTelephone.textContent = "Contact Number: " + telephone;
                studentEmail.textContent = "Email: " + email;
                studentIdSpan.textContent = "Student ID: " + studentId;
            });
        });
    </script>

@stop
