@extends('layout.theme')
@section('title', 'Interdit')
@section('content')
    <div class="row">
        <div class="col-md-12 stretch-card grid-margin">
            <div class="card card-img-holder">
                <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <div class="text-center">
                        <button class="btn btn-gradient-danger">
                            Accès non autorisé
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
