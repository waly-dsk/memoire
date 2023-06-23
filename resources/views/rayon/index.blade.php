@extends('layout.theme')
@section('title', 'Rayons')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-multiple-plus"></i>
            </span>
            Rayons
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('rayon.create') }}">Ajouter un Rayon</a></li>
                <li class="breadcrumb-item active" aria-current="page">Rayons</li>
            </ol>
        </nav>
    </div>
    <div id="flash">
        @include('shared.flash')
    </div>
    <div class="row">
        @forelse ($rayons as $rayon)
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $rayon->nom }}</h4>
                        <p class="card-description">Le <code>{{ $rayon->nom }} </code> avec ses <code> Loges </code>.
                        </p>
                        <ul class="list-ticked">
                            @foreach (explode(',', $rayon->loges) as $loge)
                                <li>{{ $loge }}</li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title"></h4>
                        <p class="card-description">
                            Aucun <code> Rayon </code> enregistré
                        </p>
                    </div>
                </div>
            </div>
        @endforelse
        {{-- <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Date d'Ajout</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rayons as $rayon)
                                    <tr>
                                        <td>{{ $rayon->matricule }}</td>
                                        <td>{{ $rayon->nom }}</td>
                                        <td>{{ $rayon->entite }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a href="{{ route('rayon.edit', $rayon->id) }}" title="Modifier"
                                                    class="mdi mdi-grease-pencil"></a>
                                                <form action="{{ route('rayon.destroy', $rayon->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button style="color:red;" class="btn btn-link p-0" title="Supprimer">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div> --}}

    </div>
@endsection
