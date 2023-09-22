<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Annonce;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class Administrateur extends Controller
 {
    public function listeAnnonces($id){
        $user = User::findOrFail($id);
        $annonces = DB::table('users')
        ->join('annonces','users.id','=','annonces.id_user')
        ->where('annonces.status','=','active')
        ->orwhere('annonces.status','=','active,bloquer')
        ->get();
        return view('administrateur.listeAnnonces',[
            'user'=>$user,
            'annonces' => $annonces
        ]);
    }
    


    public function consulter_annonce($id,$id_annonce){
        $user = User::findOrFail($id);
        $annonce = null;
        $annonce = Annonce::findOrFail($id_annonce);
        $annonce = DB::table('annonces')
        ->join('objets', 'annonces.id_objet', '=', 'objets.id')
        ->join('users', 'users.id', '=', 'annonces.id_user')
        ->select('annonces.*','users.nom','users.prenom','users.photo', 'objets.categorie', 'objets.discription', 'objets.image1', 'objets.image2', 'objets.image3')
        ->where('annonces.id', $id_annonce) 
        ->get();

        
          
        //dd($offre);        
        return view('administrateur.consulter-annonce',[
            'user'=>$user,
            'annonce' => $annonce
        ]);
    }

    public function bloquer_annonce($id_annonce){
        $annonce = Annonce::findOrFail($id_annonce);
        $annonce->status = $annonce->status.',bloquer';
        $annonce->save(); 
        
            return redirect()->back()->with('status','l\'offre est désormais bloqué !');
    }

    public function débloquer_annonce($id_annonce){
        $annonce = Annonce::findOrFail($id_annonce);
        $annonce->status = explode(',',$annonce->status)[0];
        $annonce->save();
        
            return redirect()->back()->with('status','l\'offre est désormais débloqué !');
    }

    public function listeUsers($id){
        $user = User::findOrFail($id);
        $list_users = DB::table('users')->where('role', 'not like', 'admin%')->get();
        return view('administrateur.listeUsers',[
            'user'=>$user,
            'list_users'=>$list_users
        ]);
    }

    public function consulter_user($id,$id_client){
        $user = User::findOrFail($id);

    $list_user = User::findOrFail($id_client);

$annonces_raqm = DB::table('annonces')
    ->where('id_user', '=', $list_user->id)
    ->where('status', '=', 'active')
    ->count();

    $commentaires_usr = DB::table('comments_users')
    ->join('demandes', 'demandes.id', '=', 'comments_users.id_demande')
    ->where('demandes.id_client', '=', $list_user->id)
    ->select(DB::raw('AVG(comments_users.note) AS moyenne'))
    ->first();

    $moyenne_usr = $commentaires_usr->moyenne;


    $evaluation_prop = DB::table('comments_users')
    ->join('demandes', 'demandes.id', '=', 'comments_users.id_demande')
    ->join('annonces', 'demandes.id_annonce', '=', 'annonces.id')
    ->where('annonces.id_user', '=',$list_user->id)
    ->select(DB::raw('AVG(comments_users.note) AS moyenne_prop'))
    ->first();

    $moyenne_prop = $evaluation_prop->moyenne_prop;




        //dd($client);        
        return view('administrateur.user_info',[
            'user'=>$user,
            'list_user'=>$list_user,
             'annonces_raqm'=>$annonces_raqm,
             'moyenne_usr'=>$moyenne_usr,
             'moyenne_prop'=>$moyenne_prop
        ]);
    }

    /*
    public function bloquer($id){
        $personne = User::findOrFail($id);
        $personne->role = $personne->role.',bloquer';
        $personne->save(); 
        if(strcmp($personne->role,'client,bloquer')==0){
            return redirect()->back()->with('status','Cet utilisateur est désormais bloqué !');
        }
        
    }
    public function débloquer($id){
        $personne = User::findOrFail($id);
        $personne->role = explode(',',$personne->role)[0];
        $personne->save();
        if(strcmp($personne->role,'client')==0){
            return redirect()->back()->with('status','Cet utilisateur est désormais débloqué !');
        }
    }

*/

public function bloquer($id){
    $personne = User::findOrFail($id);

    $personne->role = $personne->role.',bloquer';
    $personne->save(); 
    $annonce_b = Annonce::where('id_user', $id)->get();
    foreach ($annonce_b as $an) {
        $an->status = $an->status.',bloquer';
        $an->save();
    }
    if(strcmp($personne->role,'client,bloquer')==0 ){
        return redirect()->back()->with('status','Cet utilisateur est désormais bloqué !');
    }
    
}
public function débloquer($id){
    $personne = User::findOrFail($id);
    $personne->role = explode(',',$personne->role)[0];
    $personne->save();
    $annonce_b = Annonce::where('id_user', $id)->get();
    foreach ($annonce_b as $an) {
        $an->status = explode(',',$an->status)[0];
        $an->save();
    }
    if(strcmp($personne->role,'client')==0 ){
        return redirect()->back()->with('status','Cet utilisateur est désormais débloqué !');
    }
}
    // public function searchUser(Request $request){
    //     $request->validate([
    //         'q' => 'required'
    //     ]);
    //     $input = $request->input('q');
    
    //     $list_users = User::find($input);
    //     if (!$list_users) {
    //         return view('administrateur.listeUsers')->with('error', 'Utilisateur non trouvé.');
    //     }
    
    //     return view('administrateur.listeUsers', [
    //         'list_users' => [$list_users]
    //     ]);
    // }
    public function searchUser(Request $request)
{
    $request->validate([
        'q' => 'required'
    ]);
    $input = $request->input('q');

    $list_users = User::where('id', $input)
        ->orWhere('nom', 'like', '%'.$input.'%')
        ->where('role', 'not like', 'admin%')
        ->get();
        
    if ($list_users->isEmpty()) {
        return view('administrateur.listeUsers')->with('error', 'Aucun utilisateur correspondant n\'a été trouvé.');
    }

    return view('administrateur.listeUsers', [
        'list_users' => $list_users
    ]);
}


    
    public function searchAnnonce($id, Request $request){
        $user = User::findOrFail($id);
        $request->validate([
            'id_annonce' => 'required'
        ]);
        
        $annonces = DB::table('annonces')
            ->where('id', '=', $request->id_annonce)
            ->get();
        return view('administrateur.listeAnnonces',[
            'user'=>$user,
            'annonces' => $annonces
        ]);
    }
    
}
