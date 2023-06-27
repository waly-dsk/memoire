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
                    <form action="" method="get" class="forms sample d-flex gap-2">
                        <input type="text" placeholder="Entité" class="form-control" name="entite"
                            value="{{ $input['entite'] ?? '' }}">
                        <select name="type_abonne" id="" class="form-control">
                            <option value="">Type d'abonné</option>
                            @foreach ($type_abonnes as $type_abonne)
                                <option value="{{ $type_abonne->id }}"
                                    {{ ($input['type_abonne'] ?? '') == $type_abonne->id ? 'selected' : '' }}>
                                    {{ $type_abonne->nom }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" placeholder="Matricule" class="form-control" id="search_by_matricule"
                            name="matricule" value="{{ $input['matricule'] ?? '' }}">
                        <input type="text" placeholder="Nom Prénoms" class="form-control" name="nom"
                            value="{{ $input['nom'] ?? '' }}">
                        <button type="submit" class="btn btn-gradient-primary btn-sm flex-grow-0">
                            Rechercher
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Entité</th>
                                    <th>Type</th>
                                    <th>Nom - Prénoms</th>
                                    <th>Date d'Ajout</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($abonnes as $abonne)
                                    <tr>
                                        <td>
                                            {{ $abonne->entite }}
                                        </td>
                                        <td>
                                            {{ $abonne->type_abonne == 'Administratif Technique et de Service (ATS)' ? 'ATS' : $abonne->type_abonne }}
                                        </td>
                                        <td>
                                            {{ $abonne->nom }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($abonne->created_at)->locale('fr_FR')->isoFormat('LL') }}
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
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $('#search_by_matricule').on('input', function() {
                let value = $(this).val();
                if (/\D/g.test(value)) {
                    value = value.substr(0, value.length - 1);
                    $(this).val(value);
                }
            })
        })
    </script>
@endsection
