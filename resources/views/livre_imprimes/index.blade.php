@extends('layout.theme')
@section('title', 'Livres Imprimés')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book-open-page-variant"></i>
            </span>
            {{ $sous_categorie->intitule }}
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @if ($user->exists)
                    <li class="breadcrumb-item"><a href="{{ route('livre_imprime.create') }}">Ajouter un Livre Imprimé</a>
                    </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">Livres Imprimés</li>
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
                    <form action="" method="get" class="forms sample d-flex gap-2">
                        <input type="text" placeholder="Cote" class="form-control" name="cote"
                            value="{{ $input['cote'] ?? '' }}">
                        <input type="text" placeholder="Auteur" class="form-control" name="auteur"
                            value="{{ $input['auteur'] ?? '' }}">
                        <input type="text" placeholder="Mots Clés" class="form-control" name="mots_cles"
                            value="{{ $input['mots_cles'] ?? '' }}">
                        <button type="submit" class="btn btn-gradient-primary btn-sm flex-grow-0">
                            Rechercher
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @forelse ($livre_imprimes as $livre_imprime)
            <div class="col-md-4 stretch-card grid-margin">
                <a href="{{ route('livre_imprimes.show', ['id' => $livre_imprime->id]) }}"
                    class="card bg-gradient-primary card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">
                            {{ $livre_imprime->emplacement }}
                            <i class="mdi mdi-diamond mdi-24px float-right"></i>
                        </h4>
                        <p class="card-text">
                            {{ $livre_imprime->division_name }}, {{ $livre_imprime->cote }}
                        </p>
                        <p style="text-align: left" class="card-text">{{ $livre_imprime->titre }}</p>
                        <p class="card-text">
                            {{ $livre_imprime->auteur }}
                        </p>
                        <p class="card-text">
                            Exemplaires : {{ $livre_imprime->nombre_exemplaires }}
                        </p>
                    </div>
                </a>
            </div>
        @empty
        @endforelse
    </div>
@endsection
