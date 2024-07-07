<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Ashish S. Maharjan" />
    <meta name="robots" content="index, follow" />

    <meta name="description" content="adminAM - Bootstrap 5 Admin Template with Products Demo" />
    <meta name="keywords"
        content="adminAM, Bootstrap 5.3.2, HTML, CSS, SASS, JavaScript, Admin template, Dashboard template" />

    <title>@yield('title')</title>
    <!-- <meta http-equiv="refresh" content="5"/> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS -->

    <link href="../static/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Favicons -->
    <link rel="icon" href="../images/GYMMlogo.png" type="../images/GYMMlogo.png">

    <!-- jvectormap -->
    <link rel="stylesheet" href="../static/css/jquery-jvectormap-2.0.5.css" type="text/css" media="screen" />
</head>

<body>
    <div class="wrapper d-flex h-100">
        <!-- #mainSidebar -->
        <nav id="mainSidebar" class="h-100">
            @include('layouts/mainsidebar')
        </nav>
        <!-- #mainSidebar ends -->

        <!-- #pageContent -->
        <div id="pageContent" class="d-flex flex-column">
            <!-- topnav -->

            @include('layouts/topnavigation')
            <!-- topnav ends -->

            <!-- main content -->
            @yield('content')
            <!-- main content ends -->


            <!-- footer -->
            <!-- divider for footer -->
            <!-- divider for footer ends -->
            <footer class="py-3 mt-auto container-fluid">
                <div class="row">
                    <div class="col text-small">
                        <span class="mb-3 mb-md-0">© GYMM168 | 2024</span>
                    </div>
                    <div class="col text-small text-end">
                        <p>Never back down, Never back what?</p>
                    </div>
                </div>
            </footer>
            <!-- footer ends -->
        </div>
        <!-- #pageContent ends -->
    </div>


    <!-- modal for application ends -->



    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- bootstrap.bundle.min.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- chartjs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jvectormap -->
    <script src="../static/js/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="../static/js/jquery-jvectormap-world-mill-en.js"></script>
    <!-- ploty -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <!-- script.js -->
    <script src="../static/js/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const viewDetailLinks = document.querySelectorAll('.view-detail');

            viewDetailLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const studentId = this.getAttribute('data-id');

                    fetch(`/students/${studentId}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('student-image').src = data.image ||
                                'https://placehold.co/200x200.png';
                            document.getElementById('student-name').innerText = data.name;
                            document.getElementById('student-gender').innerText = data.gender;
                            document.getElementById('student-telephone').innerText = data
                                .telephone;
                            document.getElementById('student-email').innerText = data.email;
                            document.getElementById('student-id').innerText = data.id;

                            // Show the modal
                            var myModal = new bootstrap.Modal(document.getElementById(
                                'modalDetail'));
                            myModal.show();
                        })
                        .catch(error => console.error('Error fetching student data:', error));
                });
            });
        });
    </script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}

</body>

</html>
