<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }
    public function registration(){
        return view('login');
    }
    public function registerUser(Request $request){
        $request->validate([
            'email'=>'required|email|unique:users',
            'nom'=>'required',
            'prenom'=>'required',
            'tel'=>'required',
            'ville'=>'required',
            'password'=>'required'

        ], [
            'email.required' => 'Le champ e-mail est obligatoire.',
            'nom.required' => 'Le champ nom est obligatoire.',
            'prenom.required' => 'Le champ prénom est obligatoire.',
            'tel.required' => 'Le champ téléphone est obligatoire.',
            'ville.required' => 'Le champ ville est obligatoire.',
            'password.required' => 'Le champ mot de passe est obligatoire.',
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->tel = $request->tel;
        $user->ville = $request->ville;
        $user->password = Hash::make($request->password);
        $result = $user->save();
        if($result){
            return back()->with('success','Vous êtes inscrit avec succès.');
        }else{
            return back()->with('fail','Something wrong');
        }
    }

    public function loginUser(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ],[
            'email.required' => 'Le champ e-mail est obligatoire.',
            'password.required' => 'Le champ mot de passe est obligatoire.',
        ]);
        $user = User::where('email','=',$request->email)->first();
        if($user && ($user->role=="client" || $user->role=="admin")){
            if(Hash::check($request->password,$user->password)){
                $request->session()->put('loginID',$user->id);
                $request->session()->put('nom',$user->nom);
                $request->session()->put('prenom',$user->prenom);
                $request->session()->put('email',$user->email);
                $request->session()->put('tel',$user->tel);
                $request->session()->put('ville',$user->ville);
                $request->session()->put('photo',$user->photo);
                $request->session()->put('role',$user->role);
                return redirect()->route('annonces',['id' => $user->id]);

            }else{
                return back()->with('fail','Mot de passe incorrect !!');
            }
        }else{
            return back()->with('fail','Cette adresse e-mail n\'est pas enregistrée ou bloquée!!');
        }
    }
    /**public function profile(){
        $data =array();
        if(Session::has('loginID')){
            $data = User::where('id','=',Session::get('loginID'))->first();
        }else{
            $data = [
                'email' => 'john@example.com',
                'nom' => 'John Doe',
                'tel' => '0555555555'
            ];
        }
        return view('profile',['data' => $data]);
    }

    public function update_profile(Request $request){
        $request->validate([

        ]);
        $data =array();
        if(Session::has('loginID')){
            $data = User::where('id','=',Session::get('loginID'))->first();
        }

        $data = User::findOrFail($data->id);

        $data->email = $request->email;
        $data->nom = $request->nom;
        $data->tel = $request->tel;



            if($request->hasfile('photo')){
                $photo = $request->file('photo');
                $extension = $photo->getClientOriginalExtension();
                $nomPhoto = $data->nom.'_'.time().'.'.$extension;
                $photo->move('images/users/',$nomPhoto);
                $data->photo = $nomPhoto;
            }
            $result=$data->save();
            if($result){
                return view('profile', ['data' => $data])->with('status','Modification réussi !');
            }else{
                return back()->with('fail','Something wrong');
            }

            //return back()->with('status','Modification réussi !');
            //return redirect()->route('profile')->with('status','Modification réussi !');

    }*/




    public function logout(){
        if(Session::has('loginID')){
            Session::pull('loginID');
            return redirect('/');
        }
        else {
            return redirect('/');
        }
    }






}
