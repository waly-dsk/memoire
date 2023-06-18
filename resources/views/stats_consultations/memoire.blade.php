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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('consultation_memoire_these.create') }}">
                        Ajouter une Consultation
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('consultations_memoires_theses') }}">
                        Consulter Graphes
                    </a>
                </li>
            </ol>
        </nav>

    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Mémoires et Thèses</h4>
                    <p class="card-description"> Les<code> Statistiques de Consultations sur Place</code> /<code>de Mémoires
                            et Thèses</code> </p>
                    <table style="table-layout: fixed;" class="table">
                        @if (count($memos) > 0)
                            <thead>
                                <tr>
                                    <th scope="col">
                                        Entité
                                    </th>
                                    <th scope="col">
                                        Option
                                    </th>
                                    <th scope="col">
                                        Mémoires
                                    </th>
                                    <th scope="col">
                                        Mois
                                    </th>
                                    <th scope="col">
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $previousMonth = null;
                                @endphp

                                @foreach ($memos as $memo)
                                    <tr>
                                        <td style="vertical-align:middle;">
                                            {{ mb_strtoupper($memo->entite) }}
                                        </td>
                                        <td>
                                            @php
                                                $previousOption = null;
                                            @endphp
                                            @foreach (explode(',', $memo->options) as $option)
                                                @php
                                                    $trimmedOption = trim($option);
                                                @endphp
                                                @if ($trimmedOption !== $previousOption)
                                                    {{ $trimmedOption }}<br>
                                                    @php
                                                        $previousOption = $trimmedOption;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </td>

                                        <td style="text-center">
                                            @php
                                                $previousCote = null;
                                            @endphp
                                            @foreach (explode(';', $memo->memoires) as $memoire)
                                                @php
                                                    $parts = explode(':', $memoire);
                                                    $memoire_id = $parts[0];
                                                    $cote = $parts[1];
                                                @endphp
                                                @if ($cote !== $previousCote)
                                                    <a
                                                        href="{{ route('memoire_these.show', ['memoire_these' => $memoire_id]) }}">
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
                                                $currentMonth = ucfirst(strftime('%B %Y', strtotime($memo->mois_annee)));
                                                if ($currentMonth !== $previousMonth) {
                                                    echo $currentMonth;
                                                }
                                                $previousMonth = $currentMonth;
                                            @endphp
                                        </td>

                                        <td>
                                            <label style="text-center">
                                                {{ $memo->total_consultations }}
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @else
                            <tr>
                                <td colspan="5">
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
    {{ $memos->links() }}
@endsection
