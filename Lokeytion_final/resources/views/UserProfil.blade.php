@include('navbar', ['nbr_notification' => $nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/c3b8d3700c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ url('css/swiper-bundle.min.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <title>{{$user->nom}} {{$user->prenom}}</title>
    <link rel="stylesheet" href="{{ url('css/profil_comments.css') }}">
</head>

<body>



<!--CONTENT-->
    <div class="cont">

                            
        <div class="box">
            <!--IMAGES-->
            <div class="proprietaire">
                <img src="{{ asset('images/users/' . (file_exists(public_path('images/users/' . $user->photo)) ? $user->photo : 'anonym.jpg')) }}"
                     style="width:5rem; height:5rem; border-radius:50%;" alt="">
                <p><b> {{$user->nom}} {{$user->prenom}}</b></p>                                       
</div>

            <!--RATES-->
            <div class="basic-info">
                @php
                    $somme = 0;
                    $nbr = 0;
                    $integerPart = 0;
                    $decimalPart = 0;
                    if (isset($commentaires_cl)) {
                        foreach ($commentaires_cl as $commentaire) {
                            $somme += $commentaire->note;
                            $nbr++;
                        }
                        $moyenne = $nbr > 0 ? $somme / $nbr : 0;
                        $integerPart = floor($moyenne); // Extract the integer part of the average rating
                        $decimalPart = $moyenne - $integerPart;
                    }
                @endphp
                <div class="product-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $integerPart)
                            <span><i class="fas fa-star"></i></span>
                        @elseif($i - 1 == $integerPart)
                            @if ($decimalPart > 0.5)
                                <span><i class="fas fa-star"></i></span>
                                @php $decimalPart = 0; @endphp
                            @elseif($decimalPart == 0.5)
                                <span style="position: relative; display: inline-block;">
                                    <i class="fas fa-star" style="color: #404040;"></i>
                                    <span style="position: absolute; top: 0; left: 0; width: 50%; overflow: hidden;">
                                        <i class="fas fa-star"></i>
                                    </span>
                                </span>
                                @php $decimalPart = 0; @endphp
                            @else
                                <span><i class="fas fa-star" style="color:#404040;"></i></span>
                            @endif
                        @else
                            <span><i class="fas fa-star" style="color: #404040;"></i></span>
                        @endif
                    @endfor
                    <span>({{ $nbr }} notes)</span>
                </div>
              
              
            </div>


            </form>

            <!--COMMENTS-->
            <div class="comments">
                <div class="inner">
                    <!-- Affichage des commentaires -->
                    @if (isset($commentaires_cl))
                        <h1>Commentaires en tant que Client</h1><a href="{{ route('MePartenaire') }}"  >En tant que partenaire</a>

                        <div class="border"></div>
                        <br>
                        <button type="button" class="btn btn-default btn-all">
                            <i class="fas fa-comments"></i> Tous les commentaires
                        </button>

                        <button type="button" class="btn btn-default btn-positive">
                            <i class="fas fa-thumbs-up"></i> Commentaires positifs
                        </button>

                        <button type="button" class="btn btn-default btn-negative">
                            <i class="fas fa-thumbs-down"></i> Commentaires négatifs
                        </button>
                        @php
                            $count_pos = $commentaires_cl->where('likes', 1)->count();
                            $count_neg = $commentaires_cl->where('likes', 0)->count();
                            $count_comment = $commentaires_cl->count();

                        @endphp
                        <div class="comment all">
                        @if ($count_comment > 0)
                            @if ($count_comment == 1)
                                <div class="container1">
                                    <div class="row1">
                                        <div class="com1">
                                            <center>
                                            @else
                                                <div class="container1 swiper">
                                                    <div class="row">
                                                        <div class="com swiper-wrapper">
                            @endif
                            @foreach ($commentaires_cl as $commentaire)
                                <div class="col-md-2 swiper-slide">
                                    <img src="../images/users/{{ $commentaire->photo }}" alt="" />
                                    <div class="name">{{ $commentaire->prenom }} {{ $commentaire->nom }}</div>
                                    <div class="stars">
                                        @php
                                            $integerPart_1 = floor($commentaire->note); // Extract the integer part of the average rating
                                            $decimalPart_1 = $commentaire->note - $integerPart_1;
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
                                                        <i class="fas fa-star" style="color: #404040;"></i>
                                                        <span
                                                            style="position: absolute; top: 0; left: 0; width: 50%; overflow: hidden;">
                                                            <i class="fas fa-star"></i>
                                                        </span>
                                                    </span>
                                                    @php $decimalPart_1  = 0; @endphp
                                                @else
                                                    <span><i class="fas fa-star" style="color:#404040;"></i></span>
                                                @endif
                                            @else
                                                <span><i class="fas fa-star" style="color: #404040;"></i></span>
                                            @endif
                                        @endfor

                                    </div>
                                    <p>
                                        {{ $commentaire->comment }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                </div>
                @if ($count_comment != 1)
                    <div class="swiper-button-next swiper-navBtn"></div>
                    <div class="swiper-button-prev swiper-navBtn"></div>
                    <div class="swiper-pagination"></div>
                @endif
            </div>

            @else
    <br><br>
    <p>Pas de commentaires pour l'instant </p>
    @endif

        </div>

        <div class="comment positive">
            @if ($count_pos > 0)

                @if ($count_pos == 1)
                    <div class="container1">
                        <div class="row1">
                            <div class="com1">
                                <center>
                                @else
                                    <div class="container1 swiper">
                                        <div class="row">
                                            <div class="com swiper-wrapper">
                @endif
                @foreach ($commentaires_cl as $commentaire)
                    @if ($commentaire->likes == 1)
                        <div class="col-md-2 swiper-slide">
                            <img src="../images/users/{{ $commentaire->photo }}" alt="" />
                            <div class="name">{{ $commentaire->prenom }} {{ $commentaire->nom }}</div>
                            <div class="stars">
                                @php
                                    $integerPart_1 = floor($commentaire->note); // Extract the integer part of the average rating
                                    $decimalPart_1 = $commentaire->note - $integerPart_1;
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
                                                <i class="fas fa-star" style="color: #404040;"></i>
                                                <span
                                                    style="position: absolute; top: 0; left: 0; width: 50%; overflow: hidden;">
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            </span>
                                            @php $decimalPart_1  = 0; @endphp
                                        @else
                                            <span><i class="fas fa-star" style="color:#404040;"></i></span>
                                        @endif
                                    @else
                                        <span><i class="fas fa-star" style="color: #404040;"></i></span>
                                    @endif
                                @endfor
                            </div>
                            <p>
                                {{ $commentaire->comment }}
                            </p>
                        </div>
                    @endif
                @endforeach
        </div>
    </div>
    @if ($count_pos != 1)
        <div class="swiper-button-next swiper-navBtn"></div>
        <div class="swiper-button-prev swiper-navBtn"></div>
        <div class="swiper-pagination"></div>
    @endif
    </div>
@else
    <br><br>
    <p>Pas de commentaires positifs</p>
    @endif
    </div>

    <div class="comment negative">



        @if ($count_neg > 0)
            @if ($count_neg == 1)
                <div class="container1">
                    <div class="row1">
                        <div class="com1">
                            <center>
                            @else
                                <div class="container1 swiper">
                                    <div class="row">
                                        <div class="com swiper-wrapper">
            @endif
            @foreach ($commentaires_cl as $commentaire)
                @if ($commentaire->likes == 0)
                    @if ($count_neg == 1)
                        <div class="col-md-2">
                        @else
                            <div class="col-md-2 swiper-slide">
                    @endif
                    <img src="../images/users/{{ $commentaire->photo }}" alt="" />
                    <div class="name">{{ $commentaire->prenom }} {{ $commentaire->nom }}</div>
                    <div class="stars">
                        @php
                            $integerPart_1 = floor($commentaire->note); // Extract the integer part of the average rating
                            $decimalPart_1 = $commentaire->note - $integerPart_1;
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
                                        <i class="fas fa-star" style="color: #404040;"></i>
                                        <span
                                            style="position: absolute; top: 0; left: 0; width: 50%; overflow: hidden;">
                                            <i class="fas fa-star"></i>
                                        </span>
                                    </span>
                                    @php $decimalPart_1  = 0; @endphp
                                @else
                                    <span><i class="fas fa-star" style="color:#404040;"></i></span>
                                @endif
                            @else
                                <span><i class="fas fa-star" style="color: #404040;"></i></span>
                            @endif
                        @endfor

                    </div>
                    <p>
                        {{ $commentaire->comment }}
                    </p>
    </div>
    @endif
    @endforeach
    </div>


    </div>
    @if ($count_neg != 1)
        <div class="swiper-button-next swiper-navBtn"></div>
        <div class="swiper-button-prev swiper-navBtn"></div>
        <div class="swiper-pagination"></div>
    @endif

    </div>
@else
    <br><br>
    <p>Pas de commentaires Negatifs</p>
    @endif

    </div>

    @endif

    </div>
    </div>

    </div>
    </div>
    


    </div>
    <br><br>
    <!-- Footer -->

    <!-- JAVASCRIPT FILES -->
    <script src="{{ url('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('js/script.js') }}"></script>

    <script>
        // Récupérer les boutons et les div correspondantes
        const btnAll = document.querySelector('.btn-all');
        const btnPositive = document.querySelector('.btn-positive');
        const btnNegative = document.querySelector('.btn-negative');

        const divAll = document.querySelector('.comment.all');
        const divPositive = document.querySelector('.comment.positive');
        const divNegative = document.querySelector('.comment.negative');

        // Fonction pour afficher la div correspondante et cacher les autres div
        function showDiv(divToShow, btnToShow) {
            divToShow.classList.add('active');
            btnToShow.classList.add('active');

            [divAll, divPositive, divNegative].forEach(div => {
                if (div !== divToShow) {
                    div.classList.remove('active');
                }
            });

            [btnAll, btnPositive, btnNegative].forEach(btn => {
                if (btn !== btnToShow) {
                    btn.classList.remove('active');
                }
            });
        }

        // Ajouter un événement de clic à chaque bouton pour afficher la div correspondante
        btnAll.addEventListener('click', () => showDiv(divAll, btnAll));
        btnPositive.addEventListener('click', () => showDiv(divPositive, btnPositive));
        btnNegative.addEventListener('click', () => showDiv(divNegative, btnNegative));

        // Afficher la div "Tous les commentaires" et le bouton correspondant au chargement de la page
        showDiv(divAll, btnAll);
    </script>

   
    @include('footer')
</body>

</html>
