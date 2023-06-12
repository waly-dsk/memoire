@extends('layout.theme')
@section('title', 'Tous les Prêts')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span>
            Tous les Prêts à Domicile
        </h3>
        <nav aria-label="breadcrumb">
            <a class="btn btn-gradient-primary" href="{{ route('pret.create') }}">Enregistrer un Pret</a>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Striped Table</h4>
                    <p class="card-description">
                        Add class <code>.table-striped</code>
                    </p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    ####
                                </th>
                                <th>
                                    Abonné
                                </th>
                                <th>
                                    Date de Début
                                </th>
                                <th>
                                    Date de Fin Prévue
                                </th>
                                <th>
                                    #######
                                </th>
                                <th>
                                    <center>
                                        Actions
                                    </center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prets as $pret)
                                <tr>
                                    <td class="py-1">
                                        <img src="{{ asset('assets/images/faces-clipart/pic-1.png') }} " alt="image" />
                                    </td>
                                    <td>
                                        <a href="{{ route('pret.show', $pret->pret_id) }}">
                                            {{ $pret->nom }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($pret->date_debut)->formatLocalized('%e %B %Y') }}
                                        {{-- {{ $pret->date_debut }} --}}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($pret->date_fin_prevue)->formatLocalized('%e %B %Y') }}
                                    </td>
                                    <td>
                                        <a href="#">Retour de Prêt</a>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <a title="Modifier" href="{{ route('pret.edit', $pret->pret_id) }}"
                                                class="offset-3 mdi mdi-grease-pencil" style="color: blue">
                                            </a>
                                            <form action="{{ route('pret.destroy', $pret->pret_id) }} " method="post"
                                                class="offset-3">
                                                @csrf
                                                @method('delete')
                                                <button title="Supprimer" type="submit" style="color: red; border: none">
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
