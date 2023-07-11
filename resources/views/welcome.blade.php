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

        <div class="col-md-6 grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        Mots du Recteur
                        <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <br>
                    <p style="text-align: justify">
                        Cher(e) utilisateur(trice),
                        <br>
                        Bienvenue sur BiblioInfo. Nous sommes ravis de vous
                        accueillir dans notre espace virtuel dédié à l'apprentissage et à la recherche.
                        <br>
                        Explorez notre vaste collection de ressources documentaires. Nous sommes là pour vous accompagner
                        tout au long de
                        votre parcours académique.

                        <br>
                        Bienvenue à bord !
                        <br>
                    <div class="text-right">
                        Professeur Bertrand SOGBOSSI BOCCO,
                        <br>
                        Recteur de l'Université de Parakou
                    </div>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        Mots du Responsable

                        <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <br>
                    <p style="text-align: justify">
                        Je suis ravi de vous
                        accueillir sur BiblioInfo. Cette application représente un outil précieux pour faciliter votre
                        accès à nos ressources documentaires et vous accompagner dans vos recherches académiques.
                        <br>
                        Notre bibliothèque abrite une collection diversifiée de livres, mémoires, thèses, articles et autres
                        supports
                        de connaissances, sélectionnés pour répondre à vos besoins d'apprentissage et de
                        recherche.
                        <br>
                        Avec BiblioInfo, vous avez désormais un moyen efficace
                        d'explorer cette richesse d'informations.
                        <br>
                        Cordialement,
                    <div class="text-right">
                        Monsieur Roland CHABI,
                        <br>
                        <span class="mt-3">
                            Responsable BCUP.
                        </span>
                    </div>
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
