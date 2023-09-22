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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

  <script src="https://kit.fontawesome.com/c3b8d3700c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
  <title>profile with data and skills - Bootdey.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    body,html{
      color: #1a202c;
      text-align: left;
      background-color: #ffde59;
      overflow-x: hidden;
    }
    .main-body {
      padding: 15px;
      margin-top: 60px;
    }
    .card {
      box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
    }
    .card {
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 0 solid rgba(0,0,0,.125);
      border-radius: .25rem;
    }
    .card-body {
      flex: 1 1 auto;
      min-height: 1px;
      padding: 1rem;
    }
    .gutters-sm {
      margin-right: -8px;
      margin-left: -8px;
    }
    .gutters-sm>.col, .gutters-sm>[class*=col-] {
      padding-right: 8px;
      padding-left: 8px;
    }
    .mb-3, .my-3 {
      margin-bottom: 1rem!important;
    }
    .bg-gray-300 {
      background-color: #e2e8f0;
    }
    .h-100 {
      height: 100%!important;
    }
    .shadow-none {
      box-shadow: none!important;
    }
    .footer {
      position: fixed;
      bottom: 0;
      width: 100%;
      background-color: #f7fafc;
      padding: 20px;
      text-align: center;
      font-size: 14px;
    }

    .col-sm-12 {
         padding-left:30px;
    }

    .card-body{
      height:100%;
    }
  </style>
</head>
<body>
<div class="container">
<div class="main-body">

<!--put navbar here-->

<div class="row gutters-sm">
<div class="col-md-4 mb-3">
<div class="card">
<div class="card-body">
<div class="d-flex flex-column align-items-center text-center">
<img src="{{ asset('images/users/' . (file_exists(public_path('images/users/' . $list_user->photo)) ? $list_user->photo : '1.jpg')) }}" alt="Admin" class="rounded-circle" width="150">
<div class="mt-3">
<h4>{{$list_user->nom}} {{$list_user->prenom}}</h4>
<p class="text-secondary mb-1">Membre des : {{$list_user->created_at}}</p>
<br>
<br>


</div>
</div>
</div>
</div>
</div>
<div class="col-md-8">
<div class="card mb-3">
<div class="card-body">
<div class="row">
<div class="col-sm-3">
<h6 class="mb-0">Nom Complet</h6>
</div>
<div class="col-sm-9 text-secondary">
{{$list_user->nom}} {{$list_user->prenom}}
</div>
</div>
<hr>
<div class="row">
<div class="col-sm-3">
<h6 class="mb-0">Email</h6>
</div>
<div class="col-sm-9 text-secondary">
    <a href="mailto:{{$list_user->email}}">{{$list_user->email}}</a>
</div>
</div>
<hr>
<div class="row">
<div class="col-sm-3">
<h6 class="mb-0">Ville</h6>
</div>
<div class="col-sm-9 text-secondary">
{{$list_user->ville}}
</div>
</div>
<hr>
<div class="row">
<div class="col-sm-3">
<h6 class="mb-0">Annonces:</h6>
</div>
<div class="col-sm-9 text-secondary">
{{$annonces_raqm}} annonces.
</div>
</div>
<hr>
<div class="row">
<div class="col-sm-3">
<h6 class="mb-0">Eval. client </h6>
</div>
<div class="col-sm-9 text-secondary">
@if(empty($moyenne_usr))
    0 
@else 
    {{$moyenne_usr}} /5   {{$moyenne_prop}}
@endif

 </div>
</div>
<hr>
<div class="row">

<div class="col-sm-3">
<h6 class="mb-0">Eval. partenaire</h6>
</div>
<div class="col-sm-9 text-secondary">
@if(empty($moyenne_prop))
    0 
@else 
{{$moyenne_prop}} 
@endif
 </div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<button  @if(strcmp($list_user->role,'client,bloquer')==0) disabled @endif class="btn btn-danger mb-2 align-self-center text-white"><a href="{{route('administrateur.bloquer',['id'=>$list_user->id])}}" class="text-decoration-none text-white">Bloquer</a></button>
<button  @if(strcmp($list_user->role,'client')==0) disabled @endif class="btn btn-success mb-2 align-self-center text-white"><a href="{{route('administrateur.débloquer',['id'=>$list_user->id])}}" class="text-decoration-none text-white">Débloquer</a></button>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	
</script>
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

</body>

</html>

