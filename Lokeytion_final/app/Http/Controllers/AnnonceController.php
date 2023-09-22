<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PHPUnit\Framework\Constraint\IsEmpty;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Annonce;
use App\Models\Objet;

class AnnonceController extends Controller
{

    public function showAnnonces($id)
    {
        $data = User::findOrFail($id);

        DB::table('annonces')
            ->where('a', '<', now()->toDateString())
            ->update(['status' => 'non']);

            $annonce_display = DB::table('annonces')
            ->join('objets', 'annonces.id_objet', '=', 'objets.id')
            ->leftJoin(DB::raw('(SELECT id_annonce, AVG(note) as moyenne FROM comments_annonce GROUP BY id_annonce) as comment_moyenne'), 'annonces.id', '=', 'comment_moyenne.id_annonce')
            ->select('annonces.*', 'objets.id_user', 'objets.nom', 'objets.categorie', 'objets.discription', 'objets.image1', 'objets.image2', 'objets.image3', 'comment_moyenne.moyenne')
            ->where('status', '=', 'active')
            ->where('annonces.id_user', '<>', $id)
            ->orderBy('annonces.created_at', 'desc')
            ->get();


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



        return view('annonces', ['data' => $data, 'annonce_display' => $annonce_display,'nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);
    }


    public function mesannonces($id)
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

        DB::table('annonces')
            ->where('id_user', '=', Session::get('loginID'))
            ->where('id_objet', '=', $id)
            ->where('a', '<', now()->toDateString())
            ->update(['status' => 'non']);

        $annonce_display = DB::table('annonces')
            ->join('objets', 'annonces.id_objet', '=', 'objets.id')
            ->leftJoin(DB::raw('(SELECT id_annonce, AVG(note) as moyenne FROM comments_annonce GROUP BY id_annonce) as comment_moyenne'), 'annonces.id', '=', 'comment_moyenne.id_annonce')
            ->select('annonces.*', 'objets.id_user', 'objets.nom', 'objets.categorie', 'objets.discription', 'objets.image1', 'objets.image2', 'objets.image3', 'comment_moyenne.moyenne')
            ->where('annonces.id_user', '=', Session::get('loginID'))
            ->where('annonces.status', '=', 'active')
            ->where('annonces.id_objet', '=', $id)
            ->orderBy('annonces.created_at', 'desc')
            ->get();

            
        return view('MesAnnonces', [ 'annonce_display' => $annonce_display,'nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);
    }



    public function mesObjets()
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



        $data = User::findOrFail(Session::get('loginID'));
        $objet_display = DB::table('objets')
    ->select('objets.*', 'comment_moyenne.moyenne')
    ->leftJoin('annonces', 'objets.id', '=', 'annonces.id_objet')
    ->leftJoin(DB::raw('(SELECT id_annonce, AVG(note) as moyenne FROM comments_annonce GROUP BY id_annonce) as comment_moyenne'), 'annonces.id', '=', 'comment_moyenne.id_annonce')
    ->where('objets.id_user', '=', $data->id)
    ->groupBy('objets.id', 'objets.id_user','objets.nom','objets.categorie','objets.discription','objets.image1','objets.image2','objets.image3','objets.created_at','objets.updated_at','comment_moyenne.moyenne')
    ->orderBy('objets.created_at', 'desc')
    ->get();

    

        return view('MesObjets', ['data' => $data, 'objet_display' => $objet_display,'nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);
    }

    public function depot($id)
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

        $data = Objet::findOrFail($id);
        return view('depotAnnonce', ['data' => $data,'nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);
    }

    /*public function mesannonces($id){
        $data = User::findOrFail($id);
        $annonce_display = DB::table('annonces')
                        ->where('id_user','=',$data->id)
                        ->where('status','=','oui')
                        ->latest()
                        ->get();

        return view('MesAnnonces',['data'=>$data,'annonce_display'=>$annonce_display]);
    }*/

    /*public function index($id){
        $data = User::findOrFail($id);
        return view('annonces',[
            'user'=>$data,]);
    }*/

    public function profile($id)
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

        $data = array();
        if (Session::has('loginID')) {
            $data = User::findOrFail($id);
        }/*else{
            $data = [
                'email' => 'john@example.com',
                'nom' => 'John Doe',
                'tel' => '0555555555'
            ];
        }*/
        return view('annonces', ['data' => $data,'nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);
    }


    public function client_profil($id)
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

        $user=DB::table('annonces')
        ->join('users', 'users.id', '=', 'annonces.id_user')
        ->where('users.id', $id)
        ->select('users.*')
        ->first();

        $commentaires = DB::table('comments_users')
    ->join('demandes', 'comments_users.id_demande', '=', 'demandes.id')
    ->join('users', 'comments_users.id_commenter', '=', 'users.id')
    ->where('demandes.id_client', '=', $id)
    ->where('comments_users.role', '=', 'partenaire')
    ->select('comments_users.*', 'users.*')
    ->get();



        return view('client_profil', ['commentaires' =>$commentaires],['user' => $user,'nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);
    }


    public function proprietaire_profil($id)
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

        $user=DB::table('annonces')
        ->join('users', 'users.id', '=', 'annonces.id_user')
        ->where('users.id', $id)
        ->select('users.*')
        ->first();

        $commentaires = DB::table('comments_users')
    ->join('annonces', 'comments_users.id_annonce', '=', 'annonces.id')
    ->join('users', 'comments_users.id_commenter', '=', 'users.id')
    ->where('annonces.id_user', $id)
    ->where('comments_users.role', 'client')
    ->select('comments_users.*', 'users.*')
    ->get();



        return view('proprietaire_profil', ['commentaires' =>$commentaires],['user' => $user,'nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);
    }

    public function update_profile(Request $request, $id)
    {

        $request->validate([]);
        //$data = User::findOrFail($id);
        /*$data =array();
        if(Session::has('loginID')){
            $data = User::where('id','=',Session::get('loginID'))->first();
        }*/

        $data = User::findOrFail($id);

        $data->email = $request->email;
        $request->session()->put('email', $data->email);
        $data->nom = $request->nom;
        $request->session()->put('nom', $data->nom);
        $data->tel = $request->tel;
        $request->session()->put('tel', $data->tel);
        $data->ville = $request->ville;
        $request->session()->put('ville', $data->ville);



        if ($request->hasfile('photo')) {
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension();
            $nomPhoto = $data->nom . '_' . time() . '.' . $extension;
            $photo->move('images/users/', $nomPhoto);
            $data->photo = $nomPhoto;
            $request->session()->put('photo', $data->photo);
        }
        $result = $data->save();
        if ($result) {
            //return view('profile', ['data' => $data])->with('status','Modification réussi !');
            return redirect()->route('annonces', ['id' => $data->id])->with('status', 'Modification réussie !');
        } else {
            return back()->with('fail', 'Something wrong');
        }

        //return back()->with('status','Modification réussi !');
        //return redirect()->route('profile')->with('status','Modification réussi !');
    }


    public function chercher(Request $request, $id)
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

        $request->validate([
            //'Categorie' => 'required',
            //'prix' => 'required',
            //'ville' => 'required'
        ]);
        //$categorie = null;
        //$ville = null;
        //$prix_jour = null;


        /*foreach($request->input('categorie') as $cat){
        $categorie = $cat;
    }*/

        /*foreach($request->input('prix') as $prx){
        $prix_jour = $prx;
    }*/
        //$tab = explode(" ",$prix_jour);
        /*$prix_min = $tab[0];
    $prix_max = $tab[1];*/

        /*foreach($request->input('ville') as $vil){
        $ville = $vil;rech
    }*/
        $data = User::findOrFail($id);
        /*$annonce_recherche = DB::table('annonces')
    ->orwhere('ville', '=', $request->input('ville'))
    ->orwhere('prix', '=', $request->input('prix'))
    ->where('status','=','active')
    ->get();*/

        $prix = $request->input('prix') ? $request->input('prix')[0] : null;
        $ville = $request->input('ville') ? $request->input('ville')[0] : null;
        $cat = $request->input('categorie') ? $request->input('categorie')[0] : null;
        $dateDebut = $request->input('dateDebut') ? $request->input('dateDebut')[0] : null;
        $dateFin = $request->input('dateFin') ? $request->input('dateFin')[0] : null;


        $notes = $request->input('note') ? $request->input('note')[0] : null;


        $query = DB::table('annonces')
            ->join('objets', 'annonces.id_objet', '=', 'objets.id')
            ->leftJoin('comments_annonce', 'annonces.id', '=', 'comments_annonce.id_annonce')
            ->select('annonces.*', 'objets.id_user', 'objets.nom', 'objets.categorie', 'objets.discription', 'objets.image1', 'objets.image2', 'objets.image3', DB::raw('count(comments_annonce.id) as nb_comments'), DB::raw('avg(comments_annonce.note) as moyenne'))
            ->where('status', '=', 'active')
            ->where('annonces.id_user', '!=',Session::get('loginID') )
            ->groupBy('annonces.id', 'annonces.id_objet', 'objets.nom', 'objets.categorie', 'objets.discription', 'objets.image1', 'objets.image2', 'objets.image3','annonces.id_user','annonces.titre','annonces.ville','annonces.prix','annonces.status','annonces.created_at','annonces.updated_at','annonces.de','annonces.a','annonces.joursDispo','annonces.nbr_min_location','objets.id_user');



        if ($prix) {
            $tab = explode(" ", $prix);
            $prix_min = $tab[0];
            $prix_max = $tab[1];
            $query->where('prix', '>=', $prix_min);
            $query->where('prix', '<', $prix_max);
        }

        if ($notes) {
            $tab2 = explode(" ", $notes);
            $note_min = $tab2[0];
            $note_max = $tab2[1];
            $query->having(DB::raw('COALESCE(moyenne, 0)'), '>=',  $note_min);
            $query->having(DB::raw('COALESCE(moyenne, 0)'), '<=', $note_max);
        }

        if ($ville) {
            $query->where('ville', '=', $request->input('ville'));
        }
        if ($cat) {
            $query->where('categorie', '=', $request->input('categorie'));
        }
        if ($request->input('dateDebut')) {
            $dateDebut = date('Y-m-d', strtotime($request->input('dateDebut')));
            $query->where('de', '<=', $dateDebut);
        }

        if ($request->input('dateFin')) {
            $dateFin = date('Y-m-d', strtotime($request->input('dateFin')));
            $query->where('a', '>=', $dateFin);
        }


        $annonce_display = $query->get();



        return view('annonces', [
            'data' => $data,
            'annonce_display' => $annonce_display ?? null,
            'nbr_notification'=>$nbr_notification,
            'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar
        ]);
    }

    public function destroy($id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->delete();

        return redirect()->back()->with('deleted', 'L\'annonce est supprimé avec succès !');
    }

    public function destroyObjet($id)
{
    $objet = Objet::find($id); // retrieve the object by its ID

    if (!$objet) {
        return redirect()->back()->with('error', 'Objet not found.');
    }

    $objet->delete(); // delete the object
    Annonce::where('id_objet', $id)->delete();
    return redirect()->back()->with('success', 'Objet deleted successfully.');
}



    public function details($id)
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


        $datesDemandes = null;

       


        $demandes = DB::table('annonces')
            ->join('demandes', 'demandes.id_annonce', '=', 'annonces.id')
            ->join('users', 'users.id', '=', 'demandes.id_client')
            ->where('annonces.id', $id)
            ->where('demandes.etat','en attente')
            ->select('demandes.jour_reservation')
            ->get();

        foreach ($demandes as $demande) {
            $dates = explode(',', $demande->jour_reservation);
            foreach ($dates as $date) {
                $datesDemandes[] = trim($date);
            }
        }


        $annonce_objet = DB::table('annonces')
            ->join('objets', 'annonces.id_objet', '=', 'objets.id')
            ->join('users', 'users.id', '=', 'annonces.id_user')
            ->select('annonces.*','users.nom','users.prenom','users.photo', 'objets.categorie', 'objets.discription', 'objets.image1', 'objets.image2', 'objets.image3')
            ->where('annonces.id', $id)
            ->first();

            $commentaires = DB::table('comments_annonce')
            ->join('annonces', 'annonces.id', '=', 'comments_annonce.id_annonce')
            ->join('objets', 'objets.id', '=', 'annonces.id_objet')
            ->join('users', 'users.id', '=', 'comments_annonce.id_commenter')
            ->where('objets.id', '=', $annonce_objet->id_objet)
            ->get(['comments_annonce.*', 'users.*']);

        if ($commentaires->isEmpty()) {
            return view('Product_details', compact('demandes', 'annonce_objet', 'datesDemandes','nbr_notification','nbr_panier','notification_navbar'));
        }

        return view('Product_details', compact('commentaires', 'demandes', 'annonce_objet', 'datesDemandes','nbr_notification','nbr_panier','notification_navbar'));
    }

    public function edit($id)
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

        $annonce = DB::table('annonces')
            ->join('objets', 'annonces.id_objet', '=', 'objets.id')
            ->where('annonces.id', $id)
            ->select('annonces.*', 'objets.categorie', 'objets.discription', 'objets.image1', 'objets.image2', 'objets.image3')
            ->first();

        $joursDispo = explode(',', $annonce->joursDispo);
        return view('editAnnonce', ['annonce' => $annonce, 'joursDispo' => $joursDispo,'nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);
    }

    public function editObjet($id)
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
        
        $objet = DB::table('objets')
            ->where('objets.id', $id)
            ->select('objets.*')
            ->first();

        return view('editObjet', ['objet' => $objet,'nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);
    }


    public function store(Request $request,$id)
    {
        $annonces = Annonce::where('id_user', Session::get('loginID'))
        ->where('status', 'active')
        ->get();
         $nb_annonces = $annonces->count(); 

if($nb_annonces<5){
        $validatedData = $request->validate([
            'prix' => 'required|numeric',
            'ville' => 'required',
            'dateDebut' => 'required|date|after_or_equal:today',
            'dateFin' => 'required|date|after_or_equal:dateDebut',
            'nbr_jours' => 'required',
            'jours' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (count($value) < 1) {
                        $fail('Au moins un jour doit être sélectionné.');
                    }
                },
            ],
        ], [
            'prix.required' => 'Le champ prix est obligatoire.',
            'ville.required' => 'Le champ prix est obligatoire.',
            'dateDebut.required' => 'La date de début doit être renseignée et être ultérieure ou égale à la date d\'aujourd\'hui.',
            'dateFin.required' => 'Le champ date Fin est obligatoire.',
            'jours.required' => 'Le champ jours est obligatoire.',
            'nbr_jours.required' => 'Le nombre de jours minimum de location est obligatoire.',

        ]);

        $objet = Objet::findOrFail($id);


        $jours = $validatedData['jours'];
        $jours_str = implode(',', $jours);

        $annonce = new Annonce;
        $annonce->id_objet = $id;
        $annonce->id_user = Session::get('loginID');
        $annonce->titre = $objet->nom;
        $annonce->prix = $validatedData['prix'];
        $annonce->ville = $validatedData['ville'];
        $annonce->de = $validatedData['dateDebut'];
        $annonce->a = $validatedData['dateFin'];
        $annonce->joursDispo =  $jours_str;
        $annonce->status = 'active';
        $annonce->nbr_min_location =  $validatedData['nbr_jours'];
        $annonce->save();


        return redirect()->route('mesObjets')->with('annonceCreer', 'Annonce créée avec succès !');
}else{
    return redirect()->route('mesObjets')->with('cinqAnnonce', 'vous ayez atteint le nombre maximum d\'annonces en ligne pour le moment !');

}}


    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'prix' => 'required|numeric',
            'ville' => 'required|string|max:255',
            'nbr_jours' => 'required',
            'joursDispo' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (count($value) < 1) {
                        $fail('Au moins un jour doit être sélectionné.');
                    }
                },
            ],
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after_or_equal:dateDebut',
        ], [
            'prix.required' => 'Le champ prix est obligatoire.',
            'ville.required' => 'Le champ prix est obligatoire.',
            'dateDebut.required' => 'La date de début doit être renseignée et être ultérieure ou égale à la date d\'aujourd\'hui.',
            'dateFin.required' => 'La date de fin est obligatoire et doit être postérieure ou égale à aujourd\'hui.',
            'joursDispo.required' => 'Le champ des jours disponible est obligatoire.',
            'nbr_jours.required' => 'Le nombre de jours minimum de location est obligatoire.',

        ]);
        // Récupérer l'annonce à modifier
        $annonce = Annonce::findOrFail($id);
        // Mettre à jour les propriétés de l'annonce avec les valeurs du formulaire
        $annonce->prix = $request->input('prix');
        $annonce->ville = $request->input('ville');
        $annonce->joursDispo = implode(',', $request->input('joursDispo'));
        $annonce->de = $request->input('dateDebut');
        $annonce->a = $request->input('dateFin');
        $annonce->nbr_min_location =  $request->input('nbr_jours');


        
        // Enregistrer les modifications dans la base de données
        $annonce->save();
        $objet = Objet::findOrFail($annonce->id_objet);

        // Rediriger l'utilisateur vers la page d'accueil avec un message de confirmation
        // return redirect('/editAnnonces/{id}')->with('success', 'L\'annonce a été modifiée avec succès.');

        return redirect()->route('mesannonces', $objet->id)->with('success', 'Annonce créée avec succès !');
    }


    public function updateObjet(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'titre' => 'required|string|max:255',
            'discription' => 'required|string',
            'image.*' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ], [
            'titre.required' => 'Vous devez remplir le champ titre.',
            'discription.required' => 'Vous devez remplir le champ description.',
            'image.required' => 'Veuillez sélectionner une image. Ce champ est obligatoire.',
            

        ]);
        // Récupérer l'annonce à modifier
        $objet = Objet::findOrFail($id);

        // Mettre à jour les propriétés de l'annonce avec les valeurs du formulaire
        $objet->nom = $request->input('titre');
        $objet->discription = $request->input('discription');
        
        // Gérer les images
$files = $request->file('image');
if (!empty($files)) {
    foreach ($files as $key => $file) {
        $filename = $key + 1;
        if ($file) {
            $filePath = 'images/annonces/' . $file->getClientOriginalName(); // or any path you want
            $objet->setAttribute("image{$filename}", $file->storeAs( '', $file->getClientOriginalName()));
        }
    }
}
        
        // Enregistrer les modifications dans la base de données
        $objet->save();
        // Rediriger l'utilisateur vers la page d'accueil avec un message de confirmation
        // return redirect('/editAnnonces/{id}')->with('success', 'L\'annonce a été modifiée avec succès.');

        return redirect()->route('mesObjets', ['id' => Session::get('loginID')])->with('updateObjet', 'Objet Modifier avec succès !');
    }








    public function depotObjet()
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
        return view('ajouterObjet', ['nbr_notification'=>$nbr_notification,'nbr_panier'=>$nbr_panier,'notification_navbar'=>$notification_navbar]);

    }


public function storeObjet(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|max:255',
            'discription' => 'required',
            'categorie' => 'required',
            'image' => 'required|array|min:1|max:3',
        'image.*' => 'required|file|mimes:jpeg,png,jpg|max:2048',
          
        ], [
            'titre.required' => 'Vous devez remplir le champ titre.',
            'discription.required' => 'Vous devez remplir le champ description.',
            'categorie.required' => 'Veuillez sélectionner une catégorie.',
            'image.required' => 'Veuillez sélectionner une image. Ce champ est obligatoire.',
            

        ]);


        // Récupérez les fichiers téléchargés
        $files = $request->file('image');

            $objet = new Objet;
            $objet->id_user = Session::get('loginID');
            $objet->nom = $validatedData['titre'];
            $objet->categorie = $validatedData['categorie'];
            $objet->discription = $validatedData['discription'];

            // Enregistrez chaque fichier dans la base de données
$files = $request->file('image');
foreach ($files as $key => $file) {
    $filename = $key + 1;
    $filePath = 'images/annonces/' . $file->getClientOriginalName(); // or any path you want
    $objet->setAttribute("image{$filename}", $file->storeAs( '', $file->getClientOriginalName()));
}

$objet->save();


        
        return redirect()->route('mesObjets', ['id' => Session::get('loginID')])->with('objet', 'Objet créée avec succès !');
    }


}