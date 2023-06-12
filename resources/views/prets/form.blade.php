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
    </div>
    @include('shared.flash')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample"
                        action="{{ route($pret->exists ? 'pret.update' : 'pret.store', ['pret' => $pret->id]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf @method($pret->exists ? 'PUT' : 'POST')

                        <div class="form-group">
                            <label for="abonne">Abonné</label>
                            <select name="abonne_id" class="form-control">
                                @foreach ($abonnes as $abonne)
                                    <option value="{{ $abonne->id }}">{{ $abonne->nom }}</option>
                                @endforeach
                            </select>
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
            $('#livre_imprime_exemplaire_id').select2({
                placeholder: "Sélectionnez un livre",
                maximumSelectionLength: 2,
            });
        })
    </script>
@endsection
