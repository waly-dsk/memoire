@extends('layout.theme')
@section('title', $agent->exists ? 'Editer un agent ' : 'Ajouter un agent')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book"></i>
            </span>
            @if ($agent->exists)
                Editer un Agent
            @else
                Ajouter un Agent
            @endif
        </h3>
    </div>
    <div id="flash">
        @include('shared.flash')
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample"
                        action="{{ route($agent->exists ? 'user.update' : 'user.store', ['user' => $agent->id]) }}"
                        method="post">
                        @csrf @method($agent->exists ? 'PUT' : 'POST')
                        <div class="form-group">
                            <label for="name">Nom de l'agent</label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Nom de l'agent" value="{{ $agent->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Adresse email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Adresse email" value="{{ $agent->email }}">
                        </div>

                        <div class="form-group">
                            <label for="role">Rôle</label>
                            @if ($agent->role == 'admin')
                                <input disabled type="text" name="role" class="form-control" id="role"
                                    value="{{ Str::ucfirst($agent->role) }}">
                            @else
                                <input type="text" name="role" class="form-control" id="role" placeholder="Rôle"
                                    value="{{ $agent->role }}">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Mot de passe" value="">
                        </div>

                        <button type="submit" class="btn btn-gradient-primary mr-2">
                            @if ($agent->exists)
                                Modifier
                            @else
                                Créer
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
