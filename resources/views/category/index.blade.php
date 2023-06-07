@extends('layout.theme')
@section('title', 'Catégories')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-biohazard"></i>
            </span>
            Catégories
        </h3>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Classification Dewey</h4>
                    <p class="card-description">
                        Le <code>CID-UP</code> utilise la <code>Classification Décimale de Dewey</code>
                    </p>
                    <p>
                        La classification décimale de Dewey (CDD) est le système qui est appliqué afin de permettre à nos
                        bibliothèques de classer par sujet l’ensemble de la collection de livres. Ce système de
                        classification répartit les livres dans dix classes. Chaque classe est elle-même divisée en dix
                        divisions, chaque division en dix subdivisions et ainsi de suite.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Catégories</h4>
                    <p class="card-description"> Les<code>.catégories</code> d'ouvrage</p>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>CLASSE</th>
                                <th>INTITULE</th>
                                <th>DATE AJOUT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        {{ $category->id }}
                                    </td>
                                    <td>
                                        <a href="{{ route('category.show', $category->id) }}">
                                            {{ $category->classe }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('category.show', $category->id) }}">
                                            {{ $category->intitule }}
                                        </a>
                                    </td>
                                    <td>
                                        <label class="badge badge-danger">
                                            {{ \Carbon\Carbon::parse($category->created_at)->locale('fr_FR')->isoFormat('LL') }}

                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
