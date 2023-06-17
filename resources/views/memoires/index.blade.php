@extends('layout.theme')
@section('title', 'Mémoires et Thèses')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-multiple-plus"></i>
            </span>
            Mémoires et Thèses
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @if ($user->exists)
                    <li class="breadcrumb-item"><a href="{{ route('memoire_these.create') }}">Ajouter Mémoires-Thèses</a>
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
                    <h4 class="card-title">Mémoires et Thèses</h4>
                    <p class="card-description">
                        Vous pouvez <code> Filtrer </code> la <code>Liste</code>.
                    </p>
                    <form action="" method="get" class="forms sample d-flex gap-2">
                        <input type="text" placeholder="Cote" class="form-control" name="cote"
                            value="{{ $input['cote'] ?? '' }}">
                        <input type="text" placeholder="Entité" class="form-control" name="entite"
                            value="{{ $input['entite'] ?? '' }}">
                        <input type="text" placeholder="Option" class="form-control" name="option"
                            value="{{ $input['option'] ?? '' }}">
                        <input type="text" placeholder="Auteur" class="form-control" name="auteur"
                            value="{{ $input['auteur'] ?? '' }}">
                        <button type="submit" class="btn btn-gradient-primary btn-sm flex-grow-0">
                            Rechercher
                        </button>
                    </form>
                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th>Auteur</th>
                                <th>Entité</th>
                                <th>Option</th>
                                <th>Date Ajout</th>
                                <th class="">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($memoires as $memoire)
                                <tr>
                                    <td>{{ $memoire->auteur }}</td>
                                    {{-- <td>{{ Str::limit($memoire->theme, $limit = 15, '...') }}</td> --}}
                                    <td>
                                        {{ $memoire->entite }}
                                    </td>
                                    <td>
                                        {{ $memoire->option }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($memoire->created_at)->locale('fr_FR')->isoFormat('LL') }}
                                    </td>
                                    <td>
                                        <div class="row">
                                            @if ($user->exists)
                                                <a href="{{ route('memoire_these.show', $memoire->id) }}" title="Détails"
                                                    class="mdi mdi-eye">
                                                </a>
                                                <a href="{{ route('memoire_these.edit', $memoire->id) }}" title="Modifier"
                                                    class="offset-3 mdi mdi-grease-pencil">
                                                </a>
                                                <form action="{{ route('memoire_these.destroy', $memoire->id) }}"
                                                    method="post" class="offset-3 align-self-center">
                                                    @csrf
                                                    @method('delete')
                                                    <button style="color:red;" class="btn btn-link p-0" title="Supprimer">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('memoires.show', $memoire->id) }}" title="Détails"
                                                    class="offset-2">Détails
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $memoires->links() }}
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
