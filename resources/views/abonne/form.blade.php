@extends('layout.theme')
@section('title', $abonne->exists ? 'Editer un abonné ' : 'Ajouter un abonné')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book"></i>
            </span>
            @if ($abonne->exists)
                Editer un abonné
            @else
                Ajouter un abonné
            @endif
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('abonne.index') }}">Tous les Abonnés</a></li>
                <li class="breadcrumb-item active" aria-current="page">Abonnés</li>
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
                        action="{{ route($abonne->exists ? 'abonne.update' : 'abonne.store', ['abonne' => $abonne->id]) }}"
                        method="post">
                        @csrf @method($abonne->exists ? 'PUT' : 'POST')


                        <div class="form-group">
                            <label for="type_abonne_id">Type d'abonné</label>
                            <select class="form-control" name="type_abonne_id" id="type_abonne_id">
                                @foreach ($type_abonnes as $type_abonne)
                                    @if ($abonne->exists)
                                        <option value="{{ $type_abonne->id }}"
                                            {{ $abonne->type_abonne_id == $type_abonne->id ? 'selected' : '' }}>
                                            {{ $type_abonne->nom }}
                                        </option>
                                    @else
                                        <option value="{{ $type_abonne->id }}">{{ $type_abonne->nom }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="matricule">Matricule</label>
                            <input type="text" name="matricule" class="form-control" id="matricule"
                                placeholder="Matricule" value="{{ $abonne->matricule }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" name="nom" class="form-control" id="name"
                                placeholder="Nom et Prénom" value="{{ $abonne->nom }}">
                        </div>

                        <div class="form-group">
                            <label for="entite">Entité</label>
                            <select class="form-control" name="entite_id" id="entite">
                                @foreach ($entites as $entite)
                                    @if ($abonne->exists)
                                        <option value="{{ $entite->id }}"
                                            {{ $abonne->entite_id == $entite->id ? 'selected' : '' }}>
                                            {{ $entite->intitule }}
                                        </option>
                                    @else
                                        <option value="{{ $entite->id }}">{{ $entite->intitule }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-gradient-primary mr-2">
                            @if ($abonne->exists)
                                Modifier
                            @else
                                Créer
                            @endif
                        </button>
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
