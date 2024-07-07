<div id="topNavigation" class="px-3 py-2">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <!-- nav-left, breadcrumb -->
            <a href="index.html#"
                class="nav-left d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                <i class="bi bi-list" id="sidebarToggleBtn"></i>
            </a>

            <div class="d-flex justify-content-end align-items-center">
                <!-- search form -->


                <!-- nav-right -->
                <div class="nav-right col-md-auto col-lg-auto my-2">
                    <!-- nav -->
                    <ul class="nav">
                        

                    

                        <!-- for profile page -->
                        <li>
                            <a href="index.html#" class="nav-link text-white" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{route('profile.edit')}}">
                                        <small>
                                            <i class="bi bi-person-fill me-2"></i>My Profile
                                        </small>
                                    </a>
                                </li>
                                
                                <div class="divider my-1"></div>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="dropdown-item p-0">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            <small>
                                                <i class="bi bi-box-arrow-right me-2"></i>Sign out
                                            </small>
                                        </x-dropdown-link>
                                    </form>
                                </li>
                            </ul>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>