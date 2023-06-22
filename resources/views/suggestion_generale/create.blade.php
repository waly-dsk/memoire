@extends('layout.theme')
@section('title', 'Suggestion Générale')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book"></i>
            </span>
            Suggestion Générale
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('suggestion_generale.index') }}">Suggestions Générales</a></li>
                <li class="breadcrumb-item active" aria-current="page">Suggestions</li>
            </ol>
        </nav>
    </div>
    <div id="flash">
        @include('shared.flash')
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('suggestion_generale.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="type_suggestion_id">Type </label>
                            <select name="type_suggestion_id" id="type_suggestion_id" class="form-control">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contenu">Contenu</label>
                            <input type="text" name="contenu" class="form-control" id="contenu" placeholder="Contenu">
                        </div>

                        <button type="submit" class="btn btn-gradient-primary mr-2">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            console.log('mfm')
        })
    </script>
@endsection
