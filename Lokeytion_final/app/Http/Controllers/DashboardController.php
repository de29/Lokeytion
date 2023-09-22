<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use App\Models\User;
use PHPUnit\Framework\Constraint\IsEmpty;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Annonce;
use App\Models\Objet;
class DashboardController extends Controller
{
    public function showDashboard(){
        $totalUsers = User::where('role', 'client')->count();
        $totalAnnonces = Annonce::where('status', 'active')->count();
        $totalObjets = Objet::count();
        $totalDemandes = Demande::count();
        $usersByCity = User::selectRaw('ville, COUNT(*) as count')
        ->groupBy('ville')
        ->get();


        $objectsByUser = DB::table('objets')
    ->join('users', 'users.id', '=', 'objets.id_user')
    ->selectRaw('users.nom, COUNT(*) as count')
    ->groupBy('objets.id_user', 'users.nom')
    ->get();

    $annonces = DB::table('annonces')
    ->join('objets', 'objets.id', '=', 'annonces.id_objet')
    ->join('users', 'users.id', '=', 'objets.id_user')
    ->leftJoin('comments_annonce', 'comments_annonce.id_annonce', '=', 'annonces.id')
    ->select('annonces.id as id_annonce','annonces.titre','annonces.created_at', 'objets.image1', 'users.nom', 'users.prenom', DB::raw('COUNT(comments_annonce.id) as comment_count'))
    ->groupBy('annonces.id','objets.id','annonces.created_at',  'annonces.titre', 'objets.image1', 'users.nom', 'users.prenom')
    ->get();

   


    $annoncesParObjet = Objet::select('nom', DB::raw('COUNT(annonces.id) as total'))
    ->join('annonces', 'objets.id', '=', 'annonces.id_objet')
    ->groupBy('nom')
    ->get();


    // Initialiser un tableau vide pour stocker tous les jours
$jours = [];

// Récupérer toutes les annonces
$annonces_ = Annonce::all();

// Boucler sur chaque annonce pour extraire les jours disponibles
foreach ($annonces_ as $annonce) {
    $joursDispo = explode(',', $annonce->joursDispo);
    foreach ($joursDispo as $jour) {
        $jour = trim($jour);
        array_push($jours, $jour);
    }
}

// Compter les occurrences de chaque jour et les stocker dans un tableau associatif
$jours_counts = array_count_values($jours);


        return view('administrateur.dashboard', ['totalUsers' => $totalUsers,
                     'totalAnnonces' => $totalAnnonces,'totalObjets' => $totalObjets,
                     'totalDemandes' => $totalDemandes,'objectsByUser'=>$objectsByUser,
                     'usersByCity'=>$usersByCity,'annonces'=>$annonces,
                     'annoncesParObjet'=>$annoncesParObjet,'jours_counts' =>$jours_counts
                    ]);
    }
}
