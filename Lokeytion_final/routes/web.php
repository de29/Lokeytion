<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Administrateur;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UpdateNotificationsController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[StaticController::class,'index']);
Route::get('/login',[AuthController::class,'login'])->middleware('alreadyLoggedIn');
Route::get('/login',[AuthController::class,'registration'])->middleware('alreadyLoggedIn');
Route::post('/registerUser',[AuthController::class,'registerUser'])->name('registerUser');
Route::post('/loginUser',[AuthController::class,'loginUser'])->name('loginUser');
Route::get('/annonces/{id}',[AnnonceController::class,'profile'])->name('profile');
Route::put('/annonces/{id}',[AnnonceController::class,'update_profile'])->name('update_profile');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::delete('/SupprimerMonCompte',[UserController::class,'SupprimerMonCompte'])->name('SupprimerMonCompte');

//Route::get('/login',[StaticController::class,'login']);

//Route::get('/annonces',[AnnonceController::class,'index'])->name('annonces');

/**Dalal,Ilias */
Route::get('/annonces/{id}',[AnnonceController::class,'showAnnonces'])->middleware('isLoggedIn')->name('annonces');
Route::post('/recherche/{id}',[AnnonceController::class,'chercher'])->name('chercher');
Route::delete('/MesAnnonces/{id}', [AnnonceController::class, 'destroy'])->name('destroy');

Route::delete('/MesObjets/{id}', [AnnonceController::class,'destroyObjet'])->name('destroyObjet');
Route::get('/detail',[AnnonceController::class,'details']);
Route::get('/MesAnnonces/{id}',[AnnonceController::class,'mesannonces'])->name('mesannonces');
Route::get('/MesObjets',[AnnonceController::class,'mesObjets'])->name('mesObjets');
Route::get('/utilisateurs/search', [Administrateur::class,'searchUser'])->name('utilisateurs.search');
Route::post('/annonces/search/{id}', [Administrateur::class,'searchAnnonce'])->name('annonces.search');

Route::get('/administrateur/{id}/liste-annonces',[Administrateur::class,'listeAnnonces'])->name('administrateur.listeAnnonces');
Route::get('/administrateur/{id}/consulter-annonce/{id_annonce}',[Administrateur::class,'consulter_annonce'])->name('administrateur.consulter-annonce');
Route::get('/administrateur/{id}/liste-users',[Administrateur::class,'listeUsers'])->name('administrateur.listeUsers');
Route::get('/administrateur/{id}/consulter-user/{id_client}',[Administrateur::class,'consulter_user'])->name('administrateur.consulter-user');

Route::get('/bloquer_annonce/{id_annonce}',[Administrateur::class,'bloquer_annonce'])->name('administrateur.bloquer_annonce');
Route::get('/débloquer_annonce/{id_annonce}',[Administrateur::class,'débloquer_annonce'])->name('administrateur.débloquer_annonce');
Route::get('/bloquer/{id}',[Administrateur::class,'bloquer'])->name('administrateur.bloquer');
Route::get('/débloquer/{id}',[Administrateur::class,'débloquer'])->name('administrateur.débloquer');


/*Nasr*/
Route::get('/MesDemandes',[DemandeController::class,'showDemande'])->name('Demande.show');
Route::get('/MesDemandes/Refuse/{id}',[DemandeController::class,'refuse'])->name('Demande.refuse');
Route::get('/MesDemandes/Accept/{id}',[DemandeController::class,'accept'])->name('Demande.accept');
Route::get('/MesDemandes/search',[DemandeController::class,'search'])->name('Demande.search');
Route::get('/Comment',[CommentController::class,'showComment']);

Route::get('/AnnonceDemandee',[DemandeController::class,'MesDemandes'])->name('MesDemandes');
Route::get('/contactus',[CommentController::class,'contactus']);


/***Assiya */
Route::get('/MonPanier',[PanierController::class,'showPanier'])->name('showPanier');;
Route::delete('/Monpanier/{id}', [PanierController::class,'deletePanier'])->name('panier.delete');
Route::post('/demandes', [PanierController::class,'storeDemande'])->name('demande.store');
Route::get('/unreadDemandes', function () {
    return view('unreadDemandes');
});


/****TEST*****/
Route::get('/navbar', function () {
    return view('navbar');
});

/**Sabah */
Route::get('/detail/{id}', [AnnonceController::class,'details']) ->name('detail');
Route::post('/addToPanier/{id}', [PanierController::class, 'addToPanier'])->name('addToPanier');
Route::post('/louer/{id}', [DemandeController::class, 'louer'])->name('louer');
Route::get('/Comment/{id}', [CommentController::class, 'Comment'])->name('Comment');
Route::post('/addComment/{id_demande}/{id_annonce}/{role}', [CommentController::class, 'addComment'])->name('addComment');
Route::post('/louer_panier/{id}', [DemandeController::class, 'louer_panier'])->name('louer_panier');

/**Douae */
Route::get('/editAnnonces/{id}', [AnnonceController::class, 'edit'])->name('editAnnonces1');
Route::get('/depotAnnonces/{id}',[AnnonceController::class,'depot'])->name('depot');
Route::get('/ajouterObjet',[AnnonceController::class,'depotObjet'])->name('depotObjet');

Route::post('/store/{id}', [AnnonceController::class, 'store'])->name('store');
Route::post('/storeObjet', [AnnonceController::class, 'storeObjet'])->name('storeObjet');


Route::put('/editAnnonces/{id}', [AnnonceController::class, 'update'])->name('update');

Route::put('/editObjet/{id}', [AnnonceController::class, 'updateObjet'])->name('updateObjet');
Route::get('/editObjet/{id}', [AnnonceController::class, 'editObjet'])->name('editObjet1');
Route::get('/client_profil/{id}',[AnnonceController::class,'client_profil'])->name('client_profil');
Route::get('/proprietaire_profil/{id}',[AnnonceController::class,'proprietaire_profil'])->name('proprietaire_profil');
Route::get('/UserProfil',[UserController::class,'MeClient'])->name('UserProfil');
Route::get('/MePartenaire',[UserController::class,'MePartenaire'])->name('MePartenaire');


Route::put('/demandes/{id}/annuler', [DemandeController::class, 'annuler'])->name('demandes.annuler');

Route::get('/administrateur/dashboard', [DashboardController::class, 'showDashboard'])->name('administrateur.dashboard');


Route::get('/MesDemandes/end/{id}',[DemandeController::class,'endreservation'])->name('Demande.endreservation');
Route::get('/MesDemandes/endclient/{id}',[DemandeController::class,'endreservationclient'])->name('Demande.endreservationclient');  

Route::get('/update_notifications', [UpdateNotificationsController::class, 'updateNotifications'])->name('updateNotifications');


