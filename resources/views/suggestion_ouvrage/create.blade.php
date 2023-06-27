@extends('layout.theme')
@section('title', 'Suggestion')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book"></i>
            </span>
            Suggestions d'Ouvrages
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('suggestion_ouvrage.index') }}">Suggestions d'Ouvrages</a></li>
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
                    <form class="forms-sample" action="{{ route('suggestion_ouvrage.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="categorie">Catégorie</label>
                            <select name="category_id" id="" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->intitule }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="auteur">Auteur</label>
                            <input type="text" name="auteur" class="form-control" id="auteur" placeholder="Auteur">
                        </div>


                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" name="titre" class="form-control" id="titre" placeholder="Titre">
                        </div>


                        <div class="form-group">
                            <label for="edition">Edition</label>
                            <input type="text" name="edition" class="form-control" id="edition" placeholder="Édition">
                        </div>


                        <div class="form-group">
                            <label for="annee_parution">Année de Parution</label>
                            <input type="text" name="annee_parution" class="form-control" id="annee_parution"
                                placeholder="Anneée de parution">
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
            $("#annee_parution").on("input", function() {
                let value = $(this).val();
                if (/\D/g.test(value) || value.length > 4) {
                    value = value.substr(0, value.length - 1);
                    $(this).val(value);
                }
            });
            @if ($errors->any() || session('error'))
                // Afficher automatiquement la fenêtre modale avec les erreurs
                document.getElementById("login-modal").style.display = "block";
            @endif

            document.getElementById("open-modal-btn").addEventListener("click", function() {
                document.getElementById("login-modal").style.display = "block";
            });

            // Close the modal when the close button is clicked
            document.getElementsByClassName("close")[0].addEventListener("click", function() {
                document.getElementById("login-modal").style.display = "none";
            });
        });
    </script>
@endsection
