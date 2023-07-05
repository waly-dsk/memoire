@extends('layout.theme')
<style>
    .inline {
        display: inline-block;
        margin-right: 10px;
        /* Vous pouvez ajuster la marge selon vos besoins */
    }
</style>
@section('title', $document->exists ? 'Editer ' . $type_information->intitule : 'Ajouter ' .
    $type_information->intitule)
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book"></i>
            </span>
            @yield('title')
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{ route('memoires_theses.type_index', ['type' => $type_information->id]) }}">
                        {{ $type_information->intitule }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mémoires - Thèses</li>
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
                        action="{{ route($document->exists ? 'memoire_these.update' : 'memoire_these.store', ['memoire_these' => $document->id]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf @method($document->exists ? 'PUT' : 'POST')

                        <div class="form-group inline">
                            <label for="type">Type du document</label>
                            <select name="type_document_id" id="" class="form-control">
                                <option value="">Type du document</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ $type_document == $type->id ? 'selected' : '' }}>
                                        {{ $type->intitule }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group inline">
                            <label for="rayon">Le rayon</label>
                            <select name="rayon_id" id="rayon" class="form-control">
                                @foreach ($rayons as $rayon)
                                    @if ($document->exists)
                                        <option value="{{ $rayon->id }}"
                                            {{ $document->loge->rayon_id == $rayon->id ? 'selected' : '' }}>
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

                        <div class="form-group inline">
                            <label for="loge">La loge</label>
                            <select name="loge_id" id="loge" class="form-control">
                                @foreach ($loges as $loge)
                                    @if ($document->exists)
                                        <option value="{{ $loge->id }}"
                                            {{ $document->loge_id == $loge->id ? 'selected' : '' }}>
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

                        <div class="form-group inline">
                            <label for="cote">Cote</label>
                            <input type="text" name="cote" class="form-control" id="cote"
                                placeholder="Cote du document" value="{{ $document->cote }}">
                        </div>

                        <div class="form-group">
                            <label for="theme">Thème</label>
                            <input type="text" name="theme" class="form-control" id="theme" placeholder="Thème"
                                value="{{ $document->theme }}">
                        </div>

                        <div class="form-group inline">
                            <label for="auteur">Auteur</label>
                            <input type="text" name="auteur" class="form-control" id="auteur" placeholder="Auteur"
                                value="{{ $document->auteur }}">
                        </div>

                        <div class="form-group inline">
                            <label for="encadreur">Encadreur</label>
                            <input type="text" name="encadreur" class="form-control" id="encadreur"
                                placeholder="Encadreur" value="{{ $document->encadreur }}">
                        </div>

                        <div class="form-group inline">
                            <label for="annee">Année</label>
                            <input type="text" name="annee" class="form-control" id="annee" placeholder="Année"
                                value="{{ $document->annee }}">
                        </div>

                        <div class="form-group inline">
                            <label for="mention">Mention</label>
                            @if ($document->exists)
                                <select name="mention" id="mention" class="form-control">
                                    <option value="Mention Très Honorable"
                                        {{ $document->mention == 'Mention Très Honorable' ? 'selected' : ' ' }}>Mention
                                        Très Honorable</option>
                                    <option value="Mention Honorable"
                                        {{ $document->mention == 'Mention Honorable' ? 'selected' : ' ' }}>
                                        Mention Honorable</option>
                                    <option value="Mention Bien"
                                        {{ $document->mention == 'Mention Bien' ? 'selected' : ' ' }}>Mention
                                        Bien</option>
                                    <option value="Mention Assez Bien"
                                        {{ $document->mention == 'Mention Assez Bien' ? 'selected' : ' ' }}>
                                        Mention Assez Bien</option>
                                    <option value="Mention Passable"
                                        {{ $document->mention == 'Mention Passable' ? 'selected' : ' ' }}>
                                        Mention Passable</option>
                                </select>
                            @else
                                <select name="mention" id="mention" class="form-control">
                                    <option value="Mention Très Honorable">Mention Très Honorable</option>
                                    <option value="Mention Honorable">Mention Honorable</option>
                                    <option value="Mention Bien">Mention Bien</option>
                                    <option value="Mention Assez Bien">Mention Assez Bien</option>
                                    <option value="Mention Passable">Mention Passable</option>
                                </select>
                            @endif
                        </div>



                        <div class="form-group inline">
                            <label for="entite_id">Entité</label>
                            <select name="entite_id" class="form-control" id="entite">
                                <!-- Afficher les options disponibles dans la base de données -->
                                @foreach ($entites as $entite)
                                    @if ($document->exists)
                                        <option value="{{ $entite->id }}"
                                            {{ $document->option->entite_id == $entite->id ? 'selected' : '' }}>
                                            {{ $entite->intitule }}
                                        </option>
                                    @else
                                        <option value="{{ $entite->id }}">{{ $entite->intitule }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group inline">
                            <label for="option_id">Option</label>
                            <select name="option_id" class="form-control" id="option">
                                <!-- Afficher les options disponibles dans la base de données -->
                                @foreach ($options as $option)
                                    @if ($document->exists)
                                        <option value="{{ $option->id }}"
                                            {{ $document->option_id == $option->id ? 'selected' : '' }}>
                                            {{ $option->intitule }}
                                        </option>
                                    @else
                                        <option value="{{ $option->id }}">{{ $option->intitule }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group inline">
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

                        <div class="form-group inline">
                            <label for="exemplaire">Exemplaire (Papier)</label>
                            <input type="text" name="exemplaire" class="form-control" id="exemplaire"
                                placeholder="Exemplaire" value="{{ $document->exemplaire }}">
                        </div>
                        @if ($document->exists)
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
