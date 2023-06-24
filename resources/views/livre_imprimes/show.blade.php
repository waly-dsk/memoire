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
                        Cote : <code class="font-weight-bold"> {{ $livre_imprime->cote }}</code>
                    </p>
                    <hr>
                    <p class="card-description mb-2">
                        Auteur : <code class="font-weight-bold"> {{ $livre_imprime->auteur }}</code>
                    </p>
                    <hr>

                    <p class="card-description mb-2">
                        Catégorie : <code class="font-weight-bold">{{ $livre_imprime->categorie_intitule }}</code>
                    </p>
                    <hr>
                    <p class="card-description mb-2">
                        Sous Catégorie : <code class="font-weight-bold">{{ $livre_imprime->division_intitule }}</code>
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
                        Emplacement : <code class="font-weight-bold">{{ $livre_imprime->emplacement }} </code>
                    </p>
                    <hr>
                    <p class="card-description mb-2">
                        Exemplaires Disponibles : <code class="font-weight-bold">
                            {{ $livre_imprime->nombre_exemplaires }}
                        </code>
                    </p>
                    <hr>

                    <p class="card-description mb-2">
                        Date d'Ajout : <code
                            class="font-weight-bold">{{ \Carbon\Carbon::parse($livre_imprime->created_at)->locale('fr_FR')->isoFormat('LL') }}</code>
                    </p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
