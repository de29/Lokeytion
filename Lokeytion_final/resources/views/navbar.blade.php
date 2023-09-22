<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/c3b8d3700c.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="{{ url('css/navbar.css') }}" />
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-7Ou+nt9jS7WjiZh8A/Xy7b+Ow1/lj4MHHeibg1DkZrbH3j+smo7T+bTJvGzxxjcaI0TFUz+8Q+UZ7vU/yfSgcQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/all.min.js" integrity="sha512-ohktEd/qP+ftMJtBQxr1hyGL+yXjHakW0PTy1+h3c3/M+3PBrF5SZJjvO5AD5QR5r5bCxQsh1F7vJTDaYfD68A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>LoKeytion</title>
</head>

<body>
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg ">
        <div class="container d-flex justify-content-between">
            <div class="logo">
                <img src="{{ url('images/logo1.jpg') }}" alt="">
            </div>
            <nav class="navbar2 navbar-expand-lg ">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            
                            @if(Session::get('loginID') == 100)
                            <style>
                                .navbar-expand-lg .navbar-nav {
                                      margin-left: -20%;
                                    }
                            </style>
                             <li class="nav-item nav-items">
                                <a class="nav-link nav-links"
                                    href="{{route('administrateur.listeUsers',Session::get('loginID'))}}">Utilisateurs</a>
                            </li>

                            <li class="nav-item nav-items">
                                <a class="nav-link nav-links"
                                    href="{{ route('annonces', Session::get('loginID')) }}">Accueil</a>
                            </li>
                           
                           
                            <li class="nav-item nav-items">
                                <a class="nav-link nav-links"
                                href="{{route('administrateur.dashboard')}}">Tableau de bord</a>
                            </li>
                            @else
                            <li class="nav-item nav-items">
                                <a class="nav-link nav-links" ria-current="page"
                                    href="{{ route('mesObjets', Session::get('loginID')) }}">
                                    Mes Objets
                                </a>
                            </li>
                            <li class="nav-item nav-items">
                                <a class="nav-link nav-links"
                                    href="{{ route('annonces', Session::get('loginID')) }}">Accueil</a>
                            </li>
                            <li class="nav-item nav-items">
                                <a class="nav-link nav-links"
                                    href="{{ route('depotObjet')}}">Ajouter un objet</a>
                            </li>
                        @endif

                        </ul>

                        @if(Session::get('loginID') != 100)
                        <div class="position-relative " >

                            <a href="#" class="text-decoration-none text-dark">
  @if(isset($nbr_notification))
    <span class="badge" id="notification-badge">{{ $nbr_notification }}</span>
    <i class="fa-solid fa-bell nav-icon"></i>
  @else
    <span class="badge" id="notification-badge">0</span>
    <i class="fa-solid fa-bell nav-icon"></i>
    
  @endif
</a>

<div class="notification-list" id="notification-wrapper" style="display:none;">
  <ul>
  @foreach($notification_navbar as $notification)
    <li>
        <img src="../images/annonces/{{$notification->image1}}" class="notification-img">
        <div class="notification-text">
            <div class="notification-info">{{$notification->created_at}} </div>
            <div class="notification-info">Objet : {{$notification->nom}}</div>
            <div class="notification-msg">{{ $notification->msg }}.</div>
        </div>
        <hr>
    </li>
  @endforeach
</ul>
</div>

<script>
  var notificationBadge = document.getElementById('notification-badge');
  var notificationList = document.querySelector('.notification-list');

  notificationBadge.addEventListener('click', function(event) {
    event.preventDefault();
      if (notificationList.style.display === 'none') {
        if (parseInt(notificationBadge.textContent) > 0) {

        notificationList.style.display = 'block';
        $.ajax({
          url: '{{ route('updateNotifications') }}',
          type: 'GET',
          success: function(data) {
            // Update the notification badge count
            $('#notification-badge').text('0');
          },
          error: function(xhr, status, error) {
            console.log(error);
          }
        }); }
      } else {
        notificationList.style.display = 'none';
      }
   
  });
</script>

<!--
                            <a href="" class="text-decoration-none text-dark">
                            <span class="badge">0</span>
                                <i class="fa-solid fa-envelope nav-icon"></i>
                            </a>-->

                            <a href="{{ route('showPanier') }}" class="text-decoration-none text-dark">
                               
                            @if(isset($nbr_panier))
                            <span class="badge">{{$nbr_panier}}</span> 
                                                        @else
                            <span class="badge">0</span>
                               @endif
                            <i class="fa-solid fa-cart-arrow-down nav-icon"></i>
                            </a>
               
                        </div>
                        @endif

                        <!--PROFILE DROPDOWN-->
                        <div class="profile-dropdown">
                            <div onclick="toggle()" class="profile-dropdown-btn">
                                <div class="profile-img">
                                    <img src="{{ asset('images/users/' . (file_exists(public_path('images/users/' . Session::get('photo'))) ? Session::get('photo') : 'anonym.jpg')) }}"
                                        width="50rem" height="50rem" alt="">

                                    <i class="fa-solid fa-circle"></i>
                                </div>
                                <p>{{ Session::get('prenom') }}</p>
                                <span>
                                    <i class="fa-solid fa-angle-down"></i>
                                </span>
                            </div>
                            <ul class="profile-dropdown-list">
                            <li class="profile-dropdown-list-item">                                    
       
       <a href="{{ route('UserProfil') }}"  >
           <i class="fa-regular fa-user"></i>
           Mon Profile
       </a>
   </li>
                                <li class="profile-dropdown-list-item">
                                    <!--
                  <button type="button" class="boutton" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-regular fa-user"></i>
                    Modifier Profile
                  </button>
-->
                                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa-regular fa-user"></i>
                                        Modifier Profile
                                    </a>
                                </li>
                                
                                @if(Session::get('loginID') != 100)
                                <li class="profile-dropdown-list-item">
                                    <a href="{{ route('Demande.show') }}">
                                        <i class="fas fa-id-badge"></i> <!-- icône de badge d'identité solide -->
                                        Demandes reçue
                                        @include('unreadDemandes')
                                    </a>
                                </li>

                                <li class="profile-dropdown-list-item">
                                    <a href="{{ route('MesDemandes') }}">
                                    <i class="fa fa-user"></i><!-- icône de badge d'identité solide -->
                                    Demandes Envoyées
                                    </a>
                                </li>

                                <hr />

                                <li class="profile-dropdown-list-item">
    <a href="#" onclick="event.preventDefault(); if(confirm('Êtes-vous sûr de vouloir supprimer votre compte ?')) { document.getElementById('delete-account-form').submit(); } else { return false; }">
        <i class="fas fa-trash"></i> Supprimer mon compte
    </a>
    <form id="delete-account-form" action="{{ route('SupprimerMonCompte') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</li>
@else
<li class="profile-dropdown-list-item">
<a href="{{route('administrateur.listeAnnonces',Session::get('loginID'))}}">
<i class="fa bi-exclamation-triangle"></i> Annonces</a>
                            </li>
                            <hr />

                            
                                @endif
                                


                                    
                                <li class="profile-dropdown-list-item">
                                    <a href="{{ route('logout') }}">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        Se déconnecter
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </nav>

    <!--MODAL PROFILE-->
    @include('profile')
    @include('messages')


   


</body>



</html>
