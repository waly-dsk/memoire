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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @if ($user && $user->exists)
                    <li class="breadcrumb-item"><a href="{{ route('livre_imprime.create') }}">Ajouter un Livre Imprimé</a>
                    </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">Livres Imprimés</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">La classification Dewey</h4>
                    <p class="card-description">
                        Le <code>CID-UP</code> utilise la <code>Classification Décimale de Dewey</code>
                    </p>
                    <p>
                        La Classification Décimale de Dewey (CDD) est le système qui est appliqué afin de permettre à notre
                        bibliothèque de classer par sujet l’ensemble de la collection de livres. Ce système de
                        classification répartit les livres dans dix classes. Chaque classe est elle-même divisée en dix
                        divisions.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @forelse ($categories as $category)
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $category->intitule . ' (' . $category->classe . ') ' }}</h4>
                        <p></p>
                        <ul class="list-ticked">
                            @php
                                $divisionIds = explode(' | ', rtrim($category->division_ids, ' | '));
                                $divisionClasses = explode(' | ', rtrim($category->division_classes, ' | '));
                                $divisions = explode(' | ', rtrim($category->divisions, ' | '));
                            @endphp
                            @foreach ($divisionIds as $key => $divisionId)
                                <li><a href="{{ route('livre_imprime.index', ['division_id' => $divisionId]) }}">{{ $divisionClasses[$key] }}
                                        -
                                        {{ $divisions[$key] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>


@endsection
@section('script')
    <script>
        // Open the modal when the button is clicked
    </script>
@endsection
