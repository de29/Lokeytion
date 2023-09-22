<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Panier;
use App\Models\User;
use App\Models\Notification;
use App\Models\Objet;
use App\Models\Annonce;
use App\Models\JourDispo;
use App\Http\Controllers\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\FormMail;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Session;
use PDF;

class DemandeController extends Controller
{
    public function showDemande(){


        $notification_navbar = \Illuminate\Support\Facades\DB::table('notifications')
        ->join('demandes', 'demandes.id', '=', 'notifications.id_demande')
        ->join('annonces', 'demandes.id_annonce', '=', 'annonces.id')
        ->join('objets', 'objets.id', '=', 'annonces.id_objet')
        ->where('notifications.etat', '=', 'unread')
        ->where('notifications.id_user', '=', Session::get('loginID'))
        ->orderBy('notifications.created_at', 'desc')
        ->get();

        $nbr_notification=$notification_navbar->count();

        $nbr_panier = \Illuminate\Support\Facades\DB::table('paniers')
        ->where('paniers.id_client', '=', Session::get('loginID'))
        ->count();

        $twentyFourHoursAgo = Carbon::now()->subHours(24);

    \Illuminate\Support\Facades\DB::table('demandes')
    ->where('created_at', '<=', $twentyFourHoursAgo)
    ->where('etat', '=', 'en attente')
    ->update(['etat' => 'detruit']);

        $i=0;
        $j=0;
        $annonces = Annonce::where('id_user', '=', Session::get('loginID'))->get();
        
        $clients=array();
        if (count($annonces)>0){
            foreach($annonces as $annonce){
                $temp = $annonce['id'];
                $demandes[$i] = Demande::where('id_annonce', '=', $temp)->where('etat', '=', 'en attente')->get();
                if(count($demandes[$i]) >0){
                    foreach($demandes[$i] as $demande){
                $date1 = Carbon::parse( $demande->created_at);
                $date2 = Carbon::now();
                $diffInDays = $date1->diff($date2)->d;

                if($diffInDays >= 1 ){
                    $demande->etat = 'Expirée';
                    $demande->save();
                    $dmd = $demande->id;
                    $notif = Notification::create([
                        'id_user' => $temp,
                        'id_demande' => $dmd,
                        'msg' => ' Votre demande a Expirée ',
                        'etat' => 'unread'
                    ]);
                $notif->save();
                }
                    }
                }
                $i++;
            }
            $i=0;

            foreach($annonces as $annonce){
                $temp = $annonce['id'];
                $objets[$i] = Objet::where('id', '=', $annonce['id_objet'])->get();
                $demandes[$i] = Demande::where('id_annonce', '=', $temp)->where('etat', '=', 'en attente')->get();
            if(count($demandes[$i]) >0){
                foreach($demandes[$i] as $demande){
                    $temp2 = $demande['id_client'] ;
                    $clients[$j] = User::where('id', '=', $temp2)->get();
                    $j++;
                }
            }
            $i++;
        }
        }else {
            $demandes=array();
            $objets=array();
        }

        return view('Demandes',['annonces' => $annonces , 'clients' => $clients ,'demandes' => $demandes , 'objets'=> $objets,'nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);
    }


    public function refuse($dmd){

        $demande = Demande::find($dmd);
        $annonce = $demande->id_annonce;
        $temp = $demande->id_client;
        $demande->etat = 'Refusée';
        $demande->save();
        $annonces = Annonce::find($annonce);
        $annonces->status = "active";
        $annonces->save();
        $client = User::find($temp);
        $temp = $client['id'];
        $notif = Notification::create([
                'id_user' => $temp,
                'id_demande' => $dmd,
                'msg' => ' Votre demande est refusée ',
                'etat' => 'unread'
            ]);
        $notif->save();

           return  redirect()->route('Demande.show');
        }


        public function accept($dmd){

            $demande = Demande::find($dmd);
            $temp = $demande->id_client;
            $demande->etat = 'Acceptée';
            $demande->save();
            $annonce = $demande->id_annonce;
            $annonces = Annonce::find($annonce);
            $annonces->status = "active";
            $annonces->save();
            $temp = $demande->id_client;
            $notif = Notification::create([
                'id_user' => $temp,
                'id_demande' => $dmd,
                'msg' => ' Votre demande est Acceptée ',
                'etat' => 'unread'
            ]);
            $notif->save();
            $temp = $demande->id_client;
            $dates = $demande->jour_reservation;
            $dates = explode(",",$dates);
            $maxdate = max($dates);
            $daysUntil = Carbon::now()->diffInDays($maxdate)+1;
            $user = User::find(Session::get('loginID'));
            $client = User::find($temp);
            $email1= $client->email;
            Mail::to($email1)->send(new SendMail($user,$annonces));
            Mail::to($user->email)->send(new SendMail($client,$annonces));
            $this-> generateAndSendPDF($annonces,$demande,$user,$client, $user->email);
            $this->generateAndSendPDF($annonces,$demande,$client,$user,$email1);
            return  redirect()->route('Demande.show')->with('success','Demande Acceptée.Veriffier votre boite email');
        }


    public function annuler($id)
{
    $demande = Demande::find($id);
    $demande->etat = 'Annulée';
    $demande->save();
    return redirect()->back();
}



    public function search(Request $dmd){

        $notification_navbar = \Illuminate\Support\Facades\DB::table('notifications')
        ->join('demandes', 'demandes.id', '=', 'notifications.id_demande')
        ->join('annonces', 'demandes.id_annonce', '=', 'annonces.id')
        ->join('objets', 'objets.id', '=', 'annonces.id_objet')
        ->where('notifications.etat', '=', 'unread')
        ->where('notifications.id_user', '=', Session::get('loginID'))
        ->orderBy('notifications.created_at', 'desc')
        ->get();

        $nbr_notification=$notification_navbar->count();

        $nbr_panier = \Illuminate\Support\Facades\DB::table('paniers')
        ->where('paniers.id_client', '=', Session::get('loginID'))
        ->count();
        
        $i=0;
        $j=0;
        $clients=array();
        $demandes=array();
        $objets=array();
        $annonces = Annonce::where('id_user', '=', Session::get('loginID'))->where('titre', 'like', '%'.$dmd->keyword.'%' )->get();
        if(count($annonces)>0){
            foreach($annonces as $annonce){
                $temp = $annonce['id'];
                $objets[$i] = Objet::where('id', '=', $annonce['id_objet'])->get();

                $demandes[$i] = Demande::where('id_annonce', '=', $temp)->where('etat', '=', 'en attente')->get();
            if(count($demandes[$i]) >0){
                foreach($demandes[$i] as $demande){
                    $temp2 = $demande['id_client'] ;
                    $clients[$j] = User::where('id', '=', $temp2)->get();
                    $j++;
                }


            $i++;
        }
    }
        }else {

            $annonces = Annonce::where('id_user', '=', Session::get('loginID'))->get();
            foreach($annonces as $annonce){
                $temp = $annonce['id'];
                $objets[$i] = Objet::where('id', '=', $annonce['id_objet'])->where('categorie', 'like','%'.$dmd->keyword.'%' )->get();
            if(count($objets[$i])>0){
                $demandes[$i] = Demande::where('id_annonce', '=', $temp)->where('etat', '=', 'en attente')->get();
            if(count($demandes[$i]) >0){
                foreach($demandes[$i] as $demande){
                    $temp2 = $demande['id_client'] ;
                    $clients[$j] = User::where('id', '=', $temp2)->get();
                    $j++;
                }
            }
            $i++;
          }
        }

    }
        return view('Demandes',['annonces' => $annonces , 'clients' => $clients ,'demandes' => $demandes , 'objets'=> $objets,'nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);
    }




    public function generateAndSendPDF($data1,$data2,$data3,$data4, $recipient_email)
    {
        //data1 = annonce, data2 = demande , data3= li ghaywslo lmail , data4 = taraf akhar
        // Generate PDF using the data
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf',  ['data1' => $data1, 'data2' => $data2, 'data3' => $data3, 'data4' => $data4]);
    
        // Get PDF content as string
        $pdf_content = $pdf->output();
    
        // Send email with PDF as attachment
        Mail::send([],[], function ($message) use ($pdf_content, $recipient_email) {
            $message->to($recipient_email)
            ->from('lokeytion23@gmail.com','LOKEYTION')
                ->subject('Votre Contrat')
                ->attachData($pdf_content, 'contrat.pdf', [
                    'mime' => 'application/pdf',
                ]);
        });
    } 





    public function louer($id, Request $request)
{

    if(isset($_POST['louer'])){
        $annonce_objet = \Illuminate\Support\Facades\DB::table('annonces')
        ->join('objets', 'annonces.id_objet', '=', 'objets.id')
        ->select('annonces.*', 'objets.categorie', 'objets.discription', 'objets.image1', 'objets.image2', 'objets.image3')
        ->where('annonces.id', $id)
        ->first();

        $demande_exist = Demande::where('id_annonce', $annonce_objet->id)
        ->where('id_client', Session::get('loginID'))
        ->first();

 //if (!$demande_exist) {
        $validatedData = $request->validate([
            'dateRange' => 'required|String',
        ], [
            'dateRange.required' => 'Veuillez sélectionner une date.',
        
        ]);

        $dateArray = explode(", ", $validatedData['dateRange']);
        $dateCount = count($dateArray);

if($dateCount >= $annonce_objet->nbr_min_location){
        $demande = new Demande;
        $demande->id_client = Session::get('loginID');
        $demande->id_annonce = $annonce_objet->id;
        $demande->etat = 'en attente';
        $demande->jour_reservation = $validatedData['dateRange'];
        $demande->save();
/*
        // Mettre à jour l'état des jours réservés dans la table "jourdispo"
        $jours_reserves = explode(',', $jours_str);
        foreach ($jours_reserves as $jour_reserve) {
            JourDispo::where('id_annonce', $annonce_objet->id)
                ->where('jour', $jour_reserve)
                ->update(['etat' => 'reserve']);
        }

        // Vérifier s'il reste des jours disponibles pour cette annonce
        $jours_dispo = JourDispo::where('id_annonce', $annonce_objet->id)
            ->where('etat', 'disponible')
            ->exists();

        // Si tous les jours sont réservés, mettre à jour l'état de l'annonce à "desactive"
        if (!$jours_dispo) {
            Annonce::where('id', $annonce_objet->id)->update(['status' => 'desactive']);
        }*/
   // }

    // Rediriger l'utilisateur vers la liste des annonces
    return redirect('/detail/'.$id)->with('successl', 'Objet louer avec succès !');
}else{
    return redirect('/detail/'.$id)->with('nbr_jrs', 'le nombre de jours minimum de location est '.$annonce_objet->nbr_min_location.'.');
}
}elseif(isset($_POST['panier'])){
    $annonce_objet = \Illuminate\Support\Facades\DB::table('annonces')
        ->join('objets', 'annonces.id_objet', '=', 'objets.id')
        ->select('annonces.*', 'objets.categorie', 'objets.discription', 'objets.image1', 'objets.image2', 'objets.image3')
        ->where('annonces.id', $id)
        ->first();


            $validatedData = $request->validate([
                'dateRange' => 'required|String',
            ], [
                'dateRange.required' => 'Veuillez sélectionner une date.',
            ]);

            if (empty($validatedData['dateRange'])) {
                return back()->withErrors(['dateRange' => 'Veuillez choisir au moins un date.']);
            }


            $dateArray = explode(", ", $validatedData['dateRange']);
            $dateCount = count($dateArray);
    
    if($dateCount >= $annonce_objet->nbr_min_location){

    $Panier = new Panier;
    $Panier->id_annonce = $annonce_objet->id;
    $Panier->id_client = Session::get('loginID');
    $Panier->jour_reservation =  $validatedData['dateRange'];
    $Panier->save();
    return redirect('/detail/'.$id)->with('successP', 'Objet ajouter au panier avec succès !');;


    }else{
        return redirect('/detail/'.$id)->with('nbr_jrs', 'le nombre de jours minimum de location est '.$annonce_objet->nbr_min_location.'.');
    }
    // Rediriger l'utilisateur vers la page du panier

}


 }




 public function MesDemandes(){
    $notification_navbar = \Illuminate\Support\Facades\DB::table('notifications')
    ->join('demandes', 'demandes.id', '=', 'notifications.id_demande')
    ->join('annonces', 'demandes.id_annonce', '=', 'annonces.id')
    ->join('objets', 'objets.id', '=', 'annonces.id_objet')
    ->where('notifications.etat', '=', 'unread')
    ->where('notifications.id_user', '=', Session::get('loginID'))
    ->orderBy('notifications.created_at', 'desc')
    ->get();


    $nbr_notification=$notification_navbar->count();

    $nbr_panier = \Illuminate\Support\Facades\DB::table('paniers')
    ->where('paniers.id_client', '=', Session::get('loginID'))
    ->count();


    $twentyFourHoursAgo = Carbon::now()->subHours(24);

    \Illuminate\Support\Facades\DB::table('demandes')
    ->where('created_at', '<=', $twentyFourHoursAgo)
    ->where('etat', '=', 'en attente')
    ->update(['etat' => 'detruit']);

    $demandes = \Illuminate\Support\Facades\DB::table('demandes')
    ->join('annonces', 'annonces.id', '=', 'demandes.id_annonce')
    ->join('users', 'users.id', '=', 'annonces.id_user')
    ->join('objets', 'objets.id', '=', 'annonces.id_objet')
    ->select('users.nom AS userName','demandes.id AS demande_id', 'demandes.*', 'users.id AS user_id', 'users.*', 'annonces.id AS annonce_id', 'objets.*','annonces.*')
    ->where('demandes.id_client', '=',Session::get('loginID') )
    ->orderBy('demandes.created_at', 'DESC')
    ->get();


    return view('AnnonceDemandee',[ 'demandes'=> $demandes,'nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);
}


public function endreservation($dmd){
    $demande = Demande::find($dmd);
    $dates = $demande->jour_reservation;
    $dates = explode(",",$dates);
    $maxdate = max($dates);
    $daysUntil = Carbon::now()->diffInDays($maxdate)+1;
    $user = User::find(Session::get('loginID'));
    $temp = $demande->id_client;
    $client = User::find($temp);
    $email1= $client->email;
    $annonce = $demande->id_annonce;
    $annonces = Annonce::find($annonce);
    $email2 = $user->email;
    if(Carbon::now()->gt($maxdate)){
        Mail::to($email1)->send(new FormMail($annonces,"http://127.0.0.1:8000/Comment/".$dmd.""));
        Mail::to($email2)->send(new FormMail($annonces,"http://127.0.0.1:8000/Comment/".$dmd.""));
        $demande->etat = 'termine';
        $demande->save();
        return  redirect()->route('Demande.show')->with('success','Réservation términée.');
    }else{
        return  redirect()->route('Demande.show')->with('fail','la période de réservation n\'est pas encore écoulée ');
    }
}

public function endreservationclient($dmd){
    $demande = Demande::find($dmd);
    $dates = $demande->jour_reservation;
    $dates = explode(",",$dates);
    $maxdate = max($dates);
    $daysUntil = Carbon::now()->diffInDays($maxdate)+1;
    $user = User::find(Session::get('loginID'));
    $temp = $demande->id_client;
    $client = User::find($temp);
    $email1= $client->email;
    $annonce = $demande->id_annonce;
    $annonces = Annonce::find($annonce);
    $email2 = $user->email;
    if(Carbon::now()->gt($maxdate)){
        Mail::to($email1)->send(new FormMail($annonces,"http://127.0.0.1:8000/Comment/".$dmd.""));
        Mail::to($email2)->send(new FormMail($annonces,"http://127.0.0.1:8000/Comment/".$dmd.""));
        $demande->etat = 'termine';
        $demande->save();
        return  redirect()->route('MesDemandes')->with('success','Réservation términée.');
    }else{
        return  redirect()->route('MesDemandes')->with('fail','la période de réservation n\'est pas encore écoulée ');
    }
}






public function louer_panier($id)
{


        $annonce = \Illuminate\Support\Facades\DB::table('paniers')
        ->join('annonces', 'annonces.id', '=', 'paniers.id_annonce')
        ->join('objets', 'annonces.id_objet', '=', 'objets.id')
        ->select('annonces.*','paniers.jour_reservation', 'objets.categorie', 'objets.discription', 'objets.image1', 'objets.image2', 'objets.image3')
        ->where('paniers.id', $id)
        ->first();

        $demande_exist = Demande::where('id_annonce', $annonce->id)
        ->where('jour_reservation', $annonce->jour_reservation)
        ->first();


    if($demande_exist){
            // Remove the item from the panier table
            $item = Panier::where('id',$id)->first();
            $item->delete();

        return redirect('/MonPanier')->with('echec', 'Objet deja louer !');

    }else{

        $demande = new Demande;
        $demande->id_client = Session::get('loginID');
        $demande->id_annonce = $annonce->id;
        $demande->etat = 'en attente';
        $demande->jour_reservation =$annonce->jour_reservation;
        $demande->save();


        // Remove the item from the panier table
        $item = Panier::where('id',$id)->first();
        $item->delete();
/*
        // Mettre à jour l'état des jours réservés dans la table "jourdispo"
        $jours_reserves = explode(',', $jours_str);
        foreach ($jours_reserves as $jour_reserve) {
            JourDispo::where('id_annonce', $annonce_objet->id)
                ->where('jour', $jour_reserve)
                ->update(['etat' => 'reserve']);
        }

        // Vérifier s'il reste des jours disponibles pour cette annonce
        $jours_dispo = JourDispo::where('id_annonce', $annonce_objet->id)
            ->where('etat', 'disponible')
            ->exists();

        // Si tous les jours sont réservés, mettre à jour l'état de l'annonce à "desactive"
        if (!$jours_dispo) {
            Annonce::where('id', $annonce_objet->id)->update(['status' => 'desactive']);
        }*/
   // }

    // Rediriger l'utilisateur vers la liste des annonces
    return redirect('/MonPanier')->with('success', 'Objet louer avec succès !');

    }
}}


