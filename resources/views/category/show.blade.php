@extends('layout.theme')
@section('title', 'Détails')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-chart-scatterplot-hexbin"></i>
            </span>
            {{ $categorie->category_intitule }}
        </h3>
        <a class="btn btn-gradient-info" href="{{ route('category.index') }}">Retour</a>
    </div>
    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Classe : {{ $categorie->category_classe }}</h4>
                    <p class="card-description"> Le<code>CID-UP</code> utilise la <code>Classification de Dewey</code></p>
                    <ul class="list-ticked">
                        @foreach ($divisions as $division)
                            <li>
                                <span class="">
                                    {{ $division->division_classe }}
                                </span>
                                <span class="ml-3">
                                    :
                                </span>
                                <span class="ml-3">
                                    {{ $division->division_intitule }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
