@extends('layout.theme')
@section('title', $livre_imprime->exists ? 'Editer un livre' : 'Ajouter un livre')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book"></i>
            </span>
            @if ($livre_imprime->exists)
                Editer un Livre Imprimé
            @else
                Ajouter un Livre Imprimé
            @endif
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Tous les Livres </a></li>
                <li class="breadcrumb-item active" aria-current="page">Livres Imprimés</li>
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
                    <form class="forms-sample"
                        action="{{ route($livre_imprime->exists ? 'livre_imprime.update' : 'livre_imprime.store', ['livre_imprime' => $livre_imprime->id]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf @method($livre_imprime->exists ? 'PUT' : 'POST')

                        <div class="form-group">
                            <label for="rayon">Le rayon</label>
                            <select name="rayon_id" id="rayon" class="form-control">
                                @foreach ($rayons as $rayon)
                                    @if ($livre_imprime->exists)
                                        <option value="{{ $rayon->id }}"
                                            {{ $livre_imprime->loge->rayon_id == $rayon->id ? 'selected' : '' }}>
                                            {{ $rayon->nom }}
                                        </option>
                                    @else
                                        <option value="{{ $rayon->id }}">
                                            {{ $rayon->nom }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="loge">La loge</label>
                            <select name="loge_id" id="loge" class="form-control">
                                @foreach ($loges as $loge)
                                    @if ($livre_imprime->exists)
                                        <option value="{{ $loge->id }}"
                                            {{ $livre_imprime->loge_id == $loge->id ? 'selected' : '' }}>
                                            {{ $loge->nom }}
                                        </option>
                                    @else
                                        <option value="{{ $loge->id }}">
                                            {{ $loge->nom }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cote">Cote</label>
                            <input type="text" name="cote" class="form-control" id="cote" placeholder="Cote"
                                value="{{ $livre_imprime->cote }}">
                        </div>

                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" name="titre" class="form-control" id="titre" placeholder="Titre"
                                value="{{ $livre_imprime->titre }}">
                        </div>

                        <div class="form-group">
                            <label for="auteur">Auteur</label>
                            <input type="text" name="auteur" class="form-control" id="auteur" placeholder="Auteur"
                                value="{{ $livre_imprime->auteur }}">
                        </div>

                        <div class="form-group">
                            <label for="category_id">Catégorie</label>
                            <select name="category_id" class="form-control" id="category">
                                <!-- Afficher les options disponibles dans la base de données -->
                                @foreach ($categories as $category)
                                    @if ($livre_imprime->exists)
                                        <option value="{{ $category->id }}"
                                            {{ $livre_imprime->division->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->intitule }}
                                        </option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->intitule }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="division_id">Division</label>
                            <select name="division_id" class="form-control" id="division">
                                <!-- Afficher les options disponibles dans la base de données -->
                                @foreach ($divisions as $division)
                                    @if ($livre_imprime->exists)
                                        <option value="{{ $division->id }}"
                                            {{ $livre_imprime->division_id == $division->id ? 'selected' : ' ' }}>
                                            {{ $division->intitule }}
                                        </option>
                                    @else
                                        <option value="{{ $division->id }}">{{ $division->intitule }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exemplaire">Exemplaire</label>
                            <input type="text" name="exemplaire" class="form-control" id="exemplaire"
                                placeholder="Exemplaire" value="{{ $livre_imprime->exemplaire }}">
                        </div>
                        @if ($livre_imprime->exists)
                            <button type="submit" class="btn btn-gradient-primary">Modifier</button>
                        @else
                            <button type="submit" class="btn btn-gradient-primary">Créer</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#exemplaire").on("input", function() {
            let value = $(this).val();
            if (/\D/g.test(value)) {
                value = value.substr(0, value.length - 1);
                $(this).val(value);
            }
        });

        $('#category').change(function() {
            var categoryId = $(this).val();
            var divisionSelect = $('#division');

            // Supprimer toutes les divisions existantes
            divisionSelect.empty();

            // Envoyer une requête AJAX pour récupérer les divisions associées à l'entité sélectionnée
            if (categoryId !== '') {
                $.get('{{ url('get_divisions') }}/' + categoryId, function(divisions) {
                    // Ajouter les divisions récupérées au select d'divisions
                    $.each(divisions, function(index, division) {
                        divisionSelect.append($('<option></option>').val(division.id).text(division
                            .intitule));
                    });
                });
            }
        });

        $('#rayon').change(function() {
            var rayonId = $(this).val();
            var logeSelect = $('#loge');

            // Supprimer toutes les loges existantes
            logeSelect.empty();

            // Envoyer une requête AJAX pour récupérer les loges associées à l'entité sélectionnée
            if (rayonId !== '') {
                $.get('{{ url('get_loges') }}/' + rayonId, function(loges) {
                    // Ajouter les loges récupérées au select d'loges
                    $.each(loges, function(index, loge) {
                        logeSelect.append($('<option></option>').val(loge.id).text(loge
                            .nom));
                    });
                });
            }
        });
    </script>
@endsection
