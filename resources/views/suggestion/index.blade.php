@extends('layout.theme')
@section('title', 'Toutes les Suggestions')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span>
            Suggestions
        </h3>
        <nav aria-label="breadcrumb">
            <a class="btn btn-gradient-primary" href="{{ route('suggestion.create') }}">Ajouter une Suggestion</a>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Catégorie</th>
                                    <th>Auteur</th>
                                    <th>Titre</th>
                                    <th>Date d'Ajout</th>
                                    @if ($user->exists)
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suggestions as $suggestion)
                                    <tr>
                                        <td>
                                            {{ $suggestion->categorie }}
                                        </td>
                                        <td>
                                            <label class="badge badge-gradient-primary">
                                                {{ $suggestion->auteur }}
                                            </label>
                                        </td>
                                        <td>
                                            <label class="badge badge-gradient-success">
                                                {{ $suggestion->titre }}
                                            </label>
                                        </td>
                                        <td>
                                            <label class="badge badge-gradient-warning">
                                                {{ \Carbon\Carbon::parse($suggestion->created_at)->locale('fr_FR')->isoFormat('LL') }}
                                            </label>
                                        </td>
                                        @if ($user->exists)
                                            <td>
                                                <div class="row">
                                                    <a href="" title="Répondre"
                                                        class="offset-1 mdi mdi-message-reply">
                                                    </a>
                                                    <form action="" method="post" class="offset-5 align-self-center">
                                                        @csrf
                                                        @method('delete')
                                                        <button style="color:red;" class="btn btn-link p-0"
                                                            title="Supprimer">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            {{ $suggestions->links() }}
        </div>
    </div>
@endsection
