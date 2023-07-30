@extends('layout.theme')
@section('title', "Suggestions d'Ouvrages")
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span>
            Suggestions d'Ouvrages
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('suggestion_ouvrage.create') }}">Ajouter une Suggestion</a></li>
                <li class="breadcrumb-item active" aria-current="page">Suggestions </li>
            </ol>
        </nav>
    </div>
    <div id="flash">
        @include('shared.flash')
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form action="" method="get" class="forms sample d-flex gap-2">
                        <select class="form-control" name="category_id">
                            <option value="">Sélectionnez une catégorie</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ ($input['category_id'] ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->intitule }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" placeholder="Auteur" class="form-control" name="auteur"
                            value="{{ $input['auteur'] ?? '' }}">
                        <input type="text" placeholder="Mots Clés" class="form-control" name="mot_cles"
                            value="{{ $input['mot_cles'] ?? '' }}">

                        <select class="form-control" name="date_ajout">
                            <option value="">Mois d'Ajout Suggestion</option>
                            @foreach ($dates_ajout as $date_ajout)
                                <option value="{{ $date_ajout->mois_annee }}"
                                    {{ str_contains($input['date_ajout'] ?? '', $date_ajout->mois_annee) ? 'selected' : '' }}>
                                    <?php setlocale(LC_TIME, 'fr_FR.UTF-8'); ?>
                                    {{ ucfirst(strftime('%B %Y', strtotime($date_ajout->mois_annee))) }}
                                </option>
                            @endforeach
                        </select>

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
                                    <th>Catégorie</th>
                                    <th>Auteur</th>
                                    <th>Titre</th>
                                    <th>Édition</th>
                                    <th>Année Parution</th>
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
                                            {{ $suggestion->auteur }}
                                        </td>
                                        <td>
                                            {{ $suggestion->titre }}
                                        </td>
                                        <td>
                                            {{ $suggestion->edition }}

                                        </td>
                                        <td>
                                            {{ $suggestion->annee_parution }}

                                        </td>
                                        @if ($user->exists)
                                            <td>
                                                <div class="row">
                                                    <a href="" title="Répondre"
                                                        class="offset-1 mdi mdi-message-reply">
                                                    </a>
                                                    <form
                                                        action="{{ route('suggestion_ouvrage.destroy', $suggestion->id) }}"
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
                                        <td colspan="6" class="text-center">
                                            Aucune suggestion trouvée !
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
