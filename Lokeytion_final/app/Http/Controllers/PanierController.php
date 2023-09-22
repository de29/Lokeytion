<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Annonce;
use App\Models\objet;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PanierController extends Controller
{
    public function showPanier(){

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

        $panierElements = DB::table('paniers')
            ->join('annonces', 'paniers.id_annonce', '=', 'annonces.id')
            ->join('objets', 'annonces.id_objet', '=', 'objets.id')
            ->join('users', 'users.id', '=', 'annonces.id_user')
            ->select('paniers.id','paniers.id_annonce','users.nom','users.id as id_client','users.prenom','paniers.jour_reservation', 'annonces.titre','objets.image1', 'objets.discription', 'annonces.prix')
            ->where('paniers.id_client', Session::get('loginID'))
            ->get();
        /*    
        $panier = Panier::All();
        $annonces = Annonce::where('status', 'active')
                 ->get();

        $objets = Objet::All();
        
        }
    }
*/
$prixTotal = 0;
    foreach ($panierElements as $item) {
            
                $prixTotal += $item->prix;
            
        
    }
        return view('panier',compact('panierElements','nbr_notification','nbr_panier','prixTotal','notification_navbar'));
    }

    public function deletePanier($id)
    {
        $item = Panier::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'La suppression a été effectuée avec succès!');
    }

    public function storeDemande(Request $request)
    {
        $demande = new Demande();
        $demande->id_client = $request->input('id_client');
        $demande->id_annonce = $request->input('id_annonce');
        $demande->etat = 'en attente';
        $demande->jour_reservation = '2023-04-29,2023-05-01';
        $demande->save();


        // Remove the item from the panier table
        $item = Panier::where('id',$request->input('id'))->first();
        $item->delete();

        return redirect()->back()->with('success', 'Demande créée avec succès !');
    }

    public function showNotifications(){

    }
}
