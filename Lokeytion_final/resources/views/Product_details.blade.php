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

    <title>Details</title>
    <link rel="stylesheet" href="{{ url('css/styleDetails.css') }}">
</head>

<body>



<br><br>
@if($annonce_objet->id_user != session('loginID'))
<center>
<a href="{{ route('proprietaire_profil', ['id' => $annonce_objet->id_user]) }}" class="proprietaire">

<div  class="proprietaire">
         <div class="proprietaire-img">
            <img src="{{ asset('images/users/' . (file_exists(public_path('images/users/' . $annonce_objet->photo)) ? $annonce_objet->photo : 'anonym.jpg')) }}"
            style="width:5rem; height:5rem; border-radius:50%;" alt="">
      </div>
     <p>Annonce de :<br><b> {{$annonce_objet->nom}} {{$annonce_objet->prenom}}</b></p>
                                
 </div>
</a>
</center>
@endif
<!--CONTENT-->
    <div class="cont">
       
        <div class="box">
       
            <!--IMAGES-->
            <div class="images">
                <div class="img-holder active">
                    <img src="../images/annonces/{{ $annonce_objet->image1 }}" alt="" onclick="showImg(this.src)" />
                </div>
                <div class="img-holder">
                    <img src="../images/annonces/{{ $annonce_objet->image2 }}" alt="" onclick="showImg(this.src)" />
                </div>
                <div class="img-holder">
                    <img src="../images/annonces/{{ $annonce_objet->image3 }}" alt="" onclick="showImg(this.src)" />
                </div>
            </div>

            <!--RATES-->
            <div class="basic-info">
                <h1>{{ $annonce_objet->titre }}</h1>
                @php
                    $somme = 0;
                    $nbr = 0;
                    $integerPart = 0;
                    $decimalPart = 0;
                    if (isset($commentaires)) {
                        foreach ($commentaires as $commentaire) {
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
                <h3>Prix: <span>{{ $annonce_objet->prix }}DH/h</span></h3>
                @if (session('successl'))
                    <div class="alert alert-success">
                        {{ session('successl') }}
                    </div>
                @endif

                @if (session('successP'))
                    <div class="alert alert-success">
                        {{ session('successP') }}
                    </div>
                @endif

                @error('dateRange')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @if (session('nbr_jrs'))
                    <div class="alert alert-danger">{{session('nbr_jrs')}}</div>
                @enderror

                <div class="options">
                @if(session('loginID') == 100)
                <button  @if(strcmp($annonce_objet->status,'active,bloquer')==0 || strcmp($annonce_objet->status,'archive,bloquer')==0) disabled @endif class="btn btn-danger mb-2 align-self-center text-white"  style="background-color:red;"><a href="{{route('administrateur.bloquer_annonce',['id_annonce'=>$annonce_objet->id])}}" class="text-decoration-none text-white" >Bloquer</a></button>
                <button  @if(strcmp($annonce_objet->status,'active')==0 || strcmp($annonce_objet->status,'archive')==0) disabled @endif class="btn btn-success mb-2 align-self-center text-white" style="background-color:green;"><a href="{{route('administrateur.débloquer_annonce',['id_annonce'=>$annonce_objet->id])}}" class="text-decoration-none text-white">Débloquer</a></button>

                @else
                   @if($annonce_objet->id_user == session('loginID'))
                   <a class="btn" href="{{ route('editAnnonces1', ['id' =>$annonce_objet->id]) }}">
                    <i class="fas fa-edit"></i>Modifier
                </a> 
                <a class="btn mx-2" href="#"
                                            onclick="event.preventDefault();
        if (confirm('Vous etes sur?')) {
            document.getElementById('status-form-{{ $annonce_objet->id }}').submit();
        }">
                                            <i class="fas fa-trash-alt"></i>Supprimer
                                        </a>
                    @else
                    <form id="louer-form" method="POST" action="{{ route('louer', ['id' => $annonce_objet->id]) }}">
    @csrf
    <button type="button" id="louer-btn" data-bs-toggle="modal" data-bs-target="#myModal">Louer</button>
    <br><br>
    <button type="submit" name="panier"> Ajouter au panier
        <span><i class="fa-solid fa-cart-plus"></i></span></button>


<!-- Popup box for terms and conditions -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog my-modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel" style="color: white !important">Terms & Conditions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="display : block !important">
      <p>Tous nos articles de location et services sont fournis selon les termes et conditions de location suivants, auxquels tous les clients sont tenus de consentir :</p>
<ul>
<li>Le client reconnaît qu'il ou elle, ou son représentant, a eu l'occasion d'inspecter personnellement l'équipement et le trouve adapté à ses besoins et en bon état et qu'il ou elle comprend son utilisation appropriée. Le client reconnaît en outre sa responsabilité d'inspecter l'équipement avant son utilisation et de notifier la société de location de tout défaut.</li>
<li>Si l'équipement devient dangereux ou hors d'état de fonctionner en raison d'une utilisation normale, le client accepte de cesser l'utilisation et de notifier la société de location qui remplacera l'équipement par un équipement similaire en bon état de marche, si disponible. La société de location n'est pas responsable des dommages accessoires ou consécutifs causés par des retards de livraison ou toute forme d'interruption de service.</li>
<li>Il n'y a aucune garantie de qualité marchande ou de fitness, définie expressément ou implicite, et aucune garantie que l'équipement de location est adapté à l'utilisation prévue par le client, ou qu'il est exempt de défauts.</li>
<li>Le client accepte de prendre le risque et de dégager la société de location de toute responsabilité pour les dommages matériels et les blessures corporelles causés par l'équipement, le résultat de conditions météorologiques défavorables, ou le résultat de la négligence de la part du client.</li>
<li>L'utilisation de l'équipement de location dans les circonstances suivantes est interdite et constitue une violation de ce contrat : Utilisation à des fins illégales ou de manière illégale; utilisation lorsque l'équipement est en mauvais état ou est dangereux; utilisation inappropriée ou non intentionnelle ou mauvaise utilisation; utilisation par toute personne autre que le client, ou ses employés, sans la permission écrite de la société de location; utilisation à tout autre endroit que l'adresse fournie par le client sans la permission écrite de la société de location.</li>
<li>La société de location peut céder ses droits en vertu de ce contrat sans le consentement du client, mais demeurera liée par toutes les obligations qui y sont stipulées. Le client ne peut pas sous-louer ou prêter l'équipement sans la permission écrite de la société de location. Toute prétendue cession par le client est nulle.</li>
<li>Le droit de possession du client prend fin à l'expiration de la période de location et la conservation de la possession après cette période constitue une violation substantielle de ce contrat et engendrera des frais supplémentaires. Toute prolongation doit être convenue mutuellement par écrit.</li>
    </ul>
    <label><input type="checkbox" id="accept-terms" > I accept the terms and conditions</label>
    <br><br>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button id="submit-louer" type="submit" class="btn btn-primary" name="louer">Louer</button>
      </div>
    </div>
  </div>
</div>

<script>
    // Get the "Louer" button and the popup box
    const louerBtn = document.getElementById('louer-btn');
    const popup = document.getElementById('myModal');
    
    // When the "Louer" button is clicked, show the popup
    louerBtn.addEventListener('click', () => {
        popup.style.display = 'block';
    });
    
    // When the "Cancel" button is clicked, hide the popup
    const cancelBtn = document.querySelector('.btn-close');
    cancelBtn.addEventListener('click', () => {
        popup.style.display = 'none';
    });
    
    // When the "Louer" button inside the popup is clicked, check if the user has accepted the terms and conditions
    const submitBtn = document.getElementById('submit-louer');
    submitBtn.addEventListener('click', () => {
        const acceptTerms = document.getElementById('accept-terms').checked;
        if (acceptTerms) {
            // If the user has accepted the terms and conditions, submit the form
            const form = document.getElementById('louer-form');
            form.submit();
        } else {
            // If the user has not accepted the terms and conditions, display an error message
            event.preventDefault();
            alert('Please accept the terms and conditions to continue.');
        }
    });
</script>

@endif
@endif
                </div>
            </div>


            <!--DESCRIPTION-->
            <div class="description">
                <h3>Description</h3>
                <p>
                    {{ $annonce_objet->discription }}
                </p>
                <!-- Affichage des jours dispo -->

                <div class="disponibilite">
                    <h3>Disponibilité:</h3>
                    <div class="dispo">
                        <div class="select-wrapper">
                            <div class="jour">
                                <div class="form-group">
                                    <input type="text" id="dateRange" name="dateRange" class="form-control"
                                        data-min-date="{{ $annonce_objet->de < date('Y-m-d') ? date('Y-m-d') : $annonce_objet->de }}"
                                        data-max-date="{{ $annonce_objet->a }}"
                                        placeholder="Y-m-d, Y-m-d, Y-m-d, Y-m-d, " required>
                                </div>
                                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>




                                <script>
                                    // Get the minDate and maxDate from the input's data attributes
                                    const input = document.querySelector("#dateRange");
                                    // Convertir la chaîne de jours stockée dans la base de données en un tableau de jours
                                    let joursDispo = "{{ $annonce_objet->joursDispo }}".split(',');

                                    // Map les jours en nombres pour correspondre à la méthode getDay() de Javascript
                                    joursDispo = joursDispo.map(jour => {
                                        switch (jour) {
                                            case 'Lundi':
                                                return 1;
                                            case 'Mardi':
                                                return 2;
                                            case 'Mercredi':
                                                return 3;
                                            case 'Jeudi':
                                                return 4;
                                            case 'Vendredi':
                                                return 5;
                                            case 'Samedi':
                                                return 6;
                                            case 'Dimanche':
                                                return 0;
                                            default:
                                                return -1;
                                        }
                                    });

                                    // Supprimer les jours invalides (-1) du tableau
                                    joursDispo = joursDispo.filter(jour => jour !== -1);

                                    // Initialize Flatpickr
                                    flatpickr("#dateRange", {
                                        mode: "multiple",
                                        minDate: "{{ $annonce_objet->de < date('Y-m-d') ? date('Y-m-d') : $annonce_objet->de }}",
                                        maxDate: "{{ $annonce_objet->a }}",
                                        dateFormat: "Y-m-d",
                                        locale: "fr",
                                        disable: [
                                            @if (isset($datesDemandes))
                                                @foreach ($datesDemandes as $demande)
                                                    "{{ $demande }}",
                                                @endforeach
                                            @endif
                                            function(date) {
                                                // Disable days not in joursDispo
                                                return !joursDispo.includes(date.getDay());
                                            }
                                        ]
                                    });
                                </script>

                                <div class="select-wrapper">
                                    @error('jours')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                            </div>

                        </div>

                    </div>
                </div>
            </div>
            </form>

            <!--COMMENTS-->
            <div class="comments">
                <div class="inner">
                    <!-- Affichage des commentaires -->
                    @if (isset($commentaires))
                        <h1>Commentaires</h1>
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
                            $count_pos = $commentaires->where('likes', 1)->count();
                            $count_neg = $commentaires->where('likes', 0)->count();
                            $count_comment = $commentaires->count();

                        @endphp
                        <div class="comment all">

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
                            @foreach ($commentaires as $commentaire)
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
                @foreach ($commentaires as $commentaire)
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
            @foreach ($commentaires as $commentaire)
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
<!-- JAVASCRIPT FILES -->
<script src="{{ url('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('js/script.js') }}"></script>
    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/user/repo/file.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ url('js/depotAnnonce.js') }}"></script>
    <script src="{{ asset('js/my-flatpickr.js') }}"></script>
    @include('footer')
</body>

</html>
