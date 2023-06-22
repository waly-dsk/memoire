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
    <style>
        @media (max-width: 768px) {
            .baniere {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="#">
                    <img src="{{ asset('assets/images/logo2.png') }}" alt="logo" />
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
                                <i class="input-group-text border-0  mdi mdi-book-open-page-variant"></i>
                            </div>
                            <input type="text" disabled class="form-control bg-transparent border-0"
                                placeholder="CID-UP / Bibliothèque Centrale" />
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    @if ($user && $user->exists)
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

                </ul>
                @if (!$user || !$user->exists)
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
                        @if ($user && $user->exists)
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
                        <a class="nav-link" href="{{ route('suggestion_generale.index') }}">
                            <span class="menu-title">Suggestion Générale</span>
                            <i class="mdi mdi-format-wrap-tight  menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('suggestion_ouvrage.index') }}">
                            <span class="menu-title">Suggestion Ouvrage</span>
                            <i class="mdi mdi mdi-av-timer  menu-icon"></i>
                        </a>
                    </li>

                    @if ($user && $user->exists)
                        @if ($user->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    <span class="menu-title">Agents</span>
                                    <i class="mdi mdi-account-multiple-plus menu-icon"></i>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('abonne.index') }}">
                                <span class="menu-title">Abonnés</span>
                                <i class="mdi mdi-account-convert menu-icon"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('memoires_theses.type_index', ['type' => '1']) }}">
                                <span class="menu-title">Mémoires Licences</span>
                                <i class="mdi mdi-book-open-variant menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('memoires_theses.type_index', ['type' => '2']) }}">
                                <span class="menu-title">Mémoires Master</span>
                                <i class="mdi  mdi mdi-book-open-page-variant menu-icon"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#theses" aria-expanded="false"
                                aria-controls="theses">
                                <span class="menu-title">Thèses</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi mdi-book-open menu-icon"></i>
                            </a>
                            <div class="collapse" id="theses">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('memoires_theses.type_index', ['type' => '3']) }}">
                                            Thèses Classiques
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('memoires_theses.type_index', ['type' => '4']) }}">
                                            Thèses PHD
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#livres" aria-expanded="false"
                                aria-controls="livres">
                                <span class="menu-title">Livres Imprimés</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-medical-bag menu-icon"></i>
                            </a>
                            <div class="collapse" id="livres">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('category.index') }}">
                                            Catégories de Livres
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('livre_imprime.index') }}">
                                            Tous les Livres
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#consultations" aria-expanded="false"
                                aria-controls="consultations">
                                <span class="menu-title">Consultations</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                            </a>
                            <div class="collapse" id="consultations">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('consultation_memoire_these.create') }}">
                                            Mémoires-Thèses
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('consultation_livre_imprime.create') }}">
                                            Livres Imprimés
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#stats_memoires_theses"
                                aria-expanded="false" aria-controls="stats_memoires_theses">
                                <span class="menu-title">Stats Consultations</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                            </a>
                            <div class="collapse" id="stats_memoires_theses">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('stats_memoires_theses') }}">
                                            Mémoires-Thèses
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('stats_livres_imprimes') }}">
                                            Livres Imprimés
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pret.index') }}">
                                <span class="menu-title">Prêts à domicile</span>
                                <i class="mdi mdi-airplane-takeoff  menu-icon"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('stats_prets') }}">
                                <span class="menu-title">Statistiques Prêts</span>
                                <i class="mdi mdi-chart-areaspline  menu-icon"></i>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('memoires_theses.type_index', ['type' => '1']) }}">
                                <span class="menu-title">Mémoires Licences</span>
                                <i class="mdi mdi-book-open-variant menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('memoires_theses.type_index', ['type' => '2']) }}">
                                <span class="menu-title">Mémoires Master</span>
                                <i class="mdi  mdi mdi-book-open-page-variant menu-icon"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#theses" aria-expanded="false"
                                aria-controls="theses">
                                <span class="menu-title">Thèses</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi mdi-book-open menu-icon"></i>
                            </a>
                            <div class="collapse" id="theses">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('memoires_theses.type_index', ['type' => '3']) }}">
                                            Thèses Classiques
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('memoires_theses.type_index', ['type' => '4']) }}">
                                            Thèses PHD
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#livres" aria-expanded="false"
                                aria-controls="livres">
                                <span class="menu-title">Livres Imprimés</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-medical-bag menu-icon"></i>
                            </a>
                            <div class="collapse" id="livres">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('category.index') }}">
                                            Catégories de Livres
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('livre_imprimes.index') }}">
                                            Tous les Livres
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 baniere">
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
    <script>
        $(document).ready(function() {
            $('a[href="#memoires"]').click(function(e) {
                e.preventDefault(); // Empêche le comportement par défaut du lien
                $('#memoires').collapse('toggle'); // Ouvre ou ferme le menu "Mémoires"
            });
        });
    </script>

    @yield('script')


</body>

</html>
