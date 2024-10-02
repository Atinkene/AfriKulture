<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Partie;
use App\Notifications\NewNotification;
use App\Models\User;
use App\Models\Question;
use App\Models\Proposition;
use App\Models\Niveau;
use App\Models\Partiejoueur;
use App\Http\Requests\creerFormEvaluation;
use App\Http\Requests\creerFormPartieImage;
use Carbon\Carbon;

class Admin extends Controller
{
   
    public function dashboard(Request $request){
        $message1 = 'Bienvenue, ';
      $message2 = Auth::user()->prenom.' '.Auth::user()->nom;

        $partie = Partie::where('admin',auth()->id())
        ->where('dateDebut','>',now())
        ->get();
        $nbPartie = $partie->count();

        $totalPartie = Partie::where('admin',auth()->id())
        ->where('dateDebut','<=',now())
        ->get();
        $totalPartieAchevee = $totalPartie->count();

        $totalPartieCree = Partie::where('admin',auth()->id())
        ->count();


        $plans = Partie::orderBy('dateDebut')
        ->where('admin', auth()->id())
        ->where('dateDebut', '>=', now())
        ->paginate(6);

        $planElems = Partie::orderBy('dateDebut')
        ->where('admin', auth()->id())
        ->where('dateDebut', '>=', now())
        ->get();

        $planningJour=[];
        foreach ($plans as $key => $plan) {
           $planningJour[$key] = Carbon::parse($plan['dateDebut'])->translatedFormat('j F Y');
        }
        
        
        // // dd($planningJour, $planningMoisAnnee);

        return view('admin.dashboard',[
            'planElems' => $planElems,
            'plans' => $plans,
            'enattente' => $nbPartie,
            'totalPartie' => $totalPartieCree,
            'totalPartieAchevee' => $totalPartieAchevee,
            'planningJour' => $planningJour,
            'message1' => $message1,
          'message2' => $message2,
        ]);
    }
    public function test(Request $request){

        $partie = Partie::where('admin',auth()->id())
        ->where('dateDebut','>',now())
        ->get();
        $nbPartie = $partie->count();

        $totalPartie = Partie::where('admin',auth()->id())
        ->where('dateDebut','<=',now())
        ->get();
        $totalPartieAchevee = $totalPartie->count();

        $totalPartieCree = Partie::where('admin',auth()->id())
        ->count();


        $plans = Partie::orderBy('dateDebut')
        ->where('admin', auth()->id())
        ->where('dateDebut', '>=', now())
        ->paginate(6);

        $planElems = Partie::orderBy('dateDebut')
        ->where('admin', auth()->id())
        ->where('dateDebut', '>=', now())
        ->get();

        $planningJour=[];
        $planningMoisAnnee=[];
        foreach ($plans as $key => $plan) {
           $planningJour[$key] = Carbon::parse($plan['dateDebut'])->translatedFormat('j');
           $planningMoisAnnee[$key] = Carbon::parse($plan['dateDebut'])->translatedFormat('F Y');
        }
        
        
        // // dd($planningJour, $planningMoisAnnee);

        return view('admin.test',[
            'planElems' => $planElems,
            'plans' => $plans,
            'enattente' => $nbPartie,
            'totalPartie' => $totalPartieCree,
            'totalPartieAchevee' => $totalPartieAchevee,
            'planningJour' => $planningJour,
            'planningMoisAnnee' => $planningMoisAnnee,
        ]);
    }
    public function parties(){
        $message1 = 'Parties';
        $message2 = '';
        $parties = Partie::get();
        $planningJour=[];
      foreach ($parties as $key => $partie) {
        $planningJour[$key] = Carbon::parse($partie['dateDebut'])->translatedFormat('j F Y');
    }
        //dd($parties);
        return view('admin.parties',[
            'parties' => $parties,
            'message1' => $message1,
          'message2' => $message2,
         'planningJour' => $planningJour,

        ]);
    }
    
    public function planning(){
        $message1 = 'planning ';
        $message2 = '';
        $plans = Partie::orderBy('dateDebut')
        ->where('admin', auth()->id())
        ->where('dateDebut', '>=', now())
        ->paginate(6);

        $planElems = Partie::orderBy('dateDebut')
        ->where('admin', auth()->id())
        ->where('dateDebut', '>=', now())
        ->get();

        $planningJour=[];
        foreach ($plans as $key => $plan) {
           $planningJour[$key] = Carbon::parse($plan['dateDebut'])->translatedFormat('j F Y');
        }
        

        return view('admin.planning',[
            'planElems' => $planElems,
            'plans' => $plans,
            'planningJour' => $planningJour,
            'message1' => $message1,
            'message2' => $message2,
        ]);

    }

    public function Partie($id){
        $message1 = 'Information de la partie ';
        $message2 = '';
        $partie = Partie::where('id',$id)->first();
        $questions = Question::where('partie',$id)->get();
        $propositions = [];
        
    
        foreach ($questions as $question) {  
            $propositions[] = Proposition::where('question',$question->id)->get();
        }
    
        return view('admin.partie', [
            'partie' => $partie,
            'propositions' => $propositions,
            'questions' => $questions,
            'message1' => $message1,
            'message2' => $message2,
        ]);
    }

    public function partieImage($id){
        $message1 = 'Information de la partie ';
        $message2 = '';
        $partie = Partie::where('id',$id)->first();
        $questions = Question::where('partie',$id)->get();
        $propositions = [];
        
    
        foreach ($questions as $question) {  
            $propositions[] = Proposition::where('question',$question->id)->get();
        }
    
        return view('admin.partieImage', [
            'partie' => $partie,
            'propositions' => $propositions,
            'questions' => $questions,
            'message1' => $message1,
            'message2' => $message2,
        ]);
    }
    
    public function AdminCreePartie(){
        Session()->forget('partie');
        $message1 = 'Création de la partie ';
        $message2 = '';
        $niveaux = Niveau::get();
        return view('admin.CreePartie',[
            'niveaux' =>$niveaux,
            'message1' => $message1,
          'message2' => $message2,
        ]);
    }
    public function AdminCreePartieImage(){
        $message1 = 'Information de la partie ';
        $message2 = '';
        Session()->forget('partie');
        $niveaux = Niveau::get();
        return view('admin.CreerPartieImage',[
            'niveaux' =>$niveaux,
            'message1' => $message1,
            'message2' => $message2,
        ]);
    }

    public function AdminPostCreePartie(creerFormEvaluation $request)
{
    // Récupérer les données validées du formulaire
    
    $donneesValidees = $request->validated();
    // dd($donneesValidees);
    // Stocker les données validées en session
    $partie = [
        'nom' => $donneesValidees['nom'],
        'date' => $donneesValidees['date'],
        'debut' => $donneesValidees['debut'],
        'duree' => $donneesValidees['duree'],
        'niveau' => $donneesValidees['niveau'],
        'description' => $donneesValidees['description'],
        'joueurAnonyme' => $donneesValidees['joueurAnonyme'],
        'type' => $donneesValidees['type'],
        'questions' => [],
    ];

    foreach ($donneesValidees['questions'] as $index => $question) {
        $partie['questions'][$index]['libelle'] = $question['libelle'];
        $partie['questions'][$index]['points'] = $question['points'];
        $partie['questions'][$index]['propositions'] = $donneesValidees['propositions'][$index];
    }

    // Stocker l'évaluation complète en session
    session()->put('partie', $partie);
   
    // Rediriger ou effectuer d'autres actions
    return redirect()->route('AdminBilanPartie')->with('success', 'Message de succès ici');
}

public function AdminPostCreePartieImage(creerFormPartieImage $request)
{
    // Récupérer les données validées du formulaire
    $donneesValidees = $request->validated();

    // Initialiser le tableau de données de la partie
    $partie = [
        'nom' => $donneesValidees['nom'],
        'date' => $donneesValidees['date'],
        'debut' => $donneesValidees['debut'],
        'duree' => $donneesValidees['duree'],
        'niveau' => $donneesValidees['niveau'],
        'description' => $donneesValidees['description'],
        'joueurAnonyme' => $donneesValidees['joueurAnonyme'],
        'type' => $donneesValidees['type'],
        'questions' => [],
    ];

    // Boucler à travers les questions pour traiter les fichiers d'image
    foreach ($donneesValidees['questions'] as $index => $question) {
        // Vérifier s'il y a un fichier d'image téléchargé
        if ($request->hasFile("questions.{$index}.libelle")) {
            // Télécharger le fichier et obtenir le chemin d'accès
            $path = $request->file("questions.{$index}.libelle")->store('imagePartie','public');

            // Stocker le chemin d'accès dans les données de la question
            $partie['questions'][$index]['libelle'] = $path;
        } else {
            $partie['questions'][$index]['libelle'] = null;
        }

        // Stocker les autres données de la question
        $partie['questions'][$index]['points'] = $question['points'];
        $partie['questions'][$index]['propositions'] = $donneesValidees['propositions'][$index];
    }

    // Stocker l'évaluation complète en session
    session()->put('partie', $partie);

    // Rediriger ou effectuer d'autres actions
    return redirect()->route('AdminBilanPartieImage')->with('success', 'Message de succès ici');
}



public function AdminPostBilanPartie(Request $request)
{
    // Récupérer l'évaluation depuis la session
    $partie = $request->session()->get('partie');

    // Parcourir chaque question
    foreach ($partie['questions'] as $key => $question) {
        // Récupérer les corrections pour cette question à partir des données soumises
        $corrections = $request->input('corrections.' . $key, []);
        
        // Mettre à jour les corrections dans le tableau d'évaluation
        $partie['questions'][$key]['corrections'] = $corrections;
    }

    // Afficher ou traiter les corrections pour chaque question (pour déboguer)
    foreach ($partie['questions'] as $key => $question) {
        echo "Corrections pour la question " . $key . ": ";
        print_r($question['corrections']);
        echo "<br>";
    }

    // Valider et traiter les fichiers téléchargés
    $miniature = $request->hasFile('miniature') ? $this->upload($request, 'miniature') : null;
    $imageFond = $request->hasFile('imageFond') ? $this->upload($request, 'imageFond') : null;
    $couleurFond = $request->input('couleurFond');

    // Vous pouvez maintenant utiliser les chemins $miniaturePath, $imageFondPath, $couleurFondPath comme nécessaire
    
    $joueurAnonyme = $request->input('joueurAnonyme');
    if ($joueurAnonyme) {
        $partie['joueurAnonyme'] = $joueurAnonyme;
    }else{
        $partie['joueurAnonyme'] = 0;
    }
    $partie['description'] = $request->input('description');
    $partie['miniature'] = $miniature;
    $partie['imageFond'] = $imageFond;
    $partie['couleurFond'] = $couleurFond;
    // Mettre à jour la session avec les modifications apportées
    session()->put('partie', $partie);
    // dd($request->hasFile('miniature'));

    // Insérer la nouvelle évaluation dans la base de données
    $datetime = $partie['date'] . ' ' . $partie['debut'] . ':00';
    $niveau = Niveau::where('nom',$partie['niveau'])->value('id');
    $newEvaluation = Partie::create([
        'nom' => $partie['nom'],
        'description' => $partie['description'],
        'duree' => $partie['duree'],
        'dateDebut' => $datetime,
        'HeureDebut' => $partie['debut'],
        'miniature' => $partie['miniature'],
        'imageFond' => $partie['imageFond'],
        'couleurFond' => $partie['couleurFond'],
        'joueurAnonyme' => $partie['joueurAnonyme'],
        'niveau' => $niveau,
        'admin' => Auth::user()->id,
        'visibilite' => 1,
        'type' => $partie['type']
    ]);

    // Récupérer l'ID de la partie nouvellement créée
    $idPartie = $newEvaluation->id;
    
    // Insérer chaque question et ses propositions dans la base de données
    foreach ($partie['questions'] as $question) {
        $questionCreate = Question::create([
            'libelle' => $question['libelle'],
            'nombrepoint' => $question['points'],
            'partie' => $idPartie
        ]);
        
        $idQuestion = $questionCreate->id;
        
        // Insérer chaque proposition pour la question actuelle
        foreach ($question['propositions'] as $proposition) {
            $newProposition = Proposition::create([
                'libelle' => $proposition,
                'question' => $idQuestion,
                'estCorrecte' => 0,
            ]);
        }

        // Marquer les propositions correctes pour cette question
        foreach ($question['corrections'] as $correct) {
            $idPropo = Proposition::where('libelle', $correct)->where('question', $idQuestion)->latest('id')->first();
            if ($idPropo) {
                $idPropo->estCorrecte = 1;
                $idPropo->save();
            }
        }
        
    }
    $partie = Partie::where('id',$idPartie)->first();
        $titre = "Nouvelle partie bientôt disponible";
        $url = "/joueur/manotification/".$partie->id;

        $message = "Bonjour " . Auth::user()->login . "! La partie \"" . $partie->nom . "\" vient d'être créée. Pour la découvrir, cliquez sur le lien ci-dessous.";

        $link=url('http://localhost:8000/joueur/partie/'.$partie->id);
    $joueurs = User::where('status','joueur')->get();
    foreach ($joueurs as $key => $joueur) {
        $joueur->notify(new NewNotification($titre, $message,$link,$url));
    }

    // Rediriger avec un message de succès
    return redirect()->route('AdminParties')->with('success', 'La partie ' . $partie['nom'] . ' a été créée avec succès!');
}


public function AdminPostBilanPartieImage(Request $request)
{
    // Récupérer l'évaluation depuis la session
    $partie = $request->session()->get('partie');

    // Parcourir chaque question
    foreach ($partie['questions'] as $key => $question) {
        // Récupérer les corrections pour cette question à partir des données soumises
        $corrections = $request->input('corrections.' . $key, []);
        
        // Mettre à jour les corrections dans le tableau d'évaluation
        $partie['questions'][$key]['corrections'] = $corrections;
    }

    // Afficher ou traiter les corrections pour chaque question (pour déboguer)
    foreach ($partie['questions'] as $key => $question) {
        echo "Corrections pour la question " . $key . ": ";
        print_r($question['corrections']);
        echo "<br>";
    }

    // Valider et traiter les fichiers téléchargés
    $miniature = $request->hasFile('miniature') ? $this->upload($request, 'miniature') : null;
    $imageFond = $request->hasFile('imageFond') ? $this->upload($request, 'imageFond') : null;
    $couleurFond = $request->input('couleurFond');

    // Vous pouvez maintenant utiliser les chemins $miniaturePath, $imageFondPath, $couleurFondPath comme nécessaire
    
    $joueurAnonyme = $request->input('joueurAnonyme');
    if ($joueurAnonyme) {
        $partie['joueurAnonyme'] = $joueurAnonyme;
    }else{
        $partie['joueurAnonyme'] = 0;
    }
    $partie['description'] = $request->input('description');
    $partie['miniature'] = $miniature;
    $partie['imageFond'] = $imageFond;
    $partie['couleurFond'] = $couleurFond;
    // Mettre à jour la session avec les modifications apportées
    session()->put('partie', $partie);
    // dd($request->hasFile('miniature'));

    // Insérer la nouvelle évaluation dans la base de données
    $datetime = $partie['date'] . ' ' . $partie['debut'] . ':00';
    $niveau = Niveau::where('nom',$partie['niveau'])->value('id');
    $newEvaluation = Partie::create([
        'nom' => $partie['nom'],
        'description' => $partie['description'],
        'duree' => $partie['duree'],
        'dateDebut' => $datetime,
        'HeureDebut' => $partie['debut'],
        'miniature' => $partie['miniature'],
        'imageFond' => $partie['imageFond'],
        'couleurFond' => $partie['couleurFond'],
        'joueurAnonyme' => $partie['joueurAnonyme'],
        'niveau' => $niveau,
        'admin' => Auth::user()->id,
        'visibilite' => 1,
        'type' => 'image'
    ]);

    // Récupérer l'ID de la partie nouvellement créée
    $idPartie = $newEvaluation->id;
    
    
    // Insérer chaque question et ses propositions dans la base de données
    foreach ($partie['questions'] as $question) {
        $questionCreate = Question::create([
            'libelle' => $question['libelle'],
            'nombrepoint' => $question['points'],
            'partie' => $idPartie
        ]);
        
        $idQuestion = $questionCreate->id;
        
        // Insérer chaque proposition pour la question actuelle
        foreach ($question['propositions'] as $proposition) {
            $newProposition = Proposition::create([
                'libelle' => $proposition,
                'question' => $idQuestion,
                'estCorrecte' => 0,
            ]);
        }

        // Marquer les propositions correctes pour cette question
        foreach ($question['corrections'] as $correct) {
            $idPropo = Proposition::where('libelle', $correct)->where('question', $idQuestion)->latest('id')->first();
            if ($idPropo) {
                $idPropo->estCorrecte = 1;
                $idPropo->save();
            }
        }

        
    }

    $partie = Partie::where('id',$idPartie)->first();
        $titre = "Nouvelle partie bientôt disponible";
        $url = "/joueur/manotification/".$partie->id;
        $message = "Bonjour " . Auth::user()->login . "! La partie \"" . $partie->nom . "\" vient d'être créée. Pour la découvrir, cliquez sur le lien ci-dessous.";

        $link=url('/joueur/partie/'.$partie->id);
    $joueurs = User::where('status','joueur')->get();
    foreach ($joueurs as $key => $joueur) {
        $joueur->notify(new NewNotification($titre, $message,$link, $url));
    }


    // Rediriger avec un message de succès
    return redirect()->route('AdminParties')->with('success', 'La partie ' . $partie['nom'] . ' a été créée avec succès!');
}


    public function AdminBilanPartie(Request $request){
        $message1 = 'Bilan de la partie ';
        $message2 = '';
        $partie = $request->session()->get('partie');
        $partieJson = json_encode($partie);
        // dd($partie);
        
        return view('admin.bilan',[
            'partie'=>$partie,
            'message1' => $message1,
            'message2' => $message2,
        ]);
    }
    public function AdminBilanPartieImage(Request $request){
        $message1 = 'Bilan de la partie ';
        $message2 = '';
        $partie = $request->session()->get('partie');
        $partieJson = json_encode($partie);
        // dd($partie);
        
        return view('admin.bilanImage',[
            'partie'=>$partie,
            'message1' => $message1,
          'message2' => $message2,
        ]);
    }

    public function upload(Request $request, $input): string
    {
        $path = " ";
        if ($request->hasFile($input)) {
            // Récupérer le fichier
            $file = $request->file($input);
            
            switch ($input) {
                case 'miniature':
                    $path = $file->store('miniatures', 'public');
                    break;
                
                case 'imageFond':
                    $path = $file->store('imageFonds', 'public');
                    break;
                
                    case 'imagepartie':
                        $path = $file->store('imagepartie', 'public');
                        break;
                default:
                    break;
            }
            // Stocker le fichier dans le répertoire 'public/uploads'
            
            // $path contiendra le chemin relatif du fichier stocké
            
        }
        return $path;
    }

    public function factoParties($id){
        $partie = Partie::where('id',$id)->first();
        // dd($partie->type);
        switch ($partie->type) {
            case 'text':
                return $this->partie($id);
                break;
            case 'image':
                return $this->partieImage($id);
                break;
                
            default:
                # code...
                break;
        }
    }

    

    public function notifications(){
        $user = Auth::user();
        //$user->notifications()->delete();
     // Récupérez les 5 dernières notifications de l'utilisateur
     $notifications = $user->notifications()->get();
     $notificationData = [];
 
 // Parcourez les notifications et extrayez le tableau 'data'
 foreach ($notifications as $notification) {
     $notificationData[] = $notification;
 }
        // dd($notificationData);
        $message1 = 'Mes notifications';
        $message2 = '';
        return view('admin.notifications.notifications',[
            'message1' => $message1,
            'message2' => $message2,
            //'notification'=>$notificationData
        ]);
    }

    public function adminMaNotifications(Request $request, string $ref, string $slug){
        $user = Auth::user();
        $notifications = $user->notifications()->where('id',$slug)->first();
        $notificationsJson = $notifications->toJson();
        $message1 = 'Ma notification';
        $message2 = '';
        return view('admin.notifications.manotification',[
            'message1' => $message1,
            'message2' => $message2,
            'notification'=>$notifications,
            'notificationjson'=>$notificationsJson,
            'ref'=>$ref
        ]);
    }
}