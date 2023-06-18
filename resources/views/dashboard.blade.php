@extends('layout.theme')
@section('title', 'Accueil')
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
                <li class="breadcrumb-item active" aria-current="page">Gestion Fonds Documentaire</li>
            </ol>
        </nav>

    </div>
    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-dark card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        CID
                        <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <br>
                    <p>
                        Nous sommes ravis de vous accueillir dans notre univers dédié à la gestion efficace de vos
                        documents. Que vous soyez une entreprise, une organisation ou un particulier, nous sommes là pour
                        simplifier votre processus de gestion documentaire.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        Bibliothèque Centrale
                        <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <br>
                    <p>
                        Notre plateforme offre une solution complète et intuitive pour organiser, stocker et retrouver
                        facilement vos documents. Avec notre système avancé de classement et de recherche, vous pourrez
                        gérer votre fonds documentaire de manière efficace, gagner du temps précieux et optimiser votre
                        productivité.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        Université de Parakou
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
