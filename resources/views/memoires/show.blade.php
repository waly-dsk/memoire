@extends('layout.theme')
@section('title', 'Détails Mémoire')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-bullseye"></i>
            </span>
            Voir un (e) Mémoire / Thèse
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"></a></li>
                <li class="breadcrumb-item active" aria-current="page">Informations</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thème</h4>
                    <hr>
                    <p class="card-description mb-2">
                        Entité : <code> {{ $memoire->option->entite->intitule }}</code>
                        Option : <code> {{ $memoire->option->intitule }}</code>
                    </p>
                    <hr>
                    <p>
                        <span class="font-weight-bold">
                            {{ $memoire->theme }}
                        </span>
                    </p>
                    <hr>
                    <div class="form-group">
                        <button class="btn btn-gradient-danger col">
                            Année : {{ $memoire->annee }}
                        </button>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-gradient-success col">
                            COTE : {{ $memoire->cote }}
                        </button>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-gradient-info col">
                            Auteur : {{ $memoire->auteur }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body h-100">
                    <h4 class="card-title">Autres</h4>
                    <hr>
                    <p class="card-description">
                        Informations relatives au <code>.document</code>
                    </p>
                    <hr>
                    <form class="forms-sample mt-2" method="get">

                        <div class="form-group">
                            <label for="genre">Date d'Ajout</label>
                            <input disabled type="text" class="form-control"
                                value=" {{ \Carbon\Carbon::parse($memoire->created_at)->locale('fr_FR')->isoFormat('LL') }}">
                        </div>


                        <div class="form-group">
                            <label for="genre">Date dernière Modification</label>

                            <input disabled type="text" class="form-control"
                                value=" {{ \Carbon\Carbon::parse($memoire->created_at)->locale('fr_FR')->isoFormat('LL') }}">
                        </div>

                        <div class="form-group">
                            <label for="genre">Exemplaire Disponible</label>
                            <input disabled type="text" class="form-control"
                                value=" Version Papier disponible : {{ $memoire->exemplaire }}">
                        </div>
                        @if ($memoire->pdf)
                            <div class="form-group">
                                <a class="btn btn-gradient-primary col" href="{{ Storage::url($memoire->pdf) }}">
                                    Télécharger le PDF
                                </a>
                            </div>
                        @endif
                    </form>
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
