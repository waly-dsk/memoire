@extends('layout.theme')
@section('title', 'Suggestion')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book"></i>
            </span>
            Faire une Suggestion
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('suggestion.index') }}">Toutes les Suggestions</a></li>
                <li class="breadcrumb-item active" aria-current="page">Suggestions</li>
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
                    <form class="forms-sample" action="{{ route('suggestion.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="categorie">Catégorie</label>
                            <input type="text" name="categorie" class="form-control" id="categorie"
                                placeholder="Catégorie">
                        </div>
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" name="titre" class="form-control" id="titre" placeholder="Titre">
                        </div>
                        <div class="form-group">
                            <label for="auteur">Auteur</label>
                            <input type="text" name="auteur" class="form-control" id="auteur" placeholder="Auteur">
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
