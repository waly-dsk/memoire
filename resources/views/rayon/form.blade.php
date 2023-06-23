@extends('layout.theme')
@section('title', $rayon->exists ? 'Editer un rayon ' : 'Ajouter un rayon')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book"></i>
            </span>
            @if ($rayon->exists)
                Editer un Rayon
            @else
                Ajouter un Rayon
            @endif
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('rayon.index') }}">Tous les Rayons</a></li>
                <li class="breadcrumb-item active" aria-current="page">Rayons</li>
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
                        action="{{ route($rayon->exists ? 'rayon.update' : 'rayon.store', ['rayon' => $rayon->id]) }}"
                        method="post">
                        @csrf @method($rayon->exists ? 'PUT' : 'POST')

                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom"
                                value="{{ $rayon->nom }}">
                        </div>

                        <div class="form-group">
                            <label for="nombre_de_loges">Nombre de Loges</label>
                            <input type="text" name="nombre_de_loges" class="form-control" id="nombre_de_loges"
                                placeholder="Nombre de Loges" value="{{ $rayon->nombre_de_loges }}">
                        </div>

                        <button type="submit" class="btn btn-gradient-primary mr-2">
                            @if ($rayon->exists)
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
            $('#nombre_de_loges').on('input', function() {
                let value = $(this).val();
                if (/\D/g.test(value)) {
                    value = value.substr(0, value.length - 1);
                    $(this).val(value);
                    $(this).css('border-color', 'red');
                } else {
                    $(this).css('border-color', '');
                }
            });
        });
    </script>
@endsection
