@extends('layout.theme')
@section('title', 'Abonnés')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-multiple-plus"></i>
            </span>
            Abonnés
        </h3>
        @include('shared.flash')
        <a class="btn btn-gradient-secondary" href="{{ route('abonne.create') }}">Ajouter un Abonné</a>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Matricule</th>
                                <th>Nom & Prénoms</th>
                                <th>Entité</th>
                                <th>Option</th>
                                <th>Date d'Ajout</th>
                                <th class="">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($abonnes as $abonne)
                                <tr>
                                    <td>{{ $abonne->matricule }}</td>
                                    <td>{{ $abonne->nom }}</td>
                                    <th>
                                        <label class="badge badge-success">
                                            {{ $abonne->entite }}
                                        </label>
                                    </th>
                                    <th>
                                        <label class="badge badge-info">
                                            {{ $abonne->option }}
                                        </label>
                                    </th>
                                    <td>
                                        <label class="badge badge-danger">
                                            {{ \Carbon\Carbon::parse($abonne->created_at)->locale('fr_FR')->isoFormat('LL') }}
                                        </label>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('abonne.edit', $abonne->id) }}" title="Modifier"
                                                class="offset-1 mdi mdi-grease-pencil">
                                            </a>
                                            <form action="{{ route('abonne.destroy', $abonne->id) }}" method="post"
                                                class="offset-3 align-self-center">
                                                @csrf
                                                @method('delete')
                                                <button style="color:red;" class="btn btn-link p-0" title="Supprimer">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
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
