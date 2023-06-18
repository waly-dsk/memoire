@extends('layout.theme')
@section('title', 'Retour de Prêt')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span>
            Prêt de {{ $informations_pret->nom }}
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('pret.index') }}">
                        Prêts en cours
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">
                        Prêts à Domicile
                    </a>
                </li>
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
                    <h4 class="card-title">{{ $informations_pret->nom }}</h4>
                    <p class="card-description">Prêt effectué le
                        <code>{{ \Carbon\Carbon::parse($informations_pret->date_debut)->format('d/m/Y') }}</code>.
                        A retourner le
                        <code>{{ \Carbon\Carbon::parse($informations_pret->date_fin_prevue)->format('d/m/Y') }}</code>.
                    </p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Titre
                                </th>
                                <th>
                                    Exemplaire Emprunté
                                </th>
                                <th>
                                    Retourner
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mes_prets as $one_book)
                                <tr>
                                    <td>
                                        *
                                    </td>
                                    <td>
                                        {{ $one_book->titre }}
                                    </td>
                                    <td>
                                        <div class="offset-2">
                                            <b>{{ 1 }}</b>
                                        </div>
                                    </td>
                                    <td>
                                        <form class="offset-1"
                                            action="{{ route('pret.retour.put', $one_book->exemplaire_id) }}"
                                            method="post">
                                            @csrf @method('put')
                                            <button type="submit" style="color: blue; border: none">
                                                <i class="mdi mdi-arrow-left-bold"></i>
                                            </button>
                                        </form>
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
