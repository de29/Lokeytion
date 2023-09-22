@include('navbar')
 <!DOCTYPE html>
<html lang="en" title="Coding design">

<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="{{url('css/ReaserchBar.css')}}" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

  <script src="https://kit.fontawesome.com/c3b8d3700c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
  <title>Utilisateurs</title>

  <link rel="stylesheet" href="{{url('css/styleDemandes.css')}}">
</head>
<br>
  <br>
<body style="background-color: #ffde59;">
<div class="titre">
            <hr>
            <h2>Les utilisateurs</h2>
            <hr>

            <div class="s003">
              <form action="{{ route('utilisateurs.search')}}" method="GET">
                <div class="inner-form">
                  <div class="input-field second-wrap">
                    <input id="search" type="text" name="q" placeholder="Entrer le nom de l'utilisateur ou bien son id" />
                  </div>
                  <div class="input-field third-wrap">
                    <button class="btn-search" type="submit">
                      <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                      </svg>
                    </button>
                  </div>
                </div>
              </form>
            </div> 
          </div>
          
          <div class="mt-2">
      @if (session('status'))
          <h6 class="alert alert-success container">{{ session('status') }}</h6>
      @endif
  </div> 
  <br>
  <br>
   <main class="table" style="margin: 0 auto;">


        <section class="table__body">
        <table>
            <thead>
                <tr>
                  <th scope="col">Id<span class="icon-arrow">&UpArrow;</span></th>
                  <th scope="col">Nom<span class="icon-arrow">&UpArrow;</span></th>
                  <th scope="col">Prenom<span class="icon-arrow">&UpArrow;</span></th>
                  <th scope="col">Email<span class="icon-arrow">&UpArrow;</span></th>
                  <th scope="col"><span class="icon-arrow">&UpArrow;</span></th>
                  <th scope="col">Action<span class="icon-arrow">&UpArrow;</span></th>
                  <th scope="col"><span class="icon-arrow">&UpArrow;</span></th>
                </tr>
            </thead>
            <tbody>
              @if (!empty($list_users) && count($list_users) > 0)
                @foreach ($list_users as $list_user)
                    <tr>
                        <td>{{$list_user->id}}</td>
                        <td>{{$list_user->nom}}</td>
                        <td>{{$list_user->prenom}}</td>
                        <td>{{$list_user->email}}</td>
                        <td><button  @if(5<1) disabled @endif class="btn btn-primary mb-2 align-self-center text-white"><a href="{{route('administrateur.consulter-user',['id'=>Session::get('loginID'), 'id_client'=>$list_user->id])}}" class="text-decoration-none text-white">Consulter</a></button></td>
                        <td><button  @if(strcmp($list_user->role,'client,bloquer')==0) disabled @endif class="btn btn-danger mb-2 align-self-center text-white"><a href="{{route('administrateur.bloquer',['id'=>$list_user->id])}}" class="text-decoration-none text-white">Bloquer</a></button></td>
                        <td><button  @if(strcmp($list_user->role,'client')==0) disabled @endif class="btn btn-success mb-2 align-self-center text-white"><a href="{{route('administrateur.débloquer',['id'=>$list_user->id])}}" class="text-decoration-none text-white">Débloquer</a></button></td>
                    </tr>       
                @endforeach
                @else
                <tr>
                  <td colspan="7">
                      <h3 class="text-center font-weight-bold">Utilisateur introuvable</h3>
                  </td>
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

