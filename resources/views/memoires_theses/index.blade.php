@extends('layout.theme')
@section('title', $type_information->intitule)
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-multiple-plus"></i>
            </span>
            @yield('title')
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @if ($user->exists)
                    <li class="breadcrumb-item"><a
                            href="{{ route('memoires_theses.type_create', ['type' => $type_information->id]) }}">Ajouter
                            @yield('title')</a>
                    </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">Mémoires - Thèses</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="" method="get" class="forms sample d-flex gap-2">
                        <input type="text" placeholder="Entité" class="form-control" name="entite"
                            value="{{ $input['entite'] ?? '' }}">
                        <input type="text" placeholder="Mots Clés" class="form-control" name="mots_cles"
                            value="{{ $input['mots_cles'] ?? '' }}">
                        <input type="text" placeholder="Encadreur" class="form-control" name="encadreur"
                            value="{{ $input['encadreur'] ?? '' }}">
                        <input type="text" placeholder="Année : XXXX-YYYY" class="form-control" name="annee"
                            value="{{ $input['annee'] ?? '' }}">
                        <button type="submit" class="btn btn-gradient-primary btn-sm flex-grow-0">
                            Rechercher
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Boucle pour afficher les mémoires -->
        @forelse ($documents as $document)
            <div class="col-md-4 stretch-card grid-margin">
                <a href="{{ route('memoires_theses.show', ['id' => $document->id]) }}"
                    class="card bg-gradient-primary card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">
                            {{ $document->emplacement }}
                            <i class="mdi mdi-diamond mdi-24px float-right"></i>
                        </h4>
                        <p class="card-text">
                            {{ $document->entite }} :
                            {{ $document->option }}
                        </p>
                        <p style="text-align: left" class="card-text">{{ $document->theme }}</p>

                        <!-- Autres informations de l'document -->
                    </div>
                </a>
            </div>
        @empty
        @endforelse
    </div>

@endsection
@section('script')
    <script></script>
@endsection
