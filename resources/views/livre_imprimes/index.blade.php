@extends('layout.theme')
@section('title', 'Livres Imprimés')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book-open-page-variant"></i>
            </span>
            Nos Livres
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @if ($user->exists)
                    <li class="breadcrumb-item"><a href="{{ route('livre_imprime.create') }}">Ajouter un Livre</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page"> Nos Livres</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Livres Imprimés</h4>
                    <p class="card-description">
                        Tous les <code> Livres Imprimés</code> de notre<code> Bibliothèque</code>
                    </p>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Cote</th>
                                <th>Titre</th>
                                <th>Auteur</th>
                                <th>Exemplaire</th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($livre_imprimes as $livre_imprime)
                                <tr>
                                    <td>{{ $livre_imprime->cote }}</td>
                                    <td>{{ $livre_imprime->titre }}</td>
                                    <td class="">{{ $livre_imprime->auteur }}</td>
                                    <td>
                                        <label class="badge badge-danger">{{ $livre_imprime->nombre_exemplaires }}</label>
                                    </td>
                                    @if ($user->exists)
                                        <td>
                                            <div class="row">
                                                <a href="{{ route('livre_imprime.show', $livre_imprime->id) }}"
                                                    title="Détails" class="offset-1  mdi mdi-eye">
                                                </a>
                                                <a href="{{ route('livre_imprime.edit', $livre_imprime->id) }}"
                                                    title="Modifier" class="offset-1  mdi mdi-border-color">
                                                </a>
                                                <form action="{{ route('livre_imprime.destroy', $livre_imprime->id) }}"
                                                    method="post" class="offset-1 align-self-center">
                                                    @csrf
                                                    @method('delete')
                                                    <button style="color:red;" class="btn btn-link p-0" title="Supprimer">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{ route('livre_imprimes.show', $livre_imprime->id) }}" title="Détails"
                                                class="offset-2  mdi mdi-eye">
                                            </a>

                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
