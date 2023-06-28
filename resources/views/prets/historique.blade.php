@extends('layout.theme')
@section('title', 'Historique')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-multiple-plus"></i>
            </span>
            Historique des prêts
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pret.index') }}">Prêts en cours</a></li>
                <li class="breadcrumb-item active" aria-current="page">Prêts à Domicile</li>
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
                                    <th>Abonné</th>
                                    <th>Exemplaire</th>
                                    <th>Sorti le</th>
                                    <th>Retour prévu le </th>
                                    <th>Retourné le </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nomPrecedent = '';
                                @endphp
                                @forelse($historique as $pret)
                                    @php
                                        $dateFinPrevue = \Carbon\Carbon::parse($pret->date_fin_prevue)
                                            ->locale('fr_FR')
                                            ->isoFormat('LL');
                                        $dateRetourReelle = \Carbon\Carbon::parse($pret->date_retour_relle)
                                            ->locale('fr_FR')
                                            ->isoFormat('LL');
                                        $difference = $dateRetourReelle > $dateFinPrevue;
                                    @endphp
                                    <tr>
                                        <td>
                                            @if ($pret->abonne_name != $nomPrecedent)
                                                {{ $pret->abonne_name }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $pret->titre . ' [' . $pret->cote . '] ' }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($pret->date_debut)->locale('fr_FR')->isoFormat('LL') }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($pret->date_fin_prevue)->locale('fr_FR')->isoFormat('LL') }}
                                        </td>
                                        <td>
                                            @if ($difference)
                                                <span style="color: red;">{{ $dateRetourReelle }}</span>
                                            @else
                                                {{ $dateRetourReelle }}
                                            @endif
                                        </td>
                                    </tr>

                                    @php
                                        $nomPrecedent = $pret->abonne_name;
                                    @endphp
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
