@component('mail::message')
cher utilisateur donnez votre opinion sur votre experience en ce qui concerne l'annonce <strong>' {{$annonce['titre']}} '</strong> .
Veuillez prendre quelques instants pour remplir notre formulaire de satisfaction client en cliquant sur le lien ci-dessous. 
Votre feedback nous permettra de mieux comprendre vos besoins et d'améliorer constamment nos offres pour vous satisfaire davantage.

@component('mail::button', ['url' => $link])
    Cliquez ici 
@endcomponent

@endcomponent