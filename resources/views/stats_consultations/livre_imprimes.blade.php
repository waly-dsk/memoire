@extends('layout.theme')
@section('title', 'Statistiques')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-multiple-plus"></i>
            </span>
            Consultations Livres Imprimés
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('consultation_livre_imprime.create') }}">
                        Ajouter Consultation
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('consultations_livres_imprimes') }}">Consulter Graphes</a></li>
            </ol>
        </nav>

    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
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
                                @php
                                    $previousMonth = null;
                                @endphp

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
                                                        href="{{ route('livre_imprimes.show', ['id' => $livre_imprime_id]) }}">
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
                                            @php
                                                $currentMonth = ucfirst(strftime('%B %Y', strtotime($stat->mois_annee)));
                                                if ($currentMonth !== $previousMonth) {
                                                    echo $currentMonth;
                                                }
                                                $previousMonth = $currentMonth;
                                            @endphp
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
