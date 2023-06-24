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
                @if ($user && $user->exists)
                    <li class="breadcrumb-item"><a href="{{ route('livre_imprime.create') }}">Ajouter un Livre Imprimé</a>
                    </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">Livres Imprimés</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">La classification Dewey</h4>
                    <p class="card-description">
                        Le <code>CID-UP</code> utilise la <code>Classification Décimale de Dewey</code>
                    </p>
                    <p>
                        La Classification Décimale de Dewey (CDD) est le système qui est appliqué afin de permettre à notre
                        bibliothèque de classer par sujet l’ensemble de la collection de livres. Ce système de
                        classification répartit les livres dans dix classes. Chaque classe est elle-même divisée en dix
                        divisions.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @forelse ($categories as $category)
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <h4 class="card-title">{{ $category->intitule . ' (' . $category->classe . ') ' }}</h4>
                    <div class="card-body">
                        <p></p>
                        <ul class="list-ticked">
                            @php
                                $divisionIds = explode(' | ', rtrim($category->division_ids, ' | '));
                                $divisionClasses = explode(' | ', rtrim($category->division_classes, ' | '));
                                $divisions = explode(' | ', rtrim($category->divisions, ' | '));
                            @endphp
                            @foreach ($divisionIds as $key => $divisionId)
                                <li><a href="{{ route('livre_imprime.index', ['division_id' => $divisionId]) }}">{{ $divisionClasses[$key] }}
                                        -
                                        {{ $divisions[$key] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
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
