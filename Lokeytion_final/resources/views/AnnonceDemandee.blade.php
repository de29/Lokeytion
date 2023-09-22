@include('navbar', ['nbr_notification' => $nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar])
<!DOCTYPE html>
<html lang="en" title="Coding design">

<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

  <script src="https://kit.fontawesome.com/c3b8d3700c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
  <title>Demandes</title>

  <link rel="stylesheet" href="{{url('css/styleDemandes.css')}}">
</head>
<br>
  <br>
<body style="background-color: #ffde59;">
<div class="titre">
            <hr>
            <h2>Demandes Envoyées</h2>
            <hr>
          </div>
          <center>
          @if(Session::has('success'))
              <div class="alert alert-success">{{Session::get('success')}}</div>
              @endif
              @if(Session::has('fail'))
              <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif




</center>
</div>

  <br>
  <br>
   <main class="table" style="margin: 0 auto;">


        <section class="table__body">
            <table>

                <thead>
                    <tr>

                    </tr>
                    <tr>
                        <th> Partenaire <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Annonce <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Categorie <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Prix <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Ville<span class="icon-arrow">&UpArrow;</span></th>
                        <th> Jour de reservation<span class="icon-arrow">&UpArrow;</span></th>
                        <th> Etat <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Action <span class="icon-arrow">&UpArrow;</span></th>
                    </tr>

                </thead>
                <tbody>

               @if(!empty($demandes))
                 @foreach($demandes as $demande)
                  
                <tr>
                    
                        <td> <a href="{{ route('client_profil', ['id' => $demande->user_id]) }}"><img src="{{ asset('images/users/' . (file_exists(public_path('images/users/' .$demande->photo )) ? $demande->photo  : 'test.jpg')) }}" width="130" height="130" alt="">
                      {{ $demande->userName }}</a></td>



                       
                     
                        <td><a href="{{ route('detail', ['id' => $demande->annonce_id]) }}"> <img src="{{ asset('images/annonces/' . (file_exists(public_path('images/annonces/' . $demande->image1 )) ? $demande->image1 : 'no-image-available.jpeg')) }}" width="130" height="130" alt="">
                       {{ $demande->nom }}</a></td>
                        <td> {{ $demande->categorie}} </td>
                      
                        <td><strong>{{ $demande->prix }} Dh</strong> </td>
                        <td>{{ $demande->ville }}</td>
                        <td>{{ $demande->jour_reservation }}</td>
                        <td>{{ $demande->etat }}</td>
                        <td>
                          @if( $demande->etat=='en attente' )
                          <form method="POST" action="{{ route('demandes.annuler', $demande->demande_id) }}">
    @csrf
    @method('PUT')
    <div style="background-color:red; padding:5px;  width: 70px; border-radius: 10px;height: 30px; text-align: center;">
        <button type="submit" title="Annuler" style="color:white; border:none; background:none;"><b>Annuler</b></button>
    </div>
</form>
@endif
@if($demande->etat=='Acceptée')
                          <a href="{{route('Demande.endreservationclient', $demande->demande_id)}}" class="text-warning mr-2" title="Accepter"><i class="bi bi-check-circle">fin de reservation</i></a>
                        @endif
                          </td>
                       

                    </tr>
                  
@endforeach
                @else
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <center><td><p>AUCUNE DEMANDES</p></td></center>

                </tr>
                @endif
                </tbody>
            </table>
        </section>
    </main>
    <br><br><br><br>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="path/to/font-awesome.min.css">
    <script src="{{url('lib/easing/easing.min.js')}}"></script>
    <script src="{{url('lib/slick/slick.min.js')}}"></script>


    <!-- Template Javascript -->
    <script src="{{url('js/main.js')}}"></script>
    <script src="{{url('js/zoom.js')}}"></script>

          <!-- JAVASCRIPT FILES -->
  <script src="{{url('js/swiper-bundle.min.js')}}"></script>
  <script src="{{url('js/script.js')}}"></script>
  @include('footer')
</body>

</html>