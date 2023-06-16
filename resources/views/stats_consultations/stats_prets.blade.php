@extends('layout.theme')

@section('title', 'Statistiques')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-multiple-plus"></i>
            </span>
            Statistiques des Prêts
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Livres Imprimés</h4>
                    <p class="card-description"> Statistiques des Prêts pour les Livres Imprimés </p>
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
                                @foreach ($stats as $stat)
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            {{ $stat->intitule }}
                                        </td>
                                        <td>
                                            <?php setlocale(LC_TIME, 'fr_FR.UTF-8'); ?>
                                            {{ ucfirst(strftime('%B %Y', strtotime($stat->mois_annee))) }}
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
