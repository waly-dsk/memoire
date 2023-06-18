@extends('layout.theme')
@section('title', $pret->exists ? 'Editer un Prêt ' : 'Ajouter un Prêt')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book"></i>
            </span>
            @if ($pret->exists)
                Editer un Prêt
            @else
                Ajouter un Prêt
            @endif
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pret.index') }}">Prêts en cours</a></li>
                <li class="breadcrumb-item active" aria-current="page">Prêts à Domicile</li>
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
                        action="{{ route($pret->exists ? 'pret.update' : 'pret.store', ['pret' => $pret->id]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf @method($pret->exists ? 'PUT' : 'POST')

                        @if ($pret->exists)
                            <div class="form-group">
                                <label for="abonne">Agent</label>
                                <input disabled type="text" name="agent_id" class="form-control"
                                    value="{{ $informations_pret->name }}">
                            </div>
                        @endif


                        <div class="form-group">
                            <label for="abonne">Abonné</label>
                            @if ($pret->exists)
                                <input disabled type="text" name="abonne_id" class="form-control"
                                    value="{{ $informations_pret->nom }}">
                            @else
                                <select name="abonne_id" class="form-control" multiple id="abonne">
                                    @foreach ($abonnes as $abonne)
                                        <option value="{{ $abonne->id }}">{{ $abonne->nom }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="livre">Livres disponibles</label>
                            <select name="livre_imprime_exemplaire_id[]" id="livre_imprime_exemplaire_id"
                                class="form-control" multiple="multiple">
                                @foreach ($livre_imprimes as $livre_imprime)
                                    <option value="{{ $livre_imprime->id }}">{{ $livre_imprime->titre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="date_debut">Date de Début</label>
                            <input type="date" name="date_debut" class="form-control" id="date_debut"
                                placeholder="Date de Début" value="{{ $pret->date_debut }}">
                        </div>

                        <div class="form-group">
                            <label for="date_fin_prevue">Date de Fin Prévue</label>
                            <input type="date" name="date_fin_prevue" class="form-control" id="date_fin_prevue"
                                placeholder="Date de FIn prévue" value="{{ $pret->date_fin_prevue }}">
                        </div>

                        @if ($pret->exists)
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
        $(function() {
            $('#abonne').select2({
                placeholder: "Sélectionnez un abonné",
                maximumSelectionLength: 1,
            });
            $('#livre_imprime_exemplaire_id').select2({
                placeholder: "Sélectionnez au moins un livre",
                maximumSelectionLength: 2,
            });
        })
    </script>
@endsection
