@extends('layout.theme')
@section('title', 'Détails Prêt')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span>
            Détails Prêt
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Informations Abonné</a></li>
                <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Détails Prêt</h4>
                    <p class="card-description">
                        Ici, toutes les <code>Informations</code> relatives au <code>Prêt</code>
                    </p>
                    @if ($pret)
                        <hr>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="abonne">Agent ayant servi Prêt</label>
                                <input disabled type="text" class="form-control" id="abonne"
                                    value="{{ $pret->name }}">
                            </div>

                            <div class="form-group">
                                <label for="abonne">Abonne</label>
                                <input disabled type="text" class="form-control" id="abonne"
                                    value="{{ $pret->nom }}">
                            </div>
                            <div class="form-group">
                                <label for="date_debut">Date de Début</label>
                                <input disabled class="form-control" id="date_debut" value="{{ $pret->date_debut }}">
                            </div>
                            <div class="form-group">
                                <label for="date_fin_prevue">Date de Fin Prévue</label>
                                <input disabled class="form-control" id="date_fin_prevue"
                                    value="{{ $pret->date_fin_prevue }}">
                            </div>
                            <div class="form-group">
                                <label for="books">Livres Imprimés prêtés</label>
                                @foreach ($details as $detail)
                                    <input disabled type="text" class="form-control"
                                        value="{{ $detail->titre }} ------> {{ $detail->total }} ">
                                @endforeach
                            </div>
                            {{-- <a class="btn btn-gradient-primary mr-2">Submit</a> --}}
                        </form>
                    @else
                        <hr>
                        <div class="mt-5 text-center">
                            <span class="alert alert-warning">Ce pret n'existe pas !</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
