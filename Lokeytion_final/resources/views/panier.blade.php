@include('navbar', ['nbr_notification' => $nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <!-- Lien vers le fichier CSS de Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-G6emL3ivDfj2iqX21+C51RcR1eV0Wo1A4SL4z/4LJnFUGgC16xImN/6NPSU6TITNMDTgNSz89uxZ1Wp/mdeemw==" crossorigin="anonymous" />

<!-- Lien vers le fichier JavaScript de Font Awesome (facultatif, seulement si vous utilisez des fonctionnalités JavaScript de Font Awesome) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-MCf+7stTlNBp9Z7JRuIc0o/z7jz0QKn8NU1+u/o2D32V6UOgo6NU+nB6q3GViITXA3xzhclw1z8V7qC3qFs84g==" crossorigin="anonymous"></script>

    <title>Panier</title>

    <link rel="stylesheet" href="{{url('css/stylePanier.css')}}">


</head>

<body>



<br><br>

@if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @elseif(Session::has('echec'))
            <div class="alert alert-warning">{{Session::get('echec')}}</div>

              @endif
    <div class="container">

        <div class="card">
            <div class="title">
                <h2 class="title"><b>Mon Panier</b></h2>
                <i class="fa-solid fa-cart-arrow-down nav-icon"></i>
            </div> 
            <div class="scroll-container">
                <ul class="listCard">
                           @foreach($panierElements as $item)
<div class="listCardPanier">
                    <li>
                        

                        <div><img src="{{ asset('images/annonces/' . (file_exists(public_path('images/annonces/' . $item->image1)) ? $item->image1 : 'no-image-available.jpeg')) }}" /></div>

                        <div class="name">{{ $item->titre }} </div><div>{{ $item->jour_reservation }}</div>
                            <div>{{ number_format($item->prix,2) }}</div>
                      
                        
                        <div class="panierOptions">
                        <form action="{{ route('panier.delete', $item->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="SupprimerPanier" name="SupprimerPanier"><i class="bi bi-trash"></i></button>
                        </form>
                        <form id="louer-form" method="POST" action="{{ route('louer_panier', ['id' => $item->id]) }}">
                           @csrf
                           <input type="hidden" name="id_client" value="{{$item->id_client}}">
                           <input type="hidden" name="id" value="{{ $item->id }}">
                           <input type="hidden" name="id_annonce" value="{{ $item->id_annonce }}">
                           <button id="louer-btn" data-bs-toggle="modal" data-bs-target="#myModal">Louer</button>
                        
                        </div>
                    </li>
</div>
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
    <label><input type="checkbox" id="accept-terms" required> I accept the terms and conditions</label>
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
        }
    });
</script>
</form>

                <hr>@endforeach
                </ul>
            </div>
            <div class="checkOut">
                @if($prixTotal>0)
            <div class="total"><h3>Total : {{$prixTotal}} DHs</h3></div>
            @else
            <div class="total"><h3>Total : {{$prixTotal}} DH</h3></div>
                @endif
            </div>
        </div>

    </div><br><br>
<!-- Footer -->


<!-- JAVASCRIPT FILES -->
<script src="{{url('js/swiper-bundle.min.js')}}"></script>
  <script src="{{url('js/script.js')}}"></script>
  @include('footer')
</body>

</html>


