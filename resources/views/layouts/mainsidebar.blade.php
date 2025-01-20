<div class="d-flex flex-column flex-shrink-0 p-3">
    <!-- first a -->
    <div class="d-flex align-items-center justify-content-between mb-3 mb-md-0 me-md-auto w-100">
        <!-- logo for LG screen -->
        <span class="fs-4 logo-lg only-d-lg">
            <a href="{{route('dashboards.index')}}" style="text-decoration: none; color: white; text-weight: bold;">
                <img src="../images/GYMMlogo.png" style="width: 100px; height:100px;" alt="" /><span style="font-family: 'Rubik', sans-serif;">GYMM168</span>
            </a>
        </span>
        <!-- logo for SM screen -->
        <span class="fs-4 logo-sm only-d-sm">
            <img src="../static/img/logo-40x25.png" alt="" />
        </span>

        {{-- <!-- for SM screen - close -->
        <span class="d-none" id="sidebarUntoggleBtn">
            <i class="bi bi-x-circle-fill"></i>
        </span> --}}
    </div>
    <!-- first a ends -->
    <hr />
    <ul class="nav nav-pills flex-column mb-auto">
        <!-- accounts -->
        <p class="mt-2 mb-1 text-secondary text-small">USERS</p>
        <li class="nav-item">
            <a href="/dashboards" class="nav-link active" aria-current="page">
                <i class="fa-solid fa-user me-2"></i>
                Student
            </a>
            <a href="/coaches" class="nav-link">
                <i class="fa-solid fa-user me-2"></i>
                Coach
            </a>
        </li>
        <!-- Fitness Management -->
        <p class="mt-2 mb-1 text-secondary text-small">Fitness Management</p>
        <li>
            <a href="/workoutplans" class="nav-link">
                <i class="fa-solid fa-dumbbell me-2"></i>Workout Plan
            </a>
            <a href="/progresses" class="nav-link">
                <i class="fa-solid fa-bars-progress me-3"></i>Progress
            </a>
            <a href="/resources" class="nav-link">
                <i class="fa-solid fa-database me-3"></i>Resource
            </a>
        </li>
    </ul>
</div>