<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Partie;
use App\Models\User;
use App\Models\Question;
use App\Models\Proposition;
use App\Models\Partiejoueur;
use App\Http\Requests\creerFormEvaluation;
use Carbon\Carbon;

class Admin extends Controller
{
   
    public function dashboard(Request $request){

        // $partie = Partie::where('admin',auth()->id())
        // ->where('dateDebut','>',now())
        // ->get();
        // $nbPartie = $partie->count();

        // $totalEvaluation = Partie::where('admin',auth()->id())
        // ->where('dateDebutHeure','<=',now())
        // ->get();
        // $totalEvaluationAchevee = $totalEvaluation->count();

        // $totalEvaluationCree = Partie::where('admin',auth()->id())
        // ->count();


        // $plans = Partie::orderBy('dateDebutHeure')
        // ->where('admin', auth()->id())
        // ->where('dateDebutHeure', '>=', now())
        // ->paginate(6);

        // $planElems = Partie::orderBy('dateDebutHeure')
        // ->where('admin', auth()->id())
        // ->where('dateDebutHeure', '>=', now())
        // ->get();

        // $planningJour=[];
        // $planningMoisAnnee=[];
        // foreach ($plans as $key => $plan) {
        //    $planningJour[$key] = Carbon::parse($plan['dateDebutHeure'])->translatedFormat('j');
        //    $planningMoisAnnee[$key] = Carbon::parse($plan['dateDebutHeure'])->translatedFormat('F Y');
        // }
        
        
        // // dd($planningJour, $planningMoisAnnee);

        return view('admin.dashboard',[
            // 'planElems' => $planElems,
            // 'plans' => $plans,
            // 'enattente' => $nbEvaluation,
            // 'totalEvaluation' => $totalEvaluationCree,
            // 'totalEvaluationAchevee' => $totalEvaluationAchevee,
            // 'planningJour' => $planningJour,
            // 'planningMoisAnnee' => $planningMoisAnnee,
        ]);
    }
    public function parties(){
        $parties = Partie::get();
        //dd($parties);
        return view('admin.evaluations',[
            'parties' => $parties
        ]);
    }
    public function planning(){
        $plans = Partie::orderBy('dateDebutHeure')
        ->where('admin', auth()->id())
        ->where('dateDebutHeure', '>=', now())
        ->paginate(6);

        $planElems = Partie::orderBy('dateDebutHeure')
        ->where('admin', auth()->id())
        ->where('dateDebutHeure', '>=', now())
        ->get();

        $planningJour=[];
        $planningMoisAnnee=[];
        foreach ($plans as $key => $plan) {
            $planningJour[$key] = Carbon::parse($plan['dateDebutHeure'])->translatedFormat('j');
            $planningMoisAnnee[$key] = Carbon::parse($plan['dateDebutHeure'])->translatedFormat('F Y');
        }

        return view('admin.planning',[
            'planElems' => $planElems,
            'plans' => $plans,
            'planningJour' => $planningJour,
            'planningMoisAnnee' => $planningMoisAnnee,
        ]);

    }

    public function Partie($id){
        $partie = Partie::where('id',$id)->first();
        $questions = Question::where('partie',$id)->get();
        $propositions = [];
    
        foreach ($questions as $question) {  
            $propositions[] = Proposition::where('question',$question->id)->get();
        }
    
        return view('admin.evaluation', [
            'partie' => $partie,
            'propositions' => $propositions,
            'questions' => $questions
        ]);
    }
    
    public function AdminCreePartie(){
        Session()->forget('partie');
        return view('admin.CreePartie');
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


public function AdminPostBilanPartie(Request $request)
{
    // Récupérer l'évaluation depuis la session
    $partie = $request->session()->get('partie');

    // Parcourir chaque question
    foreach ($partie['questions'] as $key => $question) {
        // Récupérer les corrections pour cette question à partir des données soumises
        $corrections = $request->input('corrections.'. $key, []);
        
        // Mettre à jour les corrections dans le tableau d'évaluation
        $partie['questions'][$key]['corrections'] = $corrections;
    }

    // Afficher ou traiter les corrections pour chaque question
    foreach ($partie['questions'] as $key => $question) {
        echo "Corrections pour la question " . $key . ": ";
        print_r($question['corrections']);
        echo "<br>";
    }
    session()->put('partie', $partie);
    // Debug pour vérifier les données d'évaluation mises à jour
    $partie = $request->session()->get('partie');
    $datetime = $partie['date'].' '.$partie['debut'].':00';
    $newEvaluation = Partie::create([
        'nom' => $partie['nom'],
        'duree' => $partie['duree'],
        'dateDebut' => $datetime,
        'HeureDebut' => $partie['debut'],
        'admin' => Auth::user()->id,
        'visibilite' => 1,
    ]);

    $idPartie = Partie::where('nom', $partie['nom'])->value('id');
    
    foreach ($partie['questions'] as $question) {
        $questionCreate = Question::create([
            'libelle' => $question['libelle'],
            'nombrepoint' => $question['points'],
            'partie' => $idPartie
        ]);
        
        $idquestion = Question::where('libelle',$question['libelle'])->value('id');
        foreach ($question['propositions'] as $proposition) {
            $proposition = Proposition::create([
                'libelle' => $proposition,
                'question' => $idquestion,
                'estCorrecte' => 0,
            ]);

            foreach ($question['corrections'] as $key => $correct) {
                $idPropo = Proposition::where('libelle',$correct)->latest('id')->first();
               if($idPropo){
                    $idPropo->estCorrecte = 1;
                    $idPropo->save();
               }
            }

        }
    }
    return to_route('AdminParties')->with('success','L\'évaluation '.$partie['nom'].' a été créée avec succès!');
}


    public function AdminBilanPartie(Request $request){
        $partie = $request->session()->get('partie');
        $partieJson = json_encode($partie);
        // dd($partie);
        
        return view('admin.bilan',[
            'partie'=>$partie
        ]);
    }
    public function AdminValidationPartie(Request $request){
        $partie = $request->session()->get('partie');
        $datetime = $partie['date'].' '.$partie['debut'];
        $newEvaluation = Partie::create([
            'nom' => $partie['nom'],
            'duree' => $partie['duree'],
            'dateDebutHeure' => $datetime,
            'admin' => Auth::user()->id,
            'matiere' => Matiere::where('nom',$partie['matieres'][0])->value('id')
        ]);
        $idPartie = Partie::where('nom', $partie['nom'])->value('id');
        foreach ($partie['classes'] as $classe) {
            $partiejoueur = Partiejoueur::create([
                'partie' => $idPartie,
                'classe' => Classe::where('nom',$classe)->value('id')
            ]);
            
        }
        foreach ($partie['questions'] as $question) {
            $question = Question::create([
                'libelle' => $question['libelle'],
                'nombrepoint' => $question['points'],
                'partie' => $idPartie
            ]);
            
            $idquestion = Question::where('libelle',$question['libelle'])->value('id');
            foreach ($question['propositions'] as $proposition) {
                $proposition = Proposition::create([
                    'libelle' => $proposition['libelle'],
                    'question' => $idquestion
                ]);
            }
        }
    }

    public function classes(){
        $parties = Partie::where('admin', auth()->id())->pluck('id');

        $classes=[];
        $etudiant=[];

        foreach ($parties as $key => $partie) {
            $classes[$key] = Partiejoueur::where('partie', $partie)
            ->distinct()
            ->pluck('classe')
            ->toArray();
        }
        $lesClasses =[];
        $classeTab = collect($classes)->flatten()->unique()->values()->all();
        foreach ($classeTab as $key => $classe) {
            $lesClasses[$key] = Classe::where('id', $classe)->first();
            $etudiant = User::where('status', 'etudiant')
            ->where('classe',$classe)
            ->get();
        }

        dd($etudiant);
       
        return view('admin.classes', [
            'classeList' => $lesClasses
        ]);
    }
    public function classesEvalu($id){
        $classe = Classe::where('id',$id)->first();
        $partieIds = Partiejoueur::where('classe',$id)->pluck('partie');
        $parties = [];
        $matieres = [];
        $dates = [];
        foreach ($partieIds as $key => $partieId) {
            // Récupérer l'évaluation par son ID
            $partie = Partie::find($partieId);
    
            if ($partie) {
                $parties[$key] = $partie;
    
                // Récupérer la matière associée à cette évaluation
                $matieres[$key] = Matiere::find($partie->matiere);
    
                // Convertir la date de début en format souhaité (si nécessaire)
                $dates[$key] = Carbon::parse($partie->dateDebutHeure)->translatedFormat('j F Y');
            }
        }
        // dd($matieres);
    
        return view('admin.classeView',[
            'classe' => $classe,
            'matieres' => $matieres,
            'evaluations' => $partie,
            'date' => $dates,
        ]);
    }

    
}