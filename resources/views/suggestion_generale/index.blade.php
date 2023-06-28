@extends('layout.theme')
@section('title', 'Toutes les Suggestions')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span>
            Suggestions Générales
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('suggestion_generale.create') }}">Ajouter une Suggestion</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Suggestions </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form action="" method="get" class="forms sample d-flex gap-2">
                        <select class="form-control" name="type">
                            <option value="">Sélectionnez un type de Suggestion</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}"
                                    {{ ($input['type'] ?? '') == $type->id ? 'selected' : '' }}>
                                    {{ $type->intitule }}
                                </option>
                            @endforeach
                        </select>

                        <select class="form-control" name="date_ajout">
                            <option value="">Sélectionnez un Mois</option>
                            @foreach ($dates_ajout as $date_ajout)
                                <option value="{{ $date_ajout->mois_annee }}"
                                    {{ str_contains($input['date_ajout'] ?? '', $date_ajout->mois_annee) ? 'selected' : '' }}>
                                    <?php setlocale(LC_TIME, 'fr_FR.UTF-8'); ?>
                                    {{ ucfirst(strftime('%B %Y', strtotime($date_ajout->mois_annee))) }}
                                </option>
                            @endforeach
                        </select>

                        <input type="text" placeholder="Mots-Clés" class="form-control" name="mot_cles"
                            value="{{ $input['mot_cles'] ?? '' }}">

                        <button type="submit" class="btn btn-gradient-primary btn-sm flex-grow-0">
                            Rechercher
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Contenu</th>
                                    <th>Date d'Ajout</th>
                                    @if ($user->exists)
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suggestions as $suggestion)
                                    <tr>
                                        <td>
                                            {{ $suggestion->intitule }}
                                        </td>
                                        <td>
                                            {{ $suggestion->contenu }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($suggestion->created_at)->locale('fr_FR')->isoFormat('LL') }}
                                        </td>
                                        @if ($user->exists)
                                            <td>
                                                <div class="row">
                                                    <a href="" title="Répondre"
                                                        class="offset-1 mdi mdi-message-reply">
                                                    </a>
                                                    <form
                                                        action="{{ route('suggestion_generale.destroy', $suggestion->id) }}"
                                                        method="post" class="offset-5 align-self-center">
                                                        @csrf
                                                        @method('delete')
                                                        <button style="color:red;" class="btn btn-link p-0"
                                                            title="Supprimer">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Aucune suggestion trouvée !</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
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
