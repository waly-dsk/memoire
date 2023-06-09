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
                <li class="breadcrumb-item"><a href="#"></a></li>
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
                        Cote : <strong> {{ $livre_imprime->cote }}</strong>
                    </p>
                    <hr>
                    <p class="card-description mb-2">
                        Titre du Livre : <span class="font-weight-bold">{{ $livre_imprime->titre }}</span>
                    </p>
                    <hr>
                    <p class="card-description mb-2">
                        Auteur : {{ $livre_imprime->auteur }}
                    </p>
                    <hr>

                    <p class="card-description mb-2">
                        Catégorie : <code>{{ $livre_imprime->categorie_intitule }}</code>
                    </p>
                    <hr>
                    <p class="card-description mb-2">
                        Sous Catégorie : <code>{{ $livre_imprime->division_intitule }}</code>
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
                        Exemplaires Disponibles : <strong>
                            {{ $livre_imprime->nombre_exemplaires }}
                        </strong>
                    </p>
                    <hr>
                    <p class="card-description mb-2">
                        Date dernière Modification : <span
                            class="font-weight-bold">{{ \Carbon\Carbon::parse($livre_imprime->updated_at)->locale('fr_FR')->isoFormat('LL') }}</span>
                    </p>
                    <hr>

                    <p class="card-description mb-2">
                        Date d'Ajout : <span
                            class="font-weight-bold">{{ \Carbon\Carbon::parse($livre_imprime->created_at)->locale('fr_FR')->isoFormat('LL') }}</span>
                    </p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
