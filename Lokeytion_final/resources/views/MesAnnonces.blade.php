@include('navbar', ['nbr_notification' => $nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Mes Annonces</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ url('css/swiper-bundle.min.css') }}" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


    <!-- Template Stylesheet -->
    <link href="{{ url('css/AnnoncesStyle.css') }}" rel="stylesheet" />
</head>

<body>



    <!-- Product List Start -->
    <center>
        <div class="product-view">
            <div class="container-fluid">
                <div class="row">

                    <div class="titre">
                        <hr>
                        <h2>Mes annonces</h2>
                        <hr>
                    </div>


                    @if(session('deleted'))
    <div class="alert alert-success">
        {{ session('deleted') }}
    </div>
@endif


                    @if (count($annonce_display) > 0)
                        @foreach ($annonce_display as $annonce)
                            <div class="col-md-4">
                                <div class="product-item">
                                    <p> {{ \Carbon\Carbon::parse($annonce->created_at)->diffForHumans() }}</p>
                                    <div class="product-title">
                                        <a href="#">{{ $annonce->titre }}</a><br><br>
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
                                                onclick="showModal('{{ asset('images/annonces/' . (file_exists(public_path('images/annonces/' . $annonce->image1)) ? $annonce->image1 : 'no-image-available.jprg')) }}')"><i
                                                    class="fa fa-search-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="product-price">
                                    <div class="prixVille">
                                    {{ $annonce->ville }},<h3>&nbsp{{ $annonce->prix }}<span>DH</span></h3></div>
                                    &nbsp &nbsp &nbsp &nbsp <a class="btn" href="{{ route('editAnnonces1', ['id' => $annonce->id]) }}">
                                            <i class="fas fa-edit"></i></a>   
                                    <a class="btn mx-2" href="#"
                                            onclick="event.preventDefault();
        if (confirm('Vous etes sur?')) {
            document.getElementById('status-form-{{ $annonce->id }}').submit();
        }">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <form id="status-form-{{ $annonce->id }}"
      action="{{ route('destroy', ['id' => $annonce->id]) }}"
      method="POST"
      style="display: none;">

                                            @csrf
                                            @method('DELETE')
                                        </form>

                                      


                                        

                                        <a class="btn" href="{{ route('detail', ['id' => $annonce->id]) }}"><i
                                                class="fa fa-plus-circle"></i></a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @else
                        <h1 class="display-1">pas d'annonces pour l'instant</h1>
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
    <script src="{{ url('lib/easing/easing.min.js') }}"></script>
    <script src="{{ url('lib/slick/slick.min.js') }}"></script>


    <!-- Template Javascript -->
    <script src="{{ url('js/main.js') }}"></script>
    <script src="{{ url('js/zoom.js') }}"></script>

    @include('footer')
</body>

</html>
