@extends('layout.theme')
@section('title', $document->type_document)
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-bullseye"></i>
            </span>
            {{ $document->type_document }}
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{ route('memoires_theses.type_index', ['type' => $document->type_id]) }}">
                        @yield('title') </a></li>
                <li class="breadcrumb-item active" aria-current="page">Informations</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 card-group">
            <div class="card">
                <img src="{{ asset('assets/arriere/6920933.jpg') }}" alt="image">
            </div>
            <div class="card grid-margin stretch-card">
                <div class="card-body">
                    <p class="card-description">
                        Emplacement : <span class="text-info font-weight-bold">{{ $document->emplacement }}</span>
                    </p>
                    <p class="card-description">
                        Entité : <span class="text-info">{{ $document->entite }}</span>
                        Option : <span class="text-info">{{ $document->option }}</span>
                    </p>
                    <p class="font-weight-bold">{{ $document->theme }}</p>
                </div>
            </div>

            <div class="card grid-margin stretch-card">
                <div class="card-body">
                    <p class="card-description">Année :
                        {{ $document->annee }}
                    </p>
                    <p class="card-description">Encadreur :
                        <span class="text-info font-weight-bold">
                            {{ $document->encadreur }}
                        </span>
                    </p>
                    <p class="card-description">Auteur :
                        <span class="text-info font-weight-bold">
                            {{ $document->auteur }}
                        </span>
                    </p>

                    @if ($document->pdf)
                        <a class="" href="{{ Storage::url($document->pdf) }}">
                            Télécharger le PDF
                        </a>
                    @endif
                    @if ($user && $user->exists)
                        <div class="row mt-2">
                            <a href="{{ route('memoire_these.edit', $document->id) }}" style="color: blue" class="btn"
                                title="Modifier">
                                <i class="mdi mdi-marker"></i>
                            </a>
                            <form action="{{ route('memoire_these.destroy', $document->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn" style="color: red" title="Supprimer">
                                    <i class="mdi mdi-delete-forever"></i>
                                </button>
                            </form>
                        </div>
                    @endif
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
                                <div class="auth-form-light text-left">
                                    <div class="brand-logo text-center mb-3">
                                        <img src="{{ asset('assets/images/logo2.png') }}">
                                    </div>

                                    <h4 class="mt-3">Bonjour ! Commençons.</h4>
                                    <h6 class="mt-3 font-weight-light">Connectez-vous pour continuer.</h6>
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
                                        <div class="mt-5 my-2 d-flex justify-content-between align-items-center">
                                            <div class="form-check">
                                                <label class="form-check-label text-muted">
                                                </label>
                                            </div>
                                            <a href="#" class="auth-link text-black">Mot de passe oublié ?</a>
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
