<?php


namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\DemandeController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\Annonce;
use App\Models\CommentAnnonce;
use App\Models\CommentUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Panier;
use App\Http\Controllers\Demande;
use Mail\contactus;
use Carbon\Carbon;


class CommentController extends Controller
{

    public function showComment(){
        return view('comment');
    }

    public function Comment($id_demande)
    {
        $notification_navbar = DB::table('notifications')
        ->join('demandes', 'demandes.id', '=', 'notifications.id_demande')
        ->join('annonces', 'demandes.id_annonce', '=', 'annonces.id')
        ->join('objets', 'objets.id', '=', 'annonces.id_objet')
        ->where('notifications.etat', '=', 'unread')
        ->where('notifications.id_user', '=', Session::get('loginID'))
        ->orderBy('notifications.created_at', 'desc')
        ->get();

        $nbr_notification=$notification_navbar->count();

        $nbr_panier = DB::table('paniers')
        ->where('paniers.id_client', '=', Session::get('loginID'))
        ->count();

        
        $id_connecter=Session::get('loginID');

if(!empty($id_connecter)){
        $demande = DB::table('annonces')
             ->join('demandes', 'annonces.id', '=', 'demandes.id_annonce')
             ->where('demandes.id', $id_demande)
             ->first();
if($demande){
$annonce = DB::table('annonces')
             ->join('objets', 'annonces.id_objet', '=', 'objets.id')
             ->where('annonces.id', $demande->id_annonce)
             ->select('annonces.*','objets.nom','objets.categorie','objets.discription','objets.image1','objets.image2','objets.image3')
             ->first();

    if($annonce){


if ($id_connecter == $demande->id_client) {
  $role = 'client';
  $user=DB::table('annonces')
  ->join('users', 'users.id', '=', 'annonces.id_user')
  ->where('annonces.id_user', $annonce->id_user)
  ->first();

} elseif ($annonce->id_user == $id_connecter) {
  $role = 'partenaire';
  $user=DB::table('annonces')
  ->join('demandes', 'annonces.id', '=', 'demandes.id_annonce')
    ->join('users', 'users.id', '=', 'demandes.id_client')
    ->where('demandes.id_client', $demande->id_client)
    ->first();

} else {
  $role = 'vide';
  return redirect()->route('mesObjets');
}

$comment_exist = DB::table('comments_users')
->where('comments_users.id_demande', $id_demande)
->where('comments_users.id_annonce', $annonce->id)
->where('comments_users.id_commenter', $id_connecter)
->where('comments_users.role', $role)
->first();




if ($comment_exist) {
    return redirect('/annonces/'.$id_connecter)->with('Commentexist','Le commentaire existe déjà.');
} else {
        $maxdate = $demande->updated_at;
        $daysUntil = Carbon::now()->diffInDays($maxdate)+1;
        if($daysUntil > 10){
            return redirect('/annonces/'.$id_connecter)->with('Commentexist','CE FORMULAIRE  N\'EST PLUS DISPONIBLE. (le délai de réponce est depasse)');
        }else {
            return view('Comment', ['demande'=> $demande,'annonce' => $annonce, 'role' => $role,'id' => $id_connecter,'user'=> $user,'nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);
        }
}

}else{
    return redirect()->route('mesObjets');
}

}else{
    return redirect()->route('mesObjets');
}
}else{
    return redirect('login')->with('connecter','Il est nécessaire de se connecter pour pouvoir ajouter un commentaire.');
}

    }











public function addComment(Request $request, $id_demande, $id_annonce, $role)
    {
    $id_connecter=Session::get('loginID');

if($role=='client'){
    
    $validatedData = $request->validate([
    'rating_partenaire' => 'required',
    'comment_partenaire' => 'required',
    'rating_objet' => 'required',
    'comment_objet' => 'required',
    'btn_partenaire' => 'required',
], [
    'rating_partenaire.required' => 'Le champ de notation du partenaire est obligatoire. ',
    'comment_partenaire.required' => 'Le champ de commentaire sur le partenaire est obligatoire.',
    'rating_objet.required' => 'Le champ de notation de l\'objet est obligatoire.',
    'comment_objet.required' => 'Le champ de commentaire sur l\'objet est obligatoire. ',
    'btn_partenaire.required' => 'Veuillez sélectionner votre choix (J\'aime ou Je n\'aime pas).',

]);

CommentAnnonce::create([
    'id_demande' => $id_demande,
    'id_annonce' => $id_annonce,
    'id_commenter' =>$id_connecter,
    'comment' => $validatedData['comment_objet'],
    'note' => count($request->input('rating_objet', [])),
    'likes' => $validatedData ['btn_partenaire'],
    'role' => $role,
]);

CommentUser::create([
    'id_demande' => $id_demande,
    'id_annonce' => $id_annonce,
    'id_commenter' =>$id_connecter,
    'comment' => $validatedData['comment_partenaire'],
    'note' => count($request->input('rating_partenaire', [])),
    'likes' => $validatedData ['btn_partenaire'],
    'role' => $role,
]);

}else{

    $validatedData = $request->validate([
        'rating_client' => 'required',
        'comment_client' => 'required',
        'btn_cl' => 'required',
    ], [
        'rating_client.required' => 'Le champ de notation du client est obligatoire. ',
        'comment_client.required' => 'Le champ de commentaire sur le client est obligatoire.',
        'btn_cl.required' => 'Veuillez sélectionner votre choix (J\'aime ou Je n\'aime pas).',
    
    ]);
    

    $note = count($request->input('rating_client', []));

    CommentUser::create([
    'id_demande' => $id_demande,
    'id_annonce' => $id_annonce,
    'id_commenter' =>$id_connecter,
    'comment' => $validatedData['comment_client'],
    'note' => $note ,
    'likes' => $validatedData ['btn_cl'],
    'role' => $role,
]);

}


    return redirect('/annonces/'.$id_connecter)->with('comment', 'Commentaire créé avec succès !');
}
public function contactus(Request $request){
    $request->validate([
        'nom'=>'required',
        'sujet'=>'required',
        'message'=>'required',
        'email'=>'required'
    ], [
        'nom.required' => 'Veuillez entrer votre nom.',
        'sujet.required' => 'Le champ Sujet est obligatoire.',
        'message.required' => ' Le champ message est obligatoire.',
        'email.required' => 'Veuillez entrer votre adresse mail.',

    ]);
   
    $sujet = $request->sujet;
    $nom = $request->nom;
    $message = $request->message;
    $email = $request->email;
    Mail::to('lokeytion23@gmail.com')->send(new \App\Mail\ContactUs($sujet,$nom,$message,$email));
    return redirect('/')->with('envoyer','Votre message est envoye avec success !') ;
}





 }

