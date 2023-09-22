<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Demande;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function SupprimerMonCompte(){
        $demande = Demande::where('id_client', Session::get('loginID'))->get();
            foreach ( $demande as $an) {
                $an->etat = 'detruit';
                $an->save();
            }
        $annonce = Annonce::where('id_user', Session::get('loginID'))->get();
        foreach ($annonce as $an) {

            $an->status = 'non';
            $an->save();
            $demande2=Demande::where('id_annonce', $an->id)->get();
            foreach ( $demande2 as $an) {
                $an->etat = 'detruit';
                $an->save();
            }
            
        }
       
    
       
        $user = User::find(Session::get('loginID')); 
         /*$user->role = 'ancienClient';
        $user->save();*/
        $user->delete();
    
        return redirect()->route('logout')->with('supprimer', 'Votre compte a été supprimé avec succès.');
    }


    public function MeClient()
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
/*
        $user=DB::table('annonces')
        ->join('users', 'users.id', '=', 'annonces.id_user')
        ->where('users.id', Session::get('loginID'))
        ->select('users.*')
        ->first();
*/

$user = User::find(Session::get('loginID')); 

        $commentaires_cl = DB::table('comments_users')
    ->join('demandes', 'comments_users.id_demande', '=', 'demandes.id')
    ->join('users', 'comments_users.id_commenter', '=', 'users.id')
    ->where('demandes.id_client', '=', Session::get('loginID'))
    ->where('comments_users.role', '=', 'partenaire')
    ->select('comments_users.*', 'users.*')
    ->get();




    return view('UserProfil', ['commentaires_cl' =>$commentaires_cl,'user' => $user,'nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);
    }


    public function MePartenaire()
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
/*
        $user=DB::table('annonces')
        ->join('users', 'users.id', '=', 'annonces.id_user')
        ->where('users.id', Session::get('loginID'))
        ->select('users.*')
        ->first();
*/

$user = User::find(Session::get('loginID')); 



    $commentaires_pr = DB::table('comments_users')
    ->join('annonces', 'comments_users.id_annonce', '=', 'annonces.id')
    ->join('users', 'comments_users.id_commenter', '=', 'users.id')
    ->where('annonces.id_user', Session::get('loginID'))
    ->where('comments_users.role', 'client')
    ->select('comments_users.*', 'users.*')
    ->get();

    return view('MePartenaire', ['commentaires_pr'=>$commentaires_pr,'user' => $user,'nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);
    }

    
    
}
