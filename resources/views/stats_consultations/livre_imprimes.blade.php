@extends('layout.theme')
@section('title', 'Statistiques')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-multiple-plus"></i>
            </span>
            Statistiques des Consultations
        </h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Livres Imprimés</h4>
                    <p class="card-description">
                        Les <code>Statistiques de Consultations sur Place de </code>Livres Imprimés
                    </p>
                    <table style="table-layout: fixed;" class="table">
                        @if (count($stats) > 0)
                            <thead>
                                <tr>
                                    <th scope="col">Catégorie</th>
                                    <th scope="col">Sous Catégorie</th>
                                    <th scope="col">Livres</th>
                                    <th scope="col">Mois</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stats as $stat)
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            {{ $stat->categorie }}
                                        </td>
                                        <td>
                                            @php
                                                $previousDivision = null;
                                            @endphp
                                            @foreach (explode(',', $stat->divisions) as $division)
                                                @php
                                                    $trimmedDivision = trim($division);
                                                @endphp
                                                @if ($trimmedDivision !== $previousDivision)
                                                    {{ $trimmedDivision }}<br>
                                                    @php
                                                        $previousDivision = $trimmedDivision;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </td>




                                        <td style="text-center">
                                            @php
                                                $previousCote = null;
                                            @endphp
                                            @foreach (explode(';', $stat->livre_imprimes) as $livre_imprime)
                                                @php
                                                    $parts = explode(':', $livre_imprime);
                                                    $livre_imprime_id = $parts[0];
                                                    $cote = $parts[1];
                                                @endphp
                                                @if ($cote !== $previousCote)
                                                    <a
                                                        href="{{ route('livre_imprime.show', ['livre_imprime' => $livre_imprime_id]) }}">
                                                        {{ $cote }}<br>
                                                    </a>
                                                @endif
                                                @php
                                                    $previousCote = $cote;
                                                @endphp
                                            @endforeach
                                        </td>

                                        <td>
                                            <?php setlocale(LC_TIME, 'fr_FR.UTF-8'); ?>
                                            {{ ucfirst(strftime('%B %Y', strtotime($stat->mois_annee))) }}
                                        </td>
                                        <td>
                                            <label style="text-center">
                                                {{ $stat->total_consultations }}
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @else
                            <tr>
                                <td colspan="5">
                                    <div class="text-center">
                                        <a href="#" class="btn btn-gradient-primary">Aucune statistique n'a été
                                            trouvée.</a>
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
