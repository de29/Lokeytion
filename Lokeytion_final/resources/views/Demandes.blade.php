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
            <h2>Demandes reçue</h2>
            <hr>
          </div>
          @if(session('comment'))
    <div class="alert alert-warning">
        {{ session('comment') }}
    </div>
@endif


<center>
    <form action="{{url('/MesDemandes/search')}}" class="input-group" style="width:495px; height:40px; box-shadow: 0 0.8rem 1.2rem rgba(0, 0, 0, 0.6);">

    <input type="search" name="keyword" placeholder="Rechercher par titre ou categorie de l'annonce..." class="form-control search-input">
    <div >
    <button type="submit" class="input-group-prepend" style="height:45px; width:50px;"><span class="input-group-text" >
            <i class="fa fa-search" ></i>
    </span></button>


    </div>
</form>
<br>
@if(Session::has('success'))
              <div class="alert alert-success">{{Session::get('success')}}</div>
              @endif
              @if(Session::has('fail'))
              <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif
            
</center>
  <br>
  <br>
   <main class="table" style="margin: 0 auto;">


        <section class="table__body">
            <table>

                <thead>
                    <tr>

                    </tr>
                    <tr>
                        <th> Client <span class="icon-arrow">&UpArrow;</span></th>
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

                @php
                 $i=0;
                 $j=0;
                @endphp
                @if(!empty($clients))
                @foreach($annonces as $annonce)
                  @foreach($demandes[$i] as $demande )
                  @if($demande['id_annonce'] == $annonce['id'] )
                <tr>
                  
                        @foreach($clients[$j] as $client)
                         @if($client['id'] == $demande->id_client)
                        <td> <a href="{{ route('client_profil', ['id' => $client->id]) }}"><img src="{{ asset('images/users/' . (file_exists(public_path('images/users/' .$client['photo'] )) ? $client['photo']  : 'test.jpg')) }}" width="130" height="130" alt="">
                      {{ $client['nom'] }}</a></td>
                         @endif



                       
                        @foreach($objets[$i] as $objet)
                        @if($annonce['id_objet'] == $objet['id'])
                        <td><a href="{{ route('detail', ['id' => $annonce->id]) }}"> <img src="{{ asset('images/annonces/' . (file_exists(public_path('images/annonces/' . $objet->image1 )) ? $objet->image1 : 'no-image-available.jpeg')) }}" width="130" height="130" alt="">
                       {{ $annonce['titre'] }}</a></td>
                        <td> {{ $objet['categorie']}} </td>
                        @endif
                        @endforeach
                        <td><strong>{{ $annonce['prix']." Dh" }}</strong> </td>
                        <td>{{ $client['ville'] }}</td>
                        <td>{{ $demande['jour_reservation'] }}</td>
                        <td>{{$demande['etat']}}</td>
                        <td>
                          @if($demande['etat']=='Acceptée')
                          <a href="{{route('Demande.endreservation', $demande['id'])}}" class="text-warning mr-2" title="Accepter"><i class="bi bi-check-circle">fin de reservation</i></a>
                         @else
                            <a href="{{route('Demande.refuse', $demande['id'])}}" class="text-danger mr-2" title="Refusee"><i  class="fas fa-trash-alt"></i></a>
                            <a href="{{route('Demande.accept', $demande['id'])}}" class="text-warning mr-2" title="Accepter"><i class="bi bi-check-circle"></i> </a>
                            @endif
                          </td>
                        @php
                        $j++;
                        @endphp
                         @endforeach

                    </tr>
                    @endif
                    @endforeach
                    @php
                        $i++;
                        @endphp
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