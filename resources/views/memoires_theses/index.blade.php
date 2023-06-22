@extends('layout.theme')
@section('title', $type_information->intitule)
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-multiple-plus"></i>
            </span>
            @yield('title')
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @if ($user->exists)
                    <li class="breadcrumb-item"><a
                            href="{{ route('memoires_theses.type_create', ['type' => $type_information->id]) }}">Ajouter
                            @yield('title')</a>
                    </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">Mémoires - Thèses</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-description">
                        Vous pouvez <code> Filtrer </code> la <code>Liste</code>.
                    </p>
                    <form action="" method="get" class="forms sample d-flex gap-2">
                        <input type="text" placeholder="Entité" class="form-control" name="entite"
                            value="{{ $input['entite'] ?? '' }}">
                        <input type="text" placeholder="Mots Clés" class="form-control" name="mots_cles"
                            value="{{ $input['mots_cles'] ?? '' }}">
                        <input type="text" placeholder="Encadreur" class="form-control" name="encadreur"
                            value="{{ $input['encadreur'] ?? '' }}">
                        <input type="text" placeholder="Année : XXXX-YYYY" class="form-control" name="annee"
                            value="{{ $input['annee'] ?? '' }}">
                        <button type="submit" class="btn btn-gradient-primary btn-sm flex-grow-0">
                            Rechercher
                        </button>
                    </form>
                    <div class="row mt-5">
                        <!-- Boucle pour afficher les ouvrages -->
                        @forelse ($documents as $document)
                            <div class="col-md-4 stretch-card grid-margin">
                                <a href="{{ route('memoires_theses.show', ['id' => $document->id]) }}"
                                    class="card bg-gradient-primary card-img-holder text-white">
                                    <div class="card-body">
                                        <img src="{{ asset('assets/images/dashboard/circle.svg') }}"
                                            class="card-img-absolute" alt="circle-image" />
                                        <h4 class="font-weight-normal mb-3">
                                            {{ $document->auteur }}
                                            <i class="mdi mdi-diamond mdi-24px float-right"></i>
                                        </h4>
                                        <p class="card-text">
                                            {{ $document->entite }} :
                                            {{ $document->option }} {{ $document->annee }}
                                        </p>
                                        <p style="text-align: left" class="card-text">{{ $document->theme }}</p>

                                        <!-- Autres informations de l'document -->
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col text-center">
                                <a class="btn btn-gradient-primary" href="#">AUCUN RESULTAT NE CORRESPOND
                                    A VOTRE RECHERCHE</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="login-modal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" title="Fermer" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i style="color:red;" class="mr-2 mdi mdi-close-box-outline"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="grid-margin stretch-card">
                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="auth-form-light text-left p-5">
                                    <h4> Bonjour ! Commençons.</h4>
                                    <h6 class="font-weight-light">Connectez-vous pour continuer.</h6>
                                    @include('shared.flash')
                                    <form class="pt-3" action="{{ route('login') }}" method="post">
                                        @csrf @method('post')
                                        <div class="form-group">
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control form-control-lg" placeholder="Adresse E-mail">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-lg"
                                                placeholder="Mot de Passe">
                                        </div>
                                        <div class="mt-3">
                                            <button type="sumit"
                                                class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                                CONNEXION
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // Open the modal when the button is clicked
        $(document).ready(function() {
            @if ($errors->any() || session('error'))
                // Afficher automatiquement la fenêtre modale avec les erreurs
                document.getElementById("login-modal").style.display = "block";
            @endif
        });

        document.getElementById("open-modal-btn").addEventListener("click", function() {
            document.getElementById("login-modal").style.display = "block";
        });

        // Close the modal when the close button is clicked
        document.getElementsByClassName("close")[0].addEventListener("click", function() {
            document.getElementById("login-modal").style.display = "none";
        });
    </script>
@endsection
