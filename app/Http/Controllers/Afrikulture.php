<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Partie;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class Afrikulture extends Controller
{
    public function login(){
        //   dd(Auth::user());
        //   $user = User::create([
        //     'login' => 'simon', // Remplacez par le numéro souhaité
        //     'nom' => 'KAMATE', // Remplacez par le nom souhaité
        //     'prenom' => 'Simon', // Remplacez par le prénom souhaité
        //     'classement' => 1, // Remplacez par le statut souhaité
        //     'visibilite' => 1, // Remplacez par le statut souhaité
        //     'status' => 'joueur', // Remplacez par le statut souhaité
        //     'email' => 'simonkamate@afrikulture.sn', // Remplacez par l'e-mail souhaité
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
        $parties = Partie::where('dateDebut', '<', now())->paginate(1);
        $couleurs=[];
        foreach ($parties as $key => $partie) {
            $couleurs = $partie->couleurFond;
        }
        // dd($couleurs);
        return view('afrikulture.accueil',[
            'parties' => $parties,
            'couleurs' => $couleurs,
        ]);
       }
}
