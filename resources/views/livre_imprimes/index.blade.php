@extends('layout.theme')
@section('title', 'Livres Imprimés')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book-open-page-variant"></i>
            </span>
            Livres Imprimés
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @if ($user->exists)
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
                    <h4 class="card-title">Livres Disponibles</h4>
                    <p class="card-description">
                        Vous pouvez <code> Filtrer </code> les <code> Livres Imprimés</code>.
                    </p>
                    <form action="" method="get" class="forms sample d-flex gap-2">
                        <input type="text" placeholder="Cote" class="form-control" name="cote"
                            value="{{ $input['cote'] ?? '' }}">
                        <input type="number" placeholder="Classe" class="form-control" name="classe"
                            value="{{ $input['classe'] ?? '' }}">
                        <input type="text" placeholder="Auteur" class="form-control" name="auteur"
                            value="{{ $input['auteur'] ?? '' }}">
                        <input type="text" placeholder="Titre" class="form-control" name="titre"
                            value="{{ $input['titre'] ?? '' }}">
                        <button type="submit" class="btn btn-gradient-primary btn-sm flex-grow-0">
                            Rechercher
                        </button>
                    </form>

                    <div class="row mt-5">
                        @forelse ($livre_imprimes as $livre_imprime)
                            <div class="col-md-4 stretch-card grid-margin">
                                <a href="{{ route('livre_imprimes.show', ['id' => $livre_imprime->id]) }}"
                                    class="card bg-gradient-primary card-img-holder text-white">
                                    <div class="card-body">
                                        <img src="{{ asset('assets/images/dashboard/circle.svg') }}"
                                            class="card-img-absolute" alt="circle-image" />
                                        <h4 class="font-weight-normal mb-3">
                                            {{ $livre_imprime->emplacement }}
                                            <i class="mdi mdi-diamond mdi-24px float-right"></i>
                                        </h4>
                                        <p class="card-text">
                                            {{ $livre_imprime->division_name }},
                                            {{ $livre_imprime->cote }}
                                        </p>
                                        <p style="text-align: left" class="card-text">{{ $livre_imprime->titre }}</p>

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

                    {{-- <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Cote</th>
                                <th>Titre</th>
                                <th>Auteur</th>
                                <th>Exemplaire</th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($livre_imprimes as $livre_imprime)
                                <tr>
                                    <td>{{ $livre_imprime->cote }}</td>
                                    <td>{{ $livre_imprime->titre }}</td>
                                    <td class="">{{ $livre_imprime->auteur }}</td>
                                    <td>
                                        <label class="badge badge-danger">{{ $livre_imprime->nombre_exemplaires }}</label>
                                    </td>
                                    @if ($user->exists)
                                        <td>
                                            <div class="row">
                                                <a href="{{ route('livre_imprime.show', $livre_imprime->id) }}"
                                                    title="Détails" class="offset-1  mdi mdi-eye">
                                                </a>
                                                <a href="{{ route('livre_imprime.edit', $livre_imprime->id) }}"
                                                    title="Modifier" class="offset-1  mdi mdi-border-color">
                                                </a>
                                                <form action="{{ route('livre_imprime.destroy', $livre_imprime->id) }}"
                                                    method="post" class="offset-1 align-self-center">
                                                    @csrf
                                                    @method('delete')
                                                    <button style="color:red;" class="btn btn-link p-0" title="Supprimer">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{ route('livre_imprimes.show', $livre_imprime->id) }}"
                                                title="Détails" class="offset-2  mdi mdi-eye">
                                            </a>

                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}
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
