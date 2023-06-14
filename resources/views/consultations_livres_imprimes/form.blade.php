@extends('layout.theme')
@section('title', $consultation->exists ? 'Editer une consultation ' : 'Ajouter une consultation')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book"></i>
            </span>
            @if ($consultation->exists)
                Editer une consultation
            @else
                Ajouter une consultation
            @endif
        </h3>
    </div>
    @include('shared.flash')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Livres Imprimés</h4>
                    <p class="card-description">
                        Consultation de <code>Livres Imprimés</code>
                    </p>
                    <form class="forms-sample"
                        action="{{ route($consultation->exists ? 'consultation_livre_imprime.store' : 'consultation_livre_imprime.store', ['consultation' => $consultation->id]) }}"
                        method="post">
                        @csrf @method($consultation->exists ? 'PUT' : 'POST')

                        <div class="form-group">
                            <label for="livre_imprime_id">Livres Imprimés</label>
                            <select class="form-control" name="livre_imprime_id[]" id="livre" multiple>
                                @foreach ($livre_imprimes as $livre_imprime)
                                    <option value="{{ $livre_imprime->id }}">{{ $livre_imprime->cote }}</option>
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-gradient-primary mr-2">
                            @if ($consultation->exists)
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
        $(function() {
            $('#livre').select2({
                placeholder: "Sélectionnez un livre",
            })
        });
    </script>
@endsection
