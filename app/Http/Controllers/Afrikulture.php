<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class Afrikulture extends Controller
{
    public function login(){
        //   dd(Auth::user());
        //   $user = User::create([
        //     'login' => '123457', // Remplacez par le numéro souhaité
        //     'nom' => 'BASSENE', // Remplacez par le nom souhaité
        //     'prenom' => 'Massina Sylvanus', // Remplacez par le prénom souhaité
        //     'classement' => 1, // Remplacez par le statut souhaité
        //     'visibilite' => 1, // Remplacez par le statut souhaité
        //     'status' => 'joueur', // Remplacez par le statut souhaité
        //     'email' => 'massinasylvanus@afrikulture.sn', // Remplacez par l'e-mail souhaité
        //     'password' => Hash::make('password'), // Remplacez par le mot de passe souhaité
        // ]);
          return view ('afrikulture.login',[
              'title' => 'E-Laab | Connexion'
              ]);
       }
       public function seconnect(LoginRequest $request){
           $credentials = $request->validated();     
    
           if (Auth::attempt($credentials)) {
               $request->session()->regenerate();     
    
               $user = Auth::user();     
               if ($user->status == 'joueur') {
                   return redirect()->route('JoueurDashboard');
               } elseif ($user->status == 'admin') {
                   return redirect()->route('AdminDashboard');
               }
          }     
    
           return redirect()->route('login')->withErrors([
               'numero' => 'Numéro invalide',
           ])->with('error', 'Les informations d\'identification ne correspondent pas.');
       }
    
      
       public function logout(){
          Auth::logout();
          return to_route('accueil');
       }
    
       public function accueil(){
        return view('afrikulture.accueil');
       }
}
