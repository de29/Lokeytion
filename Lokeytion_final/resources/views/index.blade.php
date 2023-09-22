<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lokeytion</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{url('css/bootstrap-icons.css')}}" rel="stylesheet">

    <link href="{{url('css/owl.carousel.min.css')}}" rel="stylesheet">

    <link href="{{url('css/owl.theme.default.min.css')}}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/myStyle.css">


</head>

<body id="top">
@if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
              @endif
    <main>

        <nav class="navbar navbar-expand-lg fixed-top shadow-lg">
            <div class="container">


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav " style="margin-left:-10%;">
                        <li class="nav-item active">
                            <a class="nav-link" href="#hero">HOME</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#about" style="width:100%">A PROPOS</a>
                        </li>

                        <a class="navbar-brand d-none d-lg-block" href="/logout">
                            <img src="images/gallery/logo1.png" alt="Logo" width="550px" height="120px">
                        </a>

                        <li class="nav-item">
                            <a class="nav-link" href="/login">CONNEXION</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="#contactus">CONTACTEZ-NOUS</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
        <header>
            <center>
                <h1 data-shadow='Location de matériels et objets'>Location de matériels et objets</h1>
                
            </center>

        </header>


        <section class="hero" id="hero">
            <div class="container">
                <section id="slider" class="pt-5">
                    <div class="slider">
                        <div class="owl-carousel">
                            <div class="slider-card">
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <img src="images/gallery/basket.png" alt="">
                                </div>
                                <h5 class="mb-0 text-center"><b>Variété d'objets</b></h5>
                                <p class="text-center p-4" style="color: #404040; font-family: 'Quicksand', sans-serif; font-weight: 600;">Avez-vous besoin d'un équipement de sport pour une compétition ou d'un outil de bricolage? Lokeytion est là pour vous!</p>
                            </div>
                            <div class="slider-card">
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <img src="images/gallery/idea.png" alt="">
                                </div>
                                <h5 class="mb-0 text-center"><b>Solution pratique et abordable</b></h5>
                                <p class="text-center p-4" style="color: #404040; font-family: 'Quicksand', sans-serif; font-weight: 600;">Lokeytion offre une solution pour les personnes qui ont besoin d'utiliser un objet temporairement sans avoir à l'acheter.</p>
                            </div>
                            <div class="slider-card">
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <img src="images/gallery/world.png" alt="">
                                </div>
                                <h5 class="mb-0 text-center"><b>La réduction des déchets</b></h5>
                                <p class="text-center p-4" style="color: #404040; font-family: 'Quicksand', sans-serif; font-weight: 600;">En choisissant de louer plutôt que d'acheter, vous évitez de gaspiller des ressources en produisant de nouveaux objets.</p>
                            </div>
                        </div>
                </section>

            </div>

        </section>
        <div class="text-center mt-4">
            <a href="/login"><button class="myBtn">Commencez par un simple clic !</button></a>
        </div>
        <section class="hero d-flex align-items-center" id="about" style="height:fit-content; background-color:#efe9ea; padding-bottom: 80px; ">
            <div class="container d-flex justify-content-center">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 style="color: #404040; text-transform: none; text-align: left; font-family: 'Righteous', sans-serif;">A-propos</h2>
                        <div class="border1"></div>
                        <img src="images/gallery/puzzle.jpg" alt="About" class="img-fluid" style="width: 100%;">
                    </div>
                    <div class="col-md-6" style="margin-top: 20%; padding-left: 5%;">
                        <p style="font-size: 1.3rem; color: #404040; font-family: 'Quicksand', sans-serif; font-weight: 400;"><b>Lokeytion</b> est un site de location d'objets en ligne qui permet aux utilisateurs de louer des objets pour une durée déterminée. Nous offrons une grande variété d'objets à la location, tels que des équipements de sport, des outils de jardinage, des appareils électroniques, des accessoires de mode, des instruments de musique et bien plus encore.
                            Notre objectif est de fournir une solution pratique et abordable pour les personnes qui ont besoin d'utiliser un objet temporairement sans avoir à l'acheter. Nous visons également à promouvoir l'économie circulaire en encourageant la réutilisation et la réduction des déchets.
                            Chez Lokeytion, nous sommes fiers de proposer des tarifs compétitifs et des politiques de location flexibles pour répondre aux besoins de nos clients. Notre processus de location est simple et efficace, avec une plateforme en ligne conviviale pour rechercher et réserver des objets, ainsi qu'un système de paiement sécurisé.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="contactus" style="height:fit-content;  background-color:#efe9ea; padding-top: 50px; padding-bottom: 50px;">
       
        <div class="container">
                <header>
                    <h2 style="color: #404040; text-transform: none; text-align: left; font-family: 'Righteous', sans-serif; padding-top:50px">Contactez-nous</h2>
                    <div class="border"></div>
                    @if(Session::has('envoyer'))
              <div class="alert alert-success">{{Session::get('envoyer')}}</div>
              @endif   
                </header>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <img src="images/gallery/home.png" class="img-fluid galleryImage" alt="" height="700px" width="710px">
                    </div>
                    <div class="col-lg-6 col-12">
                        <form action="{{url('/contactus')}}" >
                            <div class="form-item">
                                <label for="text" style="font-size:18px">Nom</label>
                                <input type="text" name="nom" id="floatingInput" style="width:80%">
                            </div>
                            <div class="form-item">
                                <label for="email" style="font-size:18px">Sujet</label>
                                <input type="text"  name="sujet" id="floatingInput"  style="width:80%">
                            </div>
                            <div class="form-item">
                                <label for="email" style="font-size:18px">email</label>
                                <input type="email"  name="email" id="floatingInput"  style="width:80%">
                            </div>
                            <div class="form-item">
                                <label for="text" style="font-size:18px">Message</label>
                                <textarea  id="floatingInput" name="message" rows="50" placeholder="MESSAGE" style="font-size: large; width:80%; height:200px"></textarea>
                            </div>
                            </div>
                            <button type="submit" class="myBtn2" style="display: block; margin: auto; margin-top: 30px;">Envoyer</button>
                        </form>

                    </div>
                </div>
            </div>
</section>

    </main>


    @include('footer')

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/scrollspy.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/index.js"></script>

</body>

</html>
