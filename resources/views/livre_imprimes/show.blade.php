@extends('layout.theme')
@section('title', 'Détails')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book"></i>
            </span>
            {{ $livre_imprime->titre }}
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Tous les livres</a></li>
                <li class="breadcrumb-item active" aria-current="page">Informations</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Détails du livre</h4>
                    <hr>
                    <p class="card-description mb-2">
                        Cote : <span class="text-info font-weight-bold"> {{ $livre_imprime->cote }}</span>
                    </p>
                    <hr>
                    <p class="card-description mb-2">
                        Auteur : <span class="text-info font-weight-bold"> {{ $livre_imprime->auteur }}</span>
                    </p>
                    <hr>

                    <p class="card-description mb-2">
                        Catégorie : <span class="text-info font-weight-bold">{{ $livre_imprime->categorie_intitule }}</span>
                    </p>
                    <hr>
                    <p class="card-description mb-2">
                        Sous Catégorie : <span
                            class=" text-info font-weight-bold">{{ $livre_imprime->division_intitule }}</span>
                    </p>
                    <hr>
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body h-100">
                    <h4 class="card-title">Autres informations</h4>
                    <hr>
                    <p class="card-description mb-2">
                        Emplacement : <span class="text-info font-weight-bold">{{ $livre_imprime->emplacement }} </span>
                    </p>
                    <hr>
                    <p class="card-description mb-2">
                        Exemplaires Disponibles : <span class="text-info font-weight-bold">
                            {{ $livre_imprime->nombre_exemplaires }}
                        </span>
                    </p>
                    <hr>

                    <p class="card-description mb-2">
                        Date d'Ajout : <span
                            class="text-info font-weight-bold">{{ \Carbon\Carbon::parse($livre_imprime->created_at)->locale('fr_FR')->isoFormat('LL') }}</span>
                    </p>
                    <hr>
                    @if ($user && $user->exists)
                        <div class="row mt-2">
                            <a href="{{ route('livre_imprime.edit', ['livre_imprime' => $livre_imprime->id]) }}"
                                class="ml-3 btn btn-gradient-primary">
                                Modifier
                            </a>
                            <form action="{{ route('livre_imprime.destroy', ['livre_imprime' => $livre_imprime->id]) }}"
                                method="post">
                                @csrf
                                @method('delete')
                                <button class="ml-3 btn btn-gradient-danger">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
