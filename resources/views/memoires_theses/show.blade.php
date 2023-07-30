@extends('layout.theme')
@section('title', $document->type_document)
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-bullseye"></i>
            </span>
            {{ $document->type_document }}
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{ route('memoires_theses.type_index', ['type' => $document->type_id]) }}">
                        @yield('title') </a></li>
                <li class="breadcrumb-item active" aria-current="page">Informations</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-description">
                        Emplacement : <span class="text-info font-weight-bold">{{ $document->emplacement }}</span>
                    </p>
                    <hr>
                    <p class="card-description">
                        Entité : <span class="text-info">{{ $document->entite }}</span>
                    </p>
                    <hr>

                    <p class="card-description">
                        Option : <span class="text-info">{{ $document->option }}</span>
                    </p>
                    <hr>

                    <p class="font-weight-bold">THEME : {{ $document->theme }}</p>
                    <hr>

                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-description">Auteur :
                        <span class="text-info font-weight-bold">
                            {{ $document->auteur }}
                        </span>
                    </p>
                    <hr>

                    <p class="card-description">Mention :
                        <span class="text-info font-weight-bold">
                            {{ $document->mention }}
                        </span>
                    </p>
                    <hr>

                    <p class="card-description">Encadreur :
                        <span class="text-info font-weight-bold">
                            {{ $document->encadreur }}
                        </span>
                    </p>
                    <hr>

                    <p class="card-description">Année :
                        <span class="text-info font-weight-bold">
                            {{ $document->annee }}
                        </span>
                    </p>
                    <hr>


                    @if ($document->pdf)
                        <a class="" href="{{ Storage::url($document->pdf) }}">
                            Télécharger le PDF
                        </a>
                        <hr>
                    @endif

                    @if ($user && $user->exists)
                        <div class="row mt-2">
                            <a href="{{ route('memoire_these.edit', $document->id) }}"
                                class="ml-3 btn btn-gradient-primary">
                                Modifier
                            </a>
                            <form action="{{ route('memoire_these.destroy', $document->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="ml-3 btn btn-gradient-danger">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    @endif
                    <hr>

                </div>
            </div>
        </div>
    </div>
@endsection
