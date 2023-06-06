<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }} ">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }} ">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }} " />

    <!-- inject select2 css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/css/select2.min.css') }}">
    <!-- inject:css -->

    <title>Title | @yield('title')</title>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="#">
                    <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="#">
                    <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0"
                                placeholder="Search projects" />
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    @if ($user->exists)
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#"
                                data-toggle="dropdown" aria-expanded="false">
                                <div class="nav-profile-img">
                                    <img src="{{ asset('assets/images/faces-clipart/pic-1.png') }}" alt="image" />
                                    <span class="availability-status online"></span>
                                </div>
                                <div class="nav-profile-text">
                                    <p class="mb-1 text-black">
                                        {{ $user->name }}
                                    </p>
                                </div>
                            </a>

                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="mdi mdi-logout mr-2 text-primary"></i>
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endif

                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                            data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="count-symbol bg-warning"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="messageDropdown">
                            <h6 class="p-3 mb-0">Messages</h6>
                            <div class="preview-thumbnail">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <img src="{{ asset('assets/images/faces/face4.jpg') }}" alt="image"
                                        class="profile-pic" />
                            </div>
                            <div
                                class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject ellipsis mb-1 font-weight-normal">
                                    Mark send you a message
                                </h6>
                                <p class="text-gray mb-0">1 Minutes ago</p>
                            </div>
                            </a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                            data-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="count-symbol bg-danger"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <h6 class="p-3 mb-0">Notifications</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-calendar"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">
                                        Event today
                                    </h6>
                                    <p class="text-gray ellipsis mb-0">
                                        Just a reminder that you have an event today
                                    </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                </ul>
                @if (!$user->exists)
                    <button id="open-modal-btn" class="nav-item" style="border: none; background:none"
                        title="Se connecter">
                        <span class="mdi mdi-login"></span>
                    </button>
                @endif
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        @if ($user->exists)
                            <a href="#" class="nav-link">
                                <div class="nav-profile-image">
                                    <img src="{{ asset('assets/images/faces-clipart/pic-1.png') }}" alt="profile" />
                                    <span class="login-status online"></span>
                                    <!--change to offline or busy as needed-->
                                </div>
                                <div class="nav-profile-text d-flex flex-column">
                                    <span class="font-weight-bold mb-2">
                                        @if ($user->name)
                                            {{ $user->name }}
                                        @endif
                                    </span>
                                    <span class="text-secondary text-small">
                                        @if ($user->role)
                                            {{ Str::ucfirst($user->role) }}
                                        @endif
                                    </span>
                                </div>
                                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <span class="menu-title">Accueil</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('suggestion') }}">
                            <span class="menu-title">Suggestion</span>
                            <i class="mdi mdi-format-wrap-tight  menu-icon"></i>
                        </a>
                    </li>

                    @if ($user->exists)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.index') }}">
                                <span class="menu-title">Agents</span>
                                <i class="mdi mdi-account-multiple-plus menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('abonne.index') }}">
                                <span class="menu-title">Abonnés</span>
                                <i class="mdi mdi-account-convert menu-icon"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('memoire.index') }}">
                                <span class="menu-title">Mémoires-Thèses</span>
                                <i class="mdi mdi-book-open-variant menu-icon"></i>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('memoires.index') }}">
                                <span class="menu-title">Mémoires-Thèses</span>
                                <i class="mdi mdi-book-open-variant menu-icon"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <span class="d-flex align-items-center purchase-popup">
                                <p>
                                    Bienvenue au Centre d'Information et de Documentation (CID)
                                </p>
                                <a href="#" class="btn ml-auto download-button">
                                    Bibliothèque Centrale
                                </a>
                                <a href="#" class="btn purchase-button">
                                    Université de Parakou
                                </a>
                                <i class="mdi mdi-close popup-dismiss"></i>
                            </span>
                        </div>
                    </div>

                    @yield('content')

                </div>
                <!-- content-wrapper ends -->

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- partial -->

    <!-- The modal -->
    <!-- Modal content -->



    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.addons.js') }}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }} "></script>
    <script src="{{ asset('assets/js/misc.js') }} "></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/js/dashboard.js') }} "></script>
    <!-- End custom js for this page-->

    <!-- inject:js:jquery -->
    <script src="{{ asset('assets/vendors/jquery/jquery-3.5.1.min.js') }}"></script>

    <!-- inject:js:select2 -->
    <script src="{{ asset('assets/vendors/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('assets/js/file-upload.js') }}"></script>

    @yield('script')

</body>

</html>
