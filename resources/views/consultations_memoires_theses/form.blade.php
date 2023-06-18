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
                Ajouter une Consultation
            @endif
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('stats_memoires_theses') }}">Statistiques</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mémoires - Thèses</li>
            </ol>
        </nav>
    </div>
    @include('shared.flash')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Mémoire Thèses</h4>
                    <p class="card-description">
                        Consultation de <code>Mémoires - Thèses</code>
                    </p>
                    <form class="forms-sample"
                        action="{{ route($consultation->exists ? 'consultation_memoire_these.store' : 'consultation_memoire_these.store', ['consultation' => $consultation->id]) }}"
                        method="post">
                        @csrf @method($consultation->exists ? 'PUT' : 'POST')

                        <div class="form-group">
                            <label for="memoire_id">Mémoire</label>
                            <select class="form-control" name="memoire_id[]" id="memoire" multiple>
                                @foreach ($memoires as $memoire)
                                    <option value="{{ $memoire->id }}">{{ $memoire->cote }}</option>
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
            $('#memoire').select2({
                placeholder: "Sélectionnez un mémoire / thèse",
            })
        });
    </script>
@endsection
