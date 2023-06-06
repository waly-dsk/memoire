@extends('layout.theme')
@section('title', 'Agents')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-multiple-plus"></i>
            </span>
            Agents
        </h3>

        <a class="btn btn-gradient-secondary" href="{{ route('user.create') }}">Ajouter un Agent</a>
    </div>
    @include('shared.flash')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Adresse Email</th>
                                <th>Rôle</th>
                                <th>Date Ajout</th>
                                <th class="">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agents as $agent)
                                <tr>
                                    <td>{{ $agent->name }}</td>
                                    <td>{{ $agent->email }}</td>
                                    <td>
                                        <label class="badge badge-success">
                                            {{ Str::ucfirst($agent->role) }}
                                        </label>
                                    </td>
                                    <td>
                                        <label class="badge badge-danger">
                                            {{ \Carbon\Carbon::parse($agent->created_at)->locale('fr_FR')->isoFormat('LL') }}
                                        </label>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('user.edit', $agent->id) }}" title="Modifier"
                                                class="offset-1 mdi mdi-grease-pencil">
                                            </a>
                                            <form action="{{ route('user.destroy', $agent->id) }}" method="post"
                                                class="offset-3 align-self-center">
                                                @csrf
                                                @method('delete')
                                                <button style="color:red;" class="btn btn-link p-0" title="Supprimer">
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
