@extends('layouts.master')

@section('title', 'Resources')
@section('content')

<div class="container-fluid px-4">
    <!-- section searchForMobile -->
    {{-- <div class="row my-4 sm-my-3 sm-mt-0" id="searchForMobile">
                    <div class="col">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-dark text-bg-dark text-white"
                                    value="search here" />
                                <a class="btn" href="../search-results/index.html">
                                    <i class="bi bi-search"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div> --}}
    <!-- section searchForMobile ends -->

    <!-- main_content -->


    <!-- Page Title -->
    <div class="pageTitle pt-3 pb-3 md-pt-0">
        <h3 class="md-mb-0">Resources</h3>
        <div class="btn-toolbar mb-2 d-flex justify-content-end">
            {{-- <form class="col-xl-6 col-md-auto col-lg-auto mb-0 me-xl-3" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search here" />
                                <a class="btn" href="../search-results/index.html">
                                    <i class="bi bi-search"></i>
                                </a>
                            </div>
                        </form> --}}
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                    data-bs-target="#modalInsertArticle">
                    Insert Article +
                </button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                    data-bs-target="#modalInsertExercise">
                    Insert Exercise +
                </button>
            </div>
        </div>
    </div>

    <!-- Articles Table -->
    <div class="table-responsive">
        <h3 class="md-mb-0">Article</h3>
        <table id="articlesTable" class="table mt-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Author</th>
                    <th>Cover Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->subtitle }}</td>
                        <td>{{ $article->author }}</td>
                        <td><img src="{{ asset('storage/' . $article->img_cover) }}" alt="Cover Image" width="100">
                        </td>
                        <td>
                            <a href="#" class="amj-a me-2 view-detail" data-id="{{ $article->resource_id }}"
                                data-bs-toggle="modal" data-bs-target="#modalDetailArticle{{ $article->resource_id }}">
                                <i class="bi bi-link-45deg"></i>
                            </a>
                            <a href="#" class="amj-a me-2" data-bs-toggle="modal"
                                data-bs-target="#modalEditArticle{{ $article->resource_id }}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="#" class="amj-a me-2 delete-article" data-id="{{ $article->resource_id }}"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDeleteArticleConfirmation{{ $article->resource_id }}">
                                <i class="bi bi-trash"></i>
                            </a>


                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    <!--End Articles Table -->
    {{ $articles->links() }}
    <!-- Exercises Table -->
    <div class="table-responsive mt-5">
        <h3 class="md-mb-0">Exercise</h3>
        <table id="exercisesTable" class="table mt-3">
            <thead>
                <tr>
                    <th>Cover Image</th>
                    <th>Type</th>
                    <th>Muscle</th>
                    <th>Equipment</th>
                    <th>Difficulty</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exercises as $exercise)
                    <tr>
                        <td><img src="{{ asset('storage/' . $exercise->img_cover) }}" alt="Cover Image" width="100">
                        </td>
                        <td>{{ $exercise->exercise_type }}</td>
                        <td>{{ $exercise->exercise_muscle }}</td>
                        <td>{{ $exercise->exercise_equipment }}</td>
                        <td>{{ $exercise->exercise_difficulty }}</td>
                        <td>
                            <a href="#" class="amj-a me-2 view-detail" data-id="{{ $exercise->resource_id }}"
                                data-bs-toggle="modal" data-bs-target="#modalDetailExercise">
                                <i class="bi bi-link-45deg"></i>
                            </a>
                            <a href="#" class="amj-a me-2" data-bs-toggle="modal"
                                data-bs-target="#modalEditExercise{{ $exercise->resource_id }}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="#" class="amj-a me-2" data-bs-toggle="modal"
                                data-bs-target="#modalDeleteExerciseConfirmation{{ $exercise->resource_id }}">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- End Exercises Table -->
    {{ $exercises->links() }}
    <!-- End Detail Modal -->
    @foreach ($exercises as $exercise)
        <div class="modal fade" id="modalDetailExercise" tabindex="-1" aria-labelledby="modalDetailExerciseLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetailExerciseLabel">Exercise Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Content to display exercise details -->
                        <h5>Type: {{ $exercise->exercise_type }}</h5>
                        <p>Muscle Targeted: {{ $exercise->exercise_muscle }}</p>
                        <p>Equipment Needed: {{ $exercise->exercise_equipment }}</p>
                        <p>Difficulty: {{ $exercise->exercise_difficulty }}</p>
                        <p>Description: {{ $exercise->exercise_description }}</p>
                        <!-- Add more fields as needed -->
                        <img src="{{ asset('uploads/images/' . $exercise->img_cover) }}" class="img-fluid mb-3"
                            alt="Exercise Image">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($articles as $article)
        <div class="modal fade" id="modalDetailArticle{{ $article->resource_id }}" tabindex="-1"
            aria-labelledby="modalDetailArticleLabel{{ $article->resource_id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetailArticleLabel{{ $article->resource_id }}">
                            Article Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Content to display article details -->
                        <h5>Title: {{ $article->title }}</h5>
                        <p>Subtitle: {{ $article->subtitle }}</p>
                        <p>Author: {{ $article->author }}</p>
                        <!-- Add more fields as needed -->
                        <img src="{{ asset('uploads/images/' . $article->img_cover) }}" class="img-fluid mb-3"
                            alt="Article Image">
                        <p>{{ $article->paragraph1 }}</p>
                        @if ($article->paragraph1_img)
                            <img src="{{ asset('uploads/images/' . $article->paragraph1_img) }}"
                                class="img-fluid mb-3" alt="Article Image">
                        @endif
                        <p>{{ $article->paragraph2 }}</p>
                        @if ($article->paragraph2_img)
                            <img src="{{ asset('uploads/images/' . $article->paragraph2_img) }}"
                                class="img-fluid mb-3" alt="Article Image">
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Insert Modal -->
    <div class="modal" tabindex="-1" id="modalInsertArticle">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h6 class="modal-title">Insert New Article</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertArticleForm" method="POST" action="{{ route('resources.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="article">
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="subtitle" class="form-label">Subtitle</label>
                                <input type="text" class="form-control" id="subtitle" name="subtitle">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control" id="author" name="author">
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="img_cover" class="form-label">Cover Image</label>
                                <input type="file" class="form-control" id="img_cover" name="img_cover">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-lg-12">
                                <label for="paragraph1" class="form-label">Paragraph 1</label>
                                <textarea class="form-control" id="paragraph1" name="paragraph1"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="paragraph1_img" class="form-label">Paragraph 1 Image</label>
                                <input type="file" class="form-control" id="paragraph1_img"
                                    name="paragraph1_img">
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="paragraph2_img" class="form-label">Paragraph 2 Image</label>
                                <input type="file" class="form-control" id="paragraph2_img"
                                    name="paragraph2_img">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-lg-12">
                                <label for="paragraph2" class="form-label">Paragraph 2</label>
                                <textarea class="form-control" id="paragraph2" name="paragraph2"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Insert</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Insert Modal -->
    <!-- Modal for inserting exercise -->
    <div class="modal fade" id="modalInsertExercise" tabindex="-1" aria-labelledby="modalInsertExerciseLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('resources.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalInsertExerciseLabel">Add New Exercise</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Exercise Form Fields -->
                        <input type="hidden" name="type" value="exercise">
                        <div class="mb-3">
                            <label for="img_cover" class="form-label">Cover Image</label>
                            <input type="file" class="form-control" id="img_cover" name="img_cover">
                        </div>
                        <div class="mb-3">
                            <label for="exercise_type" class="form-label">Exercise Type</label>
                            <input type="text" class="form-control" id="exercise_type" name="exercise_type"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="exercise_muscle" class="form-label">Muscle Targeted</label>
                            <input type="text" class="form-control" id="exercise_muscle" name="exercise_muscle">
                        </div>
                        <div class="mb-3">
                            <label for="exercise_equipment" class="form-label">Equipment Needed</label>
                            <input type="text" class="form-control" id="exercise_equipment"
                                name="exercise_equipment">
                        </div>
                        <div class="mb-3">
                            <label for="exercise_difficulty" class="form-label">Difficulty Level</label>
                            <input type="text" class="form-control" id="exercise_difficulty"
                                name="exercise_difficulty">
                        </div>
                        <div class="mb-3">
                            <label for="exercise_description" class="form-label">Exercise
                                Description</label>
                            <textarea class="form-control" id="exercise_description" name="exercise_description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Exercise</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    @foreach ($articles as $article)
        <div class="modal fade" id="modalEditArticle{{ $article->resource_id }}" tabindex="-1"
            aria-labelledby="modalEditArticleLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditArticleLabel">Edit Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('resources.update', ['id' => $article->resource_id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <!-- Form fields for editing article -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $article->title }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="subtitle" class="form-label">Subtitle</label>
                                <input type="text" class="form-control" id="subtitle" name="subtitle"
                                    value="{{ $article->subtitle }}">
                            </div>
                            <div class="mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control" id="author" name="author"
                                    value="{{ $article->author }}">
                            </div>
                            <div class="mb-3">
                                <label for="img_cover" class="form-label">Image Cover</label>
                                <input type="file" class="form-control" id="img_cover" name="img_cover">
                            </div>
                            <div class="mb-3">
                                <label for="paragraph1" class="form-label">Paragraph 1</label>
                                <textarea class="form-control" id="paragraph1" name="paragraph1" rows="3">{{ $article->paragraph1 }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="paragraph1_img" class="form-label">Image for Paragraph
                                    1</label>
                                <input type="file" class="form-control" id="paragraph1_img"
                                    name="paragraph1_img">
                            </div>
                            <div class="mb-3">
                                <label for="paragraph2" class="form-label">Paragraph 2</label>
                                <textarea class="form-control" id="paragraph2" name="paragraph2" rows="3">{{ $article->paragraph2 }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="paragraph2_img" class="form-label">Image for Paragraph
                                    2</label>
                                <input type="file" class="form-control" id="paragraph2_img"
                                    name="paragraph2_img">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <!-- End Update Modal -->
    @foreach ($exercises as $exercise)
        <div class="modal" tabindex="-1" id="modalEditExercise{{ $exercise->resource_id }}">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Exercise</h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editExerciseForm{{ $exercise->resource_id }}" method="POST"
                            action="{{ route('resources.update', $exercise->resource_id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="type" value="exercise">
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="exercise_type" class="form-label">Type</label>
                                    <input type="text" class="form-control" id="exercise_type"
                                        name="exercise_type" value="{{ $exercise->exercise_type }}" required>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="exercise_muscle" class="form-label">Muscle</label>
                                    <input type="text" class="form-control" id="exercise_muscle"
                                        name="exercise_muscle" value="{{ $exercise->exercise_muscle }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="exercise_equipment" class="form-label">Equipment</label>
                                    <input type="text" class="form-control" id="exercise_equipment"
                                        name="exercise_equipment" value="{{ $exercise->exercise_equipment }}"
                                        required>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="exercise_difficulty" class="form-label">Difficulty</label>
                                    <input type="text" class="form-control" id="exercise_difficulty"
                                        name="exercise_difficulty" value="{{ $exercise->exercise_difficulty }}"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-12">
                                    <label for="exercise_description" class="form-label">Description</label>
                                    <textarea class="form-control" id="exercise_description" name="exercise_description" required>{{ $exercise->exercise_description }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="img_cover" class="form-label">Cover Image</label>
                                    <input type="file" class="form-control" id="img_cover" name="img_cover">
                                    <input type="hidden" name="current_img_cover"
                                        value="{{ $exercise->img_cover }}">
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
    <!-- Delete Modal -->
    <!-- Delete Exercise Modal -->
    @foreach ($exercises as $exercise)
        <div class="modal fade" id="modalDeleteExerciseConfirmation{{ $exercise->resource_id }}" tabindex="-1"
            aria-labelledby="modalDeleteExerciseConfirmationLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDeleteExerciseConfirmationLabel">Confirm Delete
                            Exercise</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this exercise?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('resources.destroy', ['id' => $exercise->resource_id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Delete Article Modal -->
    @foreach ($articles as $article)
        <div class="modal fade" id="modalDeleteArticleConfirmation{{ $article->resource_id }}" tabindex="-1"
            aria-labelledby="modalDeleteArticleConfirmationLabel{{ $article->resource_id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDeleteArticleConfirmationLabel{{ $article->resource_id }}">
                            Confirm
                            Delete Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this article?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('resources.destroy', ['id' => $article->resource_id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- End Delete Modal -->


    <!-- main_content ends -->
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var detailButtons = document.querySelectorAll('.view-detail');
        detailButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var resourceId = this.getAttribute('data-id');
                // Fetch and display resource details using AJAX
            });
        });
    });
</script>

@stop
