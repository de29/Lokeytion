@include('navbar')
 <!DOCTYPE html>
<html lang="en" title="Coding design">

<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

  <script src="https://kit.fontawesome.com/c3b8d3700c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
  <title>Annonce</title>

  {{-- <link rel="stylesheet" href="{{url('css/styleDemandes.css')}}"> --}}
</head>
<br>
  <br>
<body style="background-color: #ffde59;">
  <div class="titre text-center">
    <hr>
    <h2>Detail de l'annonce </h2>
    <hr>
  </div>
  <br>
  <br>
   <main class="table" style="margin: 0 auto;">
   <div class="d-flex flex-column container card mt-4 mb-3 " >
    <div class="d-flex justify-content-center mt-2" style="background-color:none;">
      <div>
          @foreach($annonce as $item)
          <img src="{{ asset('images/annonces/' . (file_exists(public_path('images/annonces/' . $item->image1)) ? $item->image1 : 'no-image-available.jpeg')) }}" class="card-img-top border border-1 border-dark" alt="image" style="width: 24rem; height: 24rem;">
      </div>
      <div class="container card-body align-self-start ml-4">
        <h5 class="card-title mb-3"><strong>Titre :</strong>  {{$item->titre}}</h5>
        <h5 class="card-title mb-3"><strong>Ville :</strong> {{$item->ville}}</h5>
        <h5 class="card-title mb-3"><strong>Catégorie : </strong>{{$item->categorie}}</h5>
        <h5 class="card-title mb-3"><strong>Prix : </strong>{{$item->prix}} dh/jour</h5>
        <h5 class="card-title mb-3"><strong>Etat : </strong>{{$item->status}}</h5>
    </div>
    
      <div class="container card-body align-self-end ml-5">
          <h5 class="card-title mb-3"><strong>Disponibilité :</strong></h5>
          <h5 class="card-title mb-3"><strong>De :</strong> {{$item->de}} 
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                   <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
               </svg>
          </h5>
          <h5 class="card-title mb-3"><strong>à :</strong> {{$item->a}}
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                </svg>
            </h5>
          </div>
      </div>
      <div class="d-flex justify-content-center">
          <div class="container card-body align-self-start">
            <h5 class="card-title"><strong>Description :  </strong>{{$item->discription}}</h5>
            
            
          </div>
            
      </div>
    </div>
    @endforeach
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

