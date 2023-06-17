@extends('layout.theme')
@section('title', 'Catégories')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-biohazard"></i>
            </span>
            Catégories
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Catégories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Livres Imprimés</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Classification Dewey</h4>
                    <p class="card-description">
                        Le <code>CID-UP</code> utilise la <code>Classification Décimale de Dewey</code>
                    </p>
                    <p>
                        La classification décimale de Dewey (CDD) est le système qui est appliqué afin de permettre à nos
                        bibliothèques de classer par sujet l’ensemble de la collection de livres. Ce système de
                        classification répartit les livres dans dix classes. Chaque classe est elle-même divisée en dix
                        divisions, chaque division en dix subdivisions et ainsi de suite.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Catégories</h4>
                    <p class="card-description"> Les<code>.catégories</code> d'ouvrage</p>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>CLASSE</th>
                                <th>INTITULE</th>
                                <th>DATE AJOUT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        {{ $category->id }}
                                    </td>
                                    <td>
                                        <a href="{{ route('category.show', $category->id) }}">
                                            {{ $category->classe }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('category.show', $category->id) }}">
                                            {{ $category->intitule }}
                                        </a>
                                    </td>
                                    <td>
                                        <label class="badge badge-danger">
                                            {{ \Carbon\Carbon::parse($category->created_at)->locale('fr_FR')->isoFormat('LL') }}

                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $categories->links() }}

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
