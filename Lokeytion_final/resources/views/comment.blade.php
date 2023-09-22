@include('navbar', ['nbr_notification' => $nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar])
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/c3b8d3700c.js" crossorigin="anonymous"></script>
    <title>Commentaire</title>

    <link rel="stylesheet" type="text/css" href="{{ url('css/comment.css') }}">


</head>
<center>

    <body>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('addComment', ['id_demande' => $demande->id, 'id_annonce' => $annonce->id, 'role' => $role]) }}" method="POST">
            @csrf
            
            <br><br>
            <h2>Évaluez votre expérience avec la location de l'objet "{{$annonce->nom}}": </h2>
            @if($role == 'client')
            <div id="feedback">
                <p>Chèr <b>client</b>, votre avis est important pour nous et nous serions ravis de savoir ce que vous avez
                    pensé de
                    l'état de l'objet <b>{{$annonce->nom}}</b> loué ainsi que de l'interaction avec le partenaire <b> {{$user->prenom}} {{$user->nom}}</b>. Votre feedback nous aidera à
                    offrir un
                    meilleur service à nos clients à l'avenir.
                    Si vous avez aimé votre expérience, n'hésitez pas à laisser une note positive et à partager votre
                    expérience
                    avec d'autres utilisateurs. Si vous avez des suggestions ou des commentaires constructifs, nous
                    serons
                    également heureux de les entendre.</p>
               
            </div>
            <div class="container">
                <div class="column">
                    <div class="text">Noter la sympathie de Votre partenaire  {{$user->nom}} {{$user->prenom}} :</div>
                    <div class="stars">
                        <label for="1">
                            <input type="checkbox" name="rating_partenaire[]" value="1" id="1"><span>&#9733;</span>

                        </label>

                        <label for="2">
                            <input type="checkbox" name="rating_partenaire[]" value="1" id="2"><span>&#9733;</span>

                        </label>
                        <label for="3">
                            <input type="checkbox" name="rating_partenaire[]" value="1" id="3"><span>&#9733;</span>

                        </label>
                        <label for="4">
                            <input type="checkbox" name="rating_partenaire[]" value="1" id="4"><span>&#9733;</span>

                        </label>
                        <label for="5">
                            <input type="checkbox" name="rating_partenaire[]" value="1" id="5"><span>&#9733;</span>

                        </label>

                    </div>
                </div>

                <div class="column">
                    <textarea id="comment" name="comment_partenaire" placeholder="Saisissez votre commentaire ici"></textarea>
                </div>
                </div>
            <br>

                <div class="container">
                <div class="column">
                    <div class="text">Noter l'etat de l'objet {{$annonce->nom}}:</div>
                    <div class="stars">
                        <label for="6">
                            <input type="checkbox" name="rating_objet[]" value="1" id="6"><span>&#9733;</span>

                        </label>

                        <label for="7">
                            <input type="checkbox" name="rating_objet[]" value="1" id="7"><span>&#9733;</span>

                        </label>
                        <label for="8">
                            <input type="checkbox" name="rating_objet[]" value="1" id="8"><span>&#9733;</span>

                        </label>
                        <label for="9">
                            <input type="checkbox" name="rating_objet[]" value="1" id="9"><span>&#9733;</span>

                        </label>
                        <label for="10">
                            <input type="checkbox" name="rating_objet[]" value="1" id="10"><span>&#9733;</span>

                        </label>

                    </div>
                </div>

                <div class="column">
                    <textarea id="comment" name="comment_objet" placeholder="Saisissez votre commentaire ici"></textarea>
                </div>
<br><br> <br> 
                
<div class="btn-group my-btn-group">
  <label class="btn btn-outline-success">
    <input type="radio" name="btn_partenaire" class="like-radio" value="1">
    <span class="like-icon"><i class="fa fa-heart"></i></span>
    <span class="like-text">J'aime</span>
  </label>
  <label class="btn btn-outline-danger">
    <input type="radio" name="btn_partenaire" class="dislike-radio" value="0">
    <span class="dislike-icon"><i class="fa fa-thumbs-down"></i></span>
    <span class="dislike-text">Je n'aime pas</span>
  </label>
</div>
            @else
            <div id="feedback">
                <p> Chèr <b>partenaire</b>. Nous aimerions avoir votre retour sur la location récente de votre objet <b>{{$annonce->nom}}</b> que vous avez effectuée 
                    avec <b>  {{$user->prenom}} {{$user->nom}} </b>. <br>
                    Votre opinion est importante pour nous, car elle nous aide à améliorer 
                    notre service et à mieux répondre a vos besoins. <br>
                    Si vous avez des commentaires, n'hésitez pas à nous les partager. Nous vous remercions pour votre
                    confiance.

                </p>
                </div>
              

                <div class="container">
                <div class="column">
                    <div class="text">Noter la sympathie de Votre client  {{$user->nom}} {{$user->prenom}} :</div>
                    <div class="stars">
                        <label for="1">
                            <input type="checkbox" name="rating_client[]" value="1" id="1"><span>&#9733;</span>

                        </label>

                        <label for="2">
                            <input type="checkbox" name="rating_client[]" value="1" id="2"><span>&#9733;</span>

                        </label>
                        <label for="3">
                            <input type="checkbox" name="rating_client[]" value="1" id="3"><span>&#9733;</span>

                        </label>
                        <label for="4">
                            <input type="checkbox" name="rating_client[]" value="1" id="4"><span>&#9733;</span>

                        </label>
                        <label for="5">
                            <input type="checkbox" name="rating_client[]" value="1" id="5"><span>&#9733;</span>

                        </label>

                    </div>
                </div>

                <div class="column">
                    <textarea id="comment" name="comment_client" placeholder="Saisissez votre commentaire ici"></textarea>
                </div>
                <br><br> <br> 
                <div class="btn-group my-btn-group">
  <label class="btn btn-outline-success">
    <input type="radio" name="btn_cl" class="like-radio" value="1">
    <span class="like-icon"><i class="fa fa-heart"></i></span>
    <span class="like-text">J'aime</span>
  </label>
  <label class="btn btn-outline-danger">
    <input type="radio" name="btn_cl" class="dislike-radio" value="0">
    <span class="dislike-icon"><i class="fa fa-thumbs-down"></i></span>
    <span class="dislike-text">Je n'aime pas</span>
  </label>
</div>






                @endif
           
            </div>

            <div style="text-align:center;">
                <button id="submit">Envoyer</button>
            </div>
        </form>


        <br><br><br>
        @include('footer')


        <script src="{{ url('js/swiper-bundle.min.js') }}"></script>
        <script src="{{ url('js/script.js') }}"></script>

    </body>

</center>

</html>