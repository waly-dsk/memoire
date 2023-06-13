@extends('layout.theme')
@section('title', 'Tous les Prêts')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span>
            Prêts à Domicile en Cours
        </h3>
        <nav aria-label="breadcrumb">
            <a class="btn btn-gradient-primary" href="{{ route('pret.create') }}">Enregistrer un Pret</a>
        </nav>
    </div>
    @include('shared.flash')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Prêts </h4>
                    <p class="card-description">
                        Tous les <code>Prêts non Retournés</code>
                    </p>
                    @if (sizeof($prets) > 0)
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
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prets as $pret)
                                    <tr>
                                        <td class="py-1">
                                            <img src="{{ asset('assets/images/faces-clipart/pic-1.png') }} "
                                                alt="image" />
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
                                            <div class="row">
                                                <a title="Modifier" href="{{ route('pret.edit', $pret->pret_id) }}"
                                                    class="offset-1 mdi mdi-grease-pencil" style="color: blue">
                                                </a>


                                                <a title="Retour" href="{{ route('pret.retour.create', $pret->pret_id) }}"
                                                    class="offset-3 mdi mdi-arrow-left-bold" style="color: blue">
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center">
                            <button class="btn btn-gradient-primary">PAS DE PRETS EN COURS</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
