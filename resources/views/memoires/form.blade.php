@extends('layout.theme')
@section('title', $memoire->exists ? 'Editer un mémoire / thèse ' : 'Ajouter un mémoire / thèse')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book"></i>
            </span>
            @if ($memoire->exists)
                Editer un Mémoire / Thèse
            @else
                Ajouter un Mémoire / Thèse
            @endif
        </h3>
    </div>
    @include('shared.flash')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample"
                        action="{{ route($memoire->exists ? 'memoire_these.update' : 'memoire_these.store', ['memoire' => $memoire->id]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf @method($memoire->exists ? 'PUT' : 'POST')
                        <div class="form-group">
                            <label for="cote">Cote</label>
                            <input autofocus type="text" name="cote" class="form-control" id="cote"
                                placeholder="Cote" value="{{ $memoire->cote }}">
                        </div>

                        <div class="form-group">
                            <label for="theme">Thème</label>
                            <input type="text" name="theme" class="form-control" id="theme" placeholder="Thème"
                                value="{{ $memoire->theme }}">
                        </div>

                        <div class="form-group">
                            <label for="auteur">Auteur</label>
                            <input type="text" name="auteur" class="form-control" id="auteur" placeholder="Auteur"
                                value="{{ $memoire->auteur }}">
                        </div>

                        <div class="form-group">
                            <label for="annee">Année</label>
                            <input type="text" name="annee" class="form-control" id="annee" placeholder="Année"
                                value="{{ $memoire->annee }}">
                        </div>

                        <div class="form-group">
                            <label for="entite_id">Entité</label>
                            <select name="entite_id" class="form-control" id="entite">
                                <!-- Afficher les options disponibles dans la base de données -->
                                @foreach ($entites as $entite)
                                    <option value="{{ $entite->id }}">{{ $entite->intitule }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="option_id">Option</label>
                            <select name="option_id" class="form-control" id="option">
                                <!-- Afficher les options disponibles dans la base de données -->
                                @foreach ($options as $option)
                                    <option value="{{ $option->id }}">{{ $option->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Format PDF</label>
                            <input type="file" name="pdf" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Charger Fichier">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload
                                        File</button>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exemplaire">Exemplaire (Papier)</label>
                            <input type="number" name="exemplaire" class="form-control" id="exemplaire"
                                placeholder="Exemplaire" value="{{ $memoire->exemplaire }}">
                        </div>
                        @if ($memoire->exists)
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
        $('#entite').change(function() {
            var entiteId = $(this).val();
            var optionSelect = $('#option');

            // Supprimer toutes les options existantes
            optionSelect.empty();

            // Envoyer une requête AJAX pour récupérer les options associées à l'entité sélectionnée
            if (entiteId !== '') {
                $.get('{{ url('get_options') }}/' + entiteId, function(options) {
                    // Ajouter les options récupérées au select d'options
                    $.each(options, function(index, option) {
                        optionSelect.append($('<option></option>').val(option.id).text(option
                            .intitule));
                    });
                });
            }
        });
    </script>
@endsection
