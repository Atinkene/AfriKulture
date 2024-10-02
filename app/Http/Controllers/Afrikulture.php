<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Partie;
use App\Models\Resultat;
use App\Models\Niveau;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Notifications\NewNotification;



class Afrikulture extends Controller
{
    public function login(){
        //   dd(Auth::user());
        //   $user = User::create([
        //     'login' => 'massina', // Remplacez par le numéro souhaité
        //     'nom' => 'BASSENE', // Remplacez par le nom souhaité
        //     'prenom' => 'Massina Sylvanus', // Remplacez par le prénom souhaité
        //     'classement' => 0, // Remplacez par le statut souhaité
        //     'visibilite' => 1, // Remplacez par le statut souhaité
        //     'status' => 'admin', // Remplacez par le statut souhaité
        //     'email' => 'massinasylvanusbassene@afrikulture.sn', // Remplacez par l'e-mail souhaité
        //     'password' => Hash::make('passer'), // Remplacez par le mot de passe souhaité
        // ]);

        // $user = User::create([
        //     'login' => 'simon', // Remplacez par le numéro souhaité
        //     'nom' => 'KAMATE', // Remplacez par le nom souhaité
        //     'prenom' => 'Simon Ezechiel', // Remplacez par le prénom souhaité
        //     'classement' => 0, // Remplacez par le statut souhaité
        //     'visibilite' => 1, // Remplacez par le statut souhaité
        //     'status' => 'joueur', // Remplacez par le statut souhaité
        //     'email' => 'simonkamate@afrikulture.sn', // Remplacez par l'e-mail souhaité
        //     'password' => Hash::make('passer'), // Remplacez par le mot de passe souhaité
        // ]);

        // $user = User::create([
        //     'login' => 'jasmeen', // Remplacez par le numéro souhaité
        //     'nom' => 'DIAGNE', // Remplacez par le nom souhaité
        //     'prenom' => 'Yacine', // Remplacez par le prénom souhaité
        //     'classement' => 0, // Remplacez par le statut souhaité
        //     'visibilite' => 1, // Remplacez par le statut souhaité
        //     'status' => 'joueur', // Remplacez par le statut souhaité
        //     'email' => 'yacine@afrikulture.sn', // Remplacez par l'e-mail souhaité
        //     'password' => Hash::make('passer'), // Remplacez par le mot de passe souhaité
        // ]);
        // $niveau = Niveau::create([
        //     'nom' => "DEBUTANT",
        //     'force' => "10",
        //     'icone' => " "
        // ]);
        // $niveau = Niveau::create([
        //     'nom' => "INTERMEDIAIRE",
        //     'force' => "20",
        //     'icone' => "1"
        // ]);
        // $niveau = Niveau::create([
        //     'nom' => "EXPERT",
        //     'force' => "40",
        //     'icone' => "2"
        // ]);
          return view ('afrikulture.login',[
              'title' => 'Afrikulture | Connexion'
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
        $parties = Partie::where('dateDebut', '>', now())->paginate(1);
        $couleurs=[];
        foreach ($parties as $key => $partie) {
            $couleurs = $partie->couleurFond;
        }
        // dd($couleurs);
        return view('afrikulture.accueil',[
            'title' => 'Afrikulture | accueil',
            'parties' => $parties,
            'couleurs' => $couleurs,
        ]);
       }

       public function index(){
        return view('afrikulture.register',[
            'title' => 'Afrikulture | Inscription'
            ]);;
       }

       public function classement(){
        $users = User::orderBy('classement','asc')
        ->where('status', 'joueur')
        ->get();
        $userScore = [];
        foreach ($users as $key => $user) {
            $userScore[$key] = Resultat::where('joueur',$user->id)->sum(('score'));

        }
        arsort($userScore);
        return view('afrikulture.classement',[
            'score' => $userScore,
            'users' => $users,
            'title' => 'AfriKulture | Classement'
        ]);
       }
       public function register(Request $request){
            $request->validate([
                'nom' => 'required|string|min:2',
                'prenom' => 'required|string|min:3',
                'email' => 'required|email|min:8|unique:users,email',
                'login' => 'required|string|min:8|unique:users,login',
                'password' => 'required|min:4',
            ]);

            $user = User::create([
                'nom' => $request->input('nom'),
                'prenom' => $request->input('nom'),
                'email' => $request->input('email'),
                'login' => $request->input('login'),
                'password'=> Hash::make($request->input('password')),
                'classement' => 1, // Remplacez par le statut souhaité
                'visibilite' => 1, // Remplacez par le statut souhaité
            ]);

            if($user){
                return to_route('register',[
                    'title' => 'Afrikulture | Inscription'
                    ])->with('success','l\'utilisateur a été enregistré avec succès');
            }
       }

       public function mesNotif(Request $request)
{
    $user = Auth::user();
    // Récupérez les 5 dernières notifications de l'utilisateur
    $notifications = $user->notifications()->latest()->take(50)->get();
    $notificationData = [];

// Parcourez les notifications et extrayez le tableau 'data'
foreach ($notifications as $notification) {
    $notificationData[] = $notification;
}
    return response()->json($notificationData);
}





public function myNotif(Request $request)
{
    $user = Auth::user();
    // Récupérez les 5 dernières notifications de l'utilisateur
    $notifications = $user->notifications()->get();
    $notificationData = [];

// Parcourez les notifications et extrayez le tableau 'data'
foreach ($notifications as $notification) {
    $notificationData[] = $notification;
}
//dd($notificationData);
    return response()->json($notificationData);
}

public function Notif(Request $request, string $slug)
{
    $user = Auth::user();
    // Récupérez les 5 dernières notifications de l'utilisateur
    $notifications = $user->notifications()->where('id',$slug)->first();
    
    return response()->json($notifications);
}
}
