@extends('layout.theme')
@section('title', 'Home')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span>
            Accueil
        </h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""></a></li>
                <li class="breadcrumb-item active" aria-current="page">Gestion du Fonds Documentaire</li>
            </ol>
        </nav>

    </div>
    <div class="row">

        <div class="col-md-6 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-md-6 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        Mots du Responsable

                        <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <br>
                    <p>
                        Que vous ayez besoin de gérer des fichiers numériques ou des documents physiques, notre site vous
                        offre les outils nécessaires pour centraliser vos ressources documentaires et les rendre accessibles
                        à tout moment et de n'importe où.
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        // Open the modal when the button is clicked
    </script>
@endsection
