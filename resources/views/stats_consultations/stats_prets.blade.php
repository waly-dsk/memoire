@extends('layout.theme')

@section('title', 'Statistiques prêts à domicile')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-multiple-plus"></i>
            </span>
            Statistiques des Prêts
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pret.index') }}">Prêts en cours</a></li>
                <li class="breadcrumb-item"><a href="#">Consulter Graphes</a></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Livres Imprimés</h4>
                    <p class="card-description"> Statistiques des <code> Prêts à Domicile </code> pour les <code>Livres
                            Imprimés</code>.
                    </p>
                    <table style="table-layout: fixed;" class="table">
                        @if (count($stats) > 0)
                            <thead>
                                <tr>
                                    <th scope="col">
                                        Catégorie
                                    </th>
                                    <th scope="col">
                                        Mois
                                    </th>
                                    <th scope="col">
                                        Nombre de Prêts
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $moisPrecedent = null;
                                @endphp

                                @foreach ($stats as $stat)
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            {{ $stat->intitule }}
                                        </td>
                                        <td>
                                            <?php setlocale(LC_TIME, 'fr_FR.UTF-8'); ?>
                                            @if ($stat->mois_annee !== $moisPrecedent)
                                                {{ ucfirst(strftime('%B %Y', strtotime($stat->mois_annee))) }}
                                                @php
                                                    $moisPrecedent = $stat->mois_annee;
                                                @endphp
                                            @endif
                                        </td>
                                        <td>
                                            <label style="text-center">
                                                {{ $stat->nombre_prets }}
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @else
                            <tr>
                                <td colspan="3">
                                    <div class="text-center">
                                        <a href="#" class="btn btn-gradient-primary ">
                                            Aucune statistique n'a été trouvée.
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
