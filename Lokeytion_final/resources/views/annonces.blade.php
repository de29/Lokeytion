
@include('navbar', ['nbr_notification' => $nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Mes Annonces</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />



    <!-- Template Stylesheet -->
    <link href="{{ url('css/AnnoncesStyle.css') }}" rel="stylesheet" />
</head>

<body>

 <center>    <!-- Breadcrumb End -->
<br><br>
    @if(session('comment'))
    <div class="alert alert-warning">
        {{ session('comment') }}
    </div>
@endif

@if(session('Commentexist'))
    <div class="alert alert-warning">
        {{ session('Commentexist') }}
    </div>
@endif

    <!-- Product List Start -->
   
        <div class="product-view">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-view-top">
                            <div class="col-md-5">
                                <button class="Vous_Voulez">Filtres</button>
                            </div>
                            <br /><br />
                            <form action="{{ route('chercher', ['id' => $data->id]) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="product-short">
                                            <div class="input-group">
                                                <span class="input-group-text" name="categorie"
                                                    id="basic-addon3">Categorie</span>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="categorie">
                                                    <div class="dropdown">
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <option selected disabled>Catégorie</option>
                                                            <option value="sport">Sport</option>
                                                            <option value="electronique">Electronique</option>
                                                            <option value="articles_maison">Articles maison</option>
                                                            <option value="vetements_accessoires">Vetements et
                                                                Accessoires</option>
                                                            <option value="instruments">Instruments</option>
                                                            <option value="livres_medias">Livres et medias</option>
                                                        </div>
                                                    </div>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="product-search">
                                            <div class="input-group">
                                                <div class="form-floating mb-3">
                                                    <input type="text" id="floatingInput" placeholder="Ville"
                                                        name="ville" class="form-control">
                                                    <label for="floatingInput">Ville</label>
                                                </div>

                                                <div class="input-group-text">
                                                    <i class="fa fa-building"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    


                                    <div class="col-md-4">
                                        <div class="product-search">
                                            <div class="input-group">
                                                <span class="input-group-text" name="prix" id="basic-addon3">Prix (en
                                                    DH)</span>
                                                <select class="form-select" name="prix[]"
                                                    aria-label="Default select example">
                                                    <div class="dropdown">
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <option selected disabled>Prix</option>
                                                            <option value="20.000 50.000">20-50 (DH)</option>
                                                            <option value="50.000 100.000">50-100 (DH)</option>
                                                            <option value="100.000 500.000">100-500 (DH)</option>
                                                        </div>
                                                    </div>
                                                </select>


                                            </div>
                                        </div>
                                    </div>
                                    <br /><br /><br /> <br><br />

                                

                                   
                                </div>


                                    <div class="date">
                                    <div class="col-md-4">
                                        <div class="product-search">
                                            <div class="input-group">
                                                <span class="input-group-text" name="note" id="basic-addon3">Sur 5</span>
                                                <select class="form-select" name="note[]"
                                                    aria-label="Default select example">
                                                    <div class="dropdown">
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <option selected disabled>Note</option>
                                                            <option value="4.000 5.000">4 -> 5 </option>
                                                            <option value="3.000 4.000">3 -> 4 </option>
                                                            <option value="0.000 2.000">0 -> 2 </option>
                                                        </div>
                                                    </div>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-md-1" style="margin-left:20px;"></div>
                                De: &nbsp &nbsp
                                <div class="col-md-2">
                                    <div class="product-date">
                                        <input type="date" id="dateDebut" name="dateDebut" class="dateDebut" />
                                    </div>
                                </div>
                                <br><br>

                                <div class="col-md-1"></div>

                                À: &nbsp &nbsp
                                <div class="col-md-2">
                                    <div class="product-date">
                                        <input type="date" id="dateFin" name="dateFin" class="dateFin" />
                                    </div>
                                </div>
</div>


                                <br /><br /><br />

                                <div class="text-center">
                                    <button>
                                        <i class="fa fa-trash"></i> Effacer
                                    </button>
                                    <button type="submit" class="input-submit">
                                        Recherche
                                    </button>
                                </div>
                            </form>
                        </div>
                        <br /><br /><br />
                    </div>
                    <div class="titre">
                        <hr>
                        <h2>Articles</h2>
                        <hr>
                    </div>




                    @if (count($annonce_display) > 0)
                        @foreach ($annonce_display as $annonce)
                            <div class="col-md-4">
                                <div class="product-item">
                                    <p> {{ \Carbon\Carbon::parse($annonce->created_at)->diffForHumans() }}</p>
                                    <div class="product-title">
                                        <a
                                            href="{{ route('detail', ['id' => $annonce->id]) }}">{{ $annonce->titre }}</a>
                                        <br><br><div class="ratting">
                                       
                                            @php
                                            if(isset($annonce->moyenne)){
                                                $integerPart_1 = floor($annonce->moyenne); // Extract the integer part of the average rating
                                                $decimalPart_1 = $annonce->moyenne - $integerPart_1;
                                            }else{
                                                $integerPart_1 = 0; // Extract the integer part of the average rating
                                                $decimalPart_1 =0;
                                            }
                                            @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $integerPart_1)
                                                <span><i class="fas fa-star"></i></span>
                                            @elseif($i - 1 == $integerPart_1)
                                                @if ($decimalPart_1 > 0.5)
                                                    <span><i class="fas fa-star"></i></span>
                                                    @php $decimalPart_1  = 0; @endphp
                                                @elseif($decimalPart_1 == 0.5)
                                                    <span style="position: relative; display: inline-block;">
                                                        <i class="fas fa-star" style="color: #708090;"></i>
                                                        <span
                                                            style="position: absolute; top: 0; left: 0; width: 50%; overflow: hidden;">
                                                            <i class="fas fa-star"></i>
                                                        </span>
                                                    </span>
                                                    @php $decimalPart_1  = 0; @endphp
                                                @else
                                                    <span><i class="fas fa-star" style="color:#708090;"></i></span>
                                                @endif
                                            @else
                                                <span><i class="fas fa-star" style="color:#708090;"></i></span>
                                            @endif
                                        @endfor
                                        </div>
                                    </div>
                                    <div class="product-image">
                                        <a href="#">
                                            <img src="{{ asset('images/annonces/' . (file_exists(public_path('images/annonces/' . $annonce->image1)) ? $annonce->image1 : 'no-image-available.jpeg')) }}"
                                                width=130 height=130 alt="Product Image">

                                        </a>
                                        <div class="product-action">
                                            <button
                                                onclick="showModal('{{ asset('images/annonces/' . (file_exists(public_path('images/annonces/' . $annonce->image1)) ? $annonce->image1 : 'no-image-available.jpeg')) }}')"><i
                                                    class="fa fa-search-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        <div class="prixVille">
                                    {{ $annonce->ville }},<h3>&nbsp{{ $annonce->prix }}<span>DH</span></h3></div>
                                    <div class="plus">
                                        <a class="btn" href="{{ route('detail', ['id' => $annonce->id]) }}"><i
                                                class="fa fa-plus-circle"></i>Lire plus</a>
                                    </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @elseif (!is_null($annonce_display) && count($annonce_display) > 0)
                        @foreach ($annonce_display as $annonce)
                            <div class="product-item">
                                <p> {{ \Carbon\Carbon::parse($annonce->created_at)->diffForHumans() }}</p>
                                <div class="product-title">
                                    <a href="#">{{ $annonce->titre }}</a>
                                    <div class="ratting">
                                    @php
                                            $integerPart_1 = floor($annonce->moyenne); // Extract the integer part of the average rating
                                            $decimalPart_1 = $annonce->moyenne - $integerPart_1;
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $integerPart_1)
                                                <span><i class="fas fa-star"></i></span>
                                            @elseif($i - 1 == $integerPart_1)
                                                @if ($decimalPart_1 > 0.5)
                                                    <span><i class="fas fa-star"></i></span>
                                                    @php $decimalPart_1  = 0; @endphp
                                                @elseif($decimalPart_1 == 0.5)
                                                    <span style="position: relative; display: inline-block;">
                                                        <i class="fas fa-star" style="color: #708090;"></i>
                                                        <span
                                                            style="position: absolute; top: 0; left: 0; width: 50%; overflow: hidden;">
                                                            <i class="fas fa-star"></i>
                                                        </span>
                                                    </span>
                                                    @php $decimalPart_1  = 0; @endphp
                                                @else
                                                    <span><i class="fas fa-star" style="color:#708090;"></i></span>
                                                @endif
                                            @else
                                                <span><i class="fas fa-star" style="color:#708090;"></i></span>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <div class="product-image">
                                    <a href="#">
                                        <img src="{{ asset('images/annonces/' . (file_exists(public_path('images/annonces/' . $annonce->image1)) ? $annonce->image1 : 'no-image-available.jpeg')) }}"
                                            width=130 height=130 alt="Product Image">

                                    </a>
                                    <div class="product-action">
                                        <button
                                            onclick="showModal('{{ asset('images/annonces/' . (file_exists(public_path('images/annonces/' . $annonce->image1)) ? $annonce->image1 : 'no-image-available.jpeg')) }}')"><i
                                                class="fa fa-search-plus"></i></button>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <h3><span>Ville:</span>{{ $annonce->ville }}<span>DH</span>{{ $annonce->prix }}
                                    </h3>
                                </div>

                            </div>
                </div>
                @endforeach
            @else
                <h1 style="justify-content:center;" class="display-1">pas d'annonces pour l'instant</h1>
                @endif
            </div>
            <!-- Pagination Start -->
            <div class="col-md-12">
                <br /><br />
<!--
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"><i
                                    class="fas fa-chevron-left"></i></a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>-->
                <br /><br />
            </div>
            <!-- Pagination Start -->
        </div>
        </div>
    </center>
    <!-- Product List End -->

    <!-- Footer -->
    @include('footer')
    <!-- JAVASCRIPT FILES -->
    <script src="{{ url('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('js/script.js') }}"></script>

    <div id="modal" class="modal">
        <div class="modal-content1">
            <span class="close" onclick="hideModal()">&times;</span>
            <img id="modal-img" class="modal-img" src="" alt="Product Image" />
            <!-- Image à afficher dans la fenêtre modale -->
        </div>
    </div>







    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="path/to/font-awesome.min.css">
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/slick/slick.min.js"></script>


    <!-- Template Javascript -->
    <script src="{{ url('js/main.js') }}"></script>
    <script src="{{ url('js/zoom.js') }}"></script>
    <!-- JAVASCRIPT FILES -->
    <script src="{{ url('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('js/script.js') }}"></script>



</body>

</html>
