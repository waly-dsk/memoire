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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('abonne.create') }}">Ajouter un Abonné</a></li>
                <li class="breadcrumb-item active" aria-current="page">Abonnés</li>
            </ol>
        </nav>
    </div>
    <div id="flash">
        @include('shared.flash')
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"></h4>
                    <p class="card-description">
                        Vous pouvez <code> Filtrer </code> la liste des <code> Abonnés.</code>
                    </p>
                    <form action="" method="get" class="mb-5 forms sample d-flex gap-2">
                        <input type="text" placeholder="Entité" class="form-control" name="entite"
                            value="{{ $input['entite'] ?? '' }}">
                        <input type="text" placeholder="Option" class="form-control" name="option"
                            value="{{ $input['option'] ?? '' }}">
                        <input type="number" placeholder="Matricule" class="form-control" name="matricule"
                            value="{{ $input['matricule'] ?? '' }}">
                        <input type="text" placeholder="Nom Prénoms" class="form-control" name="nom"
                            value="{{ $input['nom'] ?? '' }}">
                        <button type="submit" class="btn btn-gradient-primary btn-sm flex-grow-0">
                            Rechercher
                        </button>
                    </form>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Matricule</th>
                                    <th>Nom &amp; Prénoms</th>
                                    <th>Entité</th>
                                    <th>Option</th>
                                    <th>Date d'Ajout</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($abonnes as $abonne)
                                    <tr>
                                        <td>{{ $abonne->matricule }}</td>
                                        <td>{{ $abonne->nom }}</td>
                                        <td>{{ $abonne->entite }}</td>
                                        <td>{{ $abonne->option }}</td>
                                        <td>{{ \Carbon\Carbon::parse($abonne->created_at)->locale('fr_FR')->isoFormat('LL') }}
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a href="{{ route('abonne.edit', $abonne->id) }}" title="Modifier"
                                                    class="mdi mdi-grease-pencil"></a>
                                                <form action="{{ route('abonne.destroy', $abonne->id) }}" method="post">
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
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="col mt-5">
                                                <a href="#" class="">AUCUN ABONNE NE CORRESPOND A
                                                    VOTRE RECHERCHE</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{ $abonnes->links() }}
@endsection
