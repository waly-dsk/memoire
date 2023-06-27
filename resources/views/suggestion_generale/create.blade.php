@extends('layout.theme')
@section('title', 'Suggestion Générale')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book"></i>
            </span>
            Suggestion Générale
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('suggestion_generale.index') }}">Suggestions Générales</a></li>
                <li class="breadcrumb-item active" aria-current="page">Suggestions</li>
            </ol>
        </nav>
    </div>
    <div id="flash">
        @include('shared.flash')
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('suggestion_generale.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="type_suggestion_id">Type </label>
                            <select name="type_suggestion_id" id="type_suggestion_id" class="form-control">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contenu">Contenu</label>
                            <input type="text" name="contenu" class="form-control" id="contenu" placeholder="Contenu">
                        </div>

                        <button type="submit" class="btn btn-gradient-primary mr-2">Envoyer</button>
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
        $(function() {
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
            console.log('mfm')
        })
    </script>
@endsection
