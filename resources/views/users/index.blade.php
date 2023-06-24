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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.create') }}">Ajouter un Agent</a></li>
                <li class="breadcrumb-item active" aria-current="page">Agents</li>
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
                    <div class="table-responsive">
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
                                            {{ Str::ucfirst($agent->role) }}
                                        </td>
                                        <td>
                                            <?php setlocale(LC_TIME, 'fr_FR.UTF-8'); ?>
                                            {{ ucfirst(strftime('%B %Y', strtotime($agent->created_at))) }}
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
    </div>
    {{ $agents->links() }}
@endsection
