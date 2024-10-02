<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Partie;
use Illuminate\Support\Collection;

use App\Models\Question;
use App\Models\Proposition;
use App\Models\Partiejoueur;
use App\Models\Choix;
use App\Models\User;
use App\Models\Resultat;
use App\Models\Niveau;
use Carbon\Carbon;
class Joueur extends Controller
{
   public function layout(){
    return view('joueur.layout');
   }
   // public function dashboard(){
   //    $partie = Partie::get();
   //    $attente= $partie->count();
   //  return view('joueur.test');
   // }

   public function dashboard(Request $request){
      $message1 = 'Bienvenue, ';
      $message2 = Auth::user()->prenom.' '.Auth::user()->nom;
      $partie = Partie::where('dateDebut','>',now())
      ->get();
      $nbPartie = $partie->count();

      $totalPartie = Partie::where('admin',auth()->id())
      ->where('dateDebut','<=',now())
      ->get();
      $totalPartieAchevee = $totalPartie->count();

      $totalPartieCree = Partie::where('admin',auth()->id())
      ->count();


      $plans = Partie::limit(3)
      ->get();
    //   dd($plans);
    $dernierResultat = Resultat::where('joueur', auth()->id())->latest()->pluck('partie')->first();

    // dd($dernierResultat);
      $dernierePartie=Partie::where('id',$dernierResultat)->first();
      $scoreDernierePartir = Resultat::where('partie',$dernierResultat)->latest()->pluck('score')->first();
    //   dd($dernierResultat,$scoreDernierePartir);
      $niveau =Niveau::where('id',$dernierePartie->niveau)->value('nom');
      $planElems = Partie::orderBy('dateDebut')
      ->where('dateDebut', '>=', now())
      ->get();

      $planningJour=[];
      $planningMoisAnnee=[];
      foreach ($plans as $key => $plan) {
         $planningJour[$key] = Carbon::parse($plan['dateDebut'])->translatedFormat('j');
         $planningMoisAnnee[$key] = Carbon::parse($plan['dateDebut'])->translatedFormat('F Y');
      }
      $scores = Resultat::where('joueur',auth()->id())->get();
      $scoreTotal =0;
      foreach ($scores as $key => $score) {
         $scoreTotal = $scoreTotal + $score->score;
      }
      $joueur = User::where('id',auth()->id())->first();
      // // dd($planningJour, $planningMoisAnnee);
      $totaljouer = Resultat::where('joueur',auth()->id())->count();
      return view('joueur.dashboard',[
        'joueur' =>$joueur,
        'totaljouer' =>$totaljouer,
        'scoreTotal' =>$scoreTotal,
        'dernierePartie' =>$dernierePartie,
         'niveau' =>$niveau,
         'score' =>$scoreDernierePartir,
          'planElems' => $planElems,
          'plans' => $plans,
          'enattente' => $nbPartie,
          'totalPartie' => $totalPartieCree,
          'totalPartieAchevee' => $totalPartieAchevee,
          'planningJour' => $planningJour,
          'planningMoisAnnee' => $planningMoisAnnee,
          'dernier' => $dernierePartie,
          'message1' => $message1,
          'message2' => $message2,
      ]);
  }
   public function JoueurParties(){
      $message1 = 'Mes parties';
      $message2 = '';
      $resultatExists = Resultat::where('joueur',auth()->id())->distinct()->pluck('partie');
      // dd($resultatExists);
      $partie=[];
      $note=[];
      foreach ($resultatExists as $key => $resultatExist) {
         $partie[$key] = Partie::where('id', $resultatExist)->first();
         $note[$key] = Resultat::where('joueur',auth()->id())
         ->where('partie',$resultatExist)
         ->value('score');
      }
      // dd($note);
      return view('joueur.parties',[
         'parties' => $partie,
         'note' => $note,
         'message1' => $message1,
          'message2' => $message2,
      ]);
   }

  
   public function  partieAvenir(){
      $message1 = 'Parties à venir';
      $message2 = '';
      $parties = Partie::orderBy('dateDebut','desc')
      ->get();
      $planningMoisAnnee=[];
      $planningJour=[];
      foreach ($parties as $key => $partie) {
        $planningJour[$key] = Carbon::parse($partie['dateDebut'])->translatedFormat('j F Y');
    }
      return view('joueur.partiesAvenir',[
         'parties' => $parties,
         'message1' => $message1,
         'message2' => $message2,
         'planningJour' => $planningJour,
      ]);
   }

   public function traitementPartie($id){
      $message1 = 'Jouer à la partie';
      $message2 = '';
      $partie = Partie::where('id',$id)->first();
      $score = Resultat::where('joueur',auth()->id())
      ->where('partie',$partie->id)
      ->count();
      // dd($score);
      if ($score !== 0) {
         return redirect()->route('partieAvenir')->with('message', 'Vous avez déjà joué à cette partie!');
     } elseif ($partie->dateDebut > now()) {
         return redirect()->route('partieAvenir')->with('message', 'Vous ne pouvez pas encore jouer à cette partie!');
     } elseif ($partie->dateDebut <= now()) {
         $questions = Question::where('partie', $id)->get();
         $propositions = [];
         foreach ($questions as $question) {
             $propositions[] = Proposition::where('question', $question->id)->get();
         }
         // dd($partie, $questions, $propositions);
         return view('joueur.traitementPartie', [
             'partie' => $partie,
             'propositions' => $propositions,
             'questions' => $questions,
             'message1' => $message1,
          'message2' => $message2,
         ]);
     }
      
   }

   // public function test($id){
   //    $message1 = 'Jouer à la partie';
   //    $message2 = '';
   //    $partie = Partie::where('id',$id)->first();
   //    $questions = Question::where('partie', $id)->get();
   //       $propositions = [];
   //       foreach ($questions as $question) {
   //           $propositions[] = Proposition::where('question', $question->id)->get();
   //       }
   //       // dd($partie, $questions, $propositions);
   //       return view('joueur.test', [
   //           'partie' => $partie,
   //           'propositions' => $propositions,
   //           'questions' => $questions,
   //           'message1' => $message1,
   //        'message2' => $message2,
   //       ]);
   // } 
   public function test($id)
    {
      $message1 = 'Jouer à la partie';
      $message2 = '';
        // Récupérer toutes les questions (exemple)
        $partie = Partie::where('id',$id)->first();
        $score = Resultat::where('joueur',auth()->id())
      ->where('partie',$partie->id)
      ->count();
      if ($score !== 0) {
        return redirect()->route('partieAvenir')->with('message', 'Vous avez déjà joué à cette partie!');
    } elseif ($partie->dateDebut > now()) {
        return redirect()->route('partieAvenir')->with('message', 'Vous ne pouvez pas encore jouer à cette partie!');
    } elseif ($partie->dateDebut <= now()) {
      $questions = Question::where('partie', $id)->get();
      $nbQuestion = $questions->count();
        // dd($questions);
        // Récupérer les propositions pour chaque question
        $propositions = [];
        foreach ($questions as $question) {
            $propositions[$question->id] = Proposition::where('question', $question->id)->get();
        }
        
        return view('joueur.test',[
            'questions' => $questions,
            'nbQuestions' => $nbQuestion,
            'partie'=> $partie,
            'propositions' => $propositions,
            'message1' => $message1, 
            'message2' => $message2

        ]);
    }
    }

    public function image($id)
    {
      $message1 = 'Jouer à la partie';
      $message2 = '';
        // Récupérer toutes les questions (exemple)
        
        $partie = Partie::where('id',$id)->first();
        $score = Resultat::where('joueur',auth()->id())
      ->where('partie',$partie->id)
      ->count();
        if ($score !== 0) {
            return redirect()->route('partieAvenir')->with('message', 'Vous avez déjà joué à cette partie!');
        } elseif ($partie->dateDebut > now()) {
            return redirect()->route('partieAvenir')->with('message', 'Vous ne pouvez pas encore jouer à cette partie!');
        } elseif ($partie->dateDebut <= now()) {
            $questions = Question::where('partie', $id)->get();
              // dd($questions);
              // Récupérer les propositions pour chaque question
              $propositions = [];
              foreach ($questions as $question) {
                  $propositions[$question->id] = Proposition::where('question', $question->id)->get();
              }

              return view('joueur.testImage',[
                  'questions' => $questions, 
                  'partie'=> $partie,

                  'propositions' => $propositions,
                  'message1' => $message1, 
                  'message2' => $message2

              ]);
            }
    }
   public function postTraitementPartie(Request $request, $id){
      $evaluation = Partie::where('id',$id)->get();
      $questions = Question::where('partie',$id)->get();
      $choix = $request->input('reponses'); // Tableau des réponses
      // dd($choix);
      $totalTrouve=0;
      $points=0;
      foreach ($questions as $index => $question) {
         foreach ($choix[$index] as $reponseText) {
             // Récupérer l'ID de la proposition à partir du libellé de la réponse
             $proposition = Proposition::where('libelle', $reponseText)->latest()->first();
             $propos = Proposition::where('libelle', $reponseText)->value('id');
             //  dd($proposition);
             if ($proposition) {
                 Choix::create([
                     'joueur' => auth()->id(),
                     'proposition' => $propos
                 ]);

                 if ($proposition->estCorrecte) {
                     $points++;
                 }
             }
         }
         $pointQuestion = $question->nombrePoint;
         $countPropo = Proposition::where('estCorrecte',1)
         ->where('question',$question->id)
         ->count();
         $totalTrouve=$totalTrouve + ($points * $pointQuestion)/$countPropo;
         $points=0;
      }
      //   dd($totalTrouve);
     
      $resultat = Resultat::create([
         'score'=> $totalTrouve,
         'joueur' => auth()->id(),
         'partie' => $id,
         'rang' => 2,
         'icone'=>' '

      ]);
      return redirect()->route('JoueurParties')->with('success','La partie a été effectuée avec succès!');
   }

   public function planning(){
      $message1 = 'Calendrier des parties';
      $message2 = '';
      $plans = Partie::orderBy('dateDebut')
      ->where('dateDebut', '>=', now())
      ->paginate(6);

      $planElems = Partie::orderBy('dateDebut')
      ->where('dateDebut', '>=', now())
      ->get();

      $planningJour=[];
      $planningMoisAnnee=[];
      foreach ($plans as $key => $plan) {
         $planningJour[$key] = Carbon::parse($plan['dateDebut'])->translatedFormat('j F Y');
      }
      

      return view('joueur.planning',[
          'planElems' => $planElems,
          'plans' => $plans,
          'planningJour' => $planningJour,
          'message1' => $message1,
          'message2' => $message2,
      ]);

  }

//   public function correctionQuestion(Request $request, $question_id)
//   {
//       // Récupérer la question basée sur l'ID
//       $question = Question::findOrFail($question_id);

//       // Récupérer les réponses soumises par le joueur
//       $reponsesSoumises = $request->input('reponses');

//       // Récupérer les réponses correctes de la question
//       $correction = Proposition::where('question', $question->id)
//       ->where('estCorrecte', 1)->pluck('id')->toArray();
//       // foreach ($reponsesSoumises as $key => $choix) {
//       //    Choix::create([
//       //       'proposition' => $choix,
//       //       'joueur' => auth()->id()
//       //    ]);
//       // }
//       return response()->json(['correction' => $correction],200);
//   }


public function correctionQuestion(Request $request, $question_id)
{
    $question = Question::findOrFail($question_id);

    $reponsesSoumises = $request->input('reponses.' . $question_id, []);

    $reponsesCorrectes = Proposition::where('question', $question->id)
        ->where('estCorrecte', 1)
        ->pluck('id')
        ->toArray();

    $bonnesReponses = [];
    foreach ($reponsesSoumises as $reponse) {
        if (in_array($reponse, $reponsesCorrectes)) {
            $bonnesReponses[] = $reponse;
        }
    }
    $score = (count($bonnesReponses) == count($reponsesCorrectes)) ? $question->nombrePoint : 0;

    // Enregistrer les réponses du joueur si nécessaire (par exemple, avec le modèle Choix)
    // Exemple : Enregistrer chaque choix dans la base de données
    foreach ($reponsesSoumises as $reponse) {
        Choix::create([
            'proposition' => $reponse,
            'joueur' => auth()->id(), // Supposons que vous avez un utilisateur connecté
            'question' => $question_id,
        ]);
    }
      
    return response()->json(['correction' => $reponsesCorrectes, 'bonnesReponses' => $bonnesReponses, 'score' => $score], 200);
}


// public function calculerScoreTotal(Request $request, $questionId)
// {
//     $joueurId = auth()->id();

//     $questions = Question::findOrFail($questionId);
//     $partie = Partie::findOrFail($questions->partie);

//     $evaluation = Partie::where('id',$id)->get();
//     $choix = Choix::where('joueur', $joueurId)->get();
//     dd($choix);
//     $totalTrouve=0;
//     $points=0;
//     foreach ($questions as $index => $question) {
//        foreach ($choix[$index] as $reponseText) {
//            // Récupérer l'ID de la proposition à partir du libellé de la réponse
//            $proposition = Proposition::where('libelle', $reponseText)->latest()->first();
//            $propos = Proposition::where('libelle', $reponseText)->value('id');
//            //  dd($proposition);
//            if ($proposition) {
//                Choix::create([
//                    'joueur' => auth()->id(),
//                    'proposition' => $propos
//                ]);

//                if ($proposition->estCorrecte) {
//                    $points++;
//                }
//            }
//        }
//        $pointQuestion = $question->nombrePoint;
//        $countPropo = Proposition::where('estCorrecte',1)
//        ->where('question',$question->id)
//        ->count();
//        $totalTrouve=$totalTrouve + ($points * $pointQuestion)/$countPropo;
//        $points=0;
//     }

//     // Resultat::create([
//     //     'score' => $totalTrouve,
//     //     'joueur' => $joueurId,
//     //     'partie' => $partie->id,
//     //     'rang' => 2,
//     //     'icone' => ' '
//     // ]);

//     return response()->json(['scoreTotal' => $totalTrouve], 200);
// }

// public function calculerScoreTotal(Request $request, $questionId)
// {
//     $joueurId = auth()->id();

//     $question = Question::findOrFail($questionId);
//     $partie = Partie::findOrFail($question->partie);

//     $choix = Choix::where('joueur', $joueurId)
//                   ->whereHas('proposition', function ($query) use ($question) {
//                       $query->where('question', $question->id);
//                   })
//                   ->get();

//     $allQuestions = Question::where('partie', $partie->id)->get();

//     $totalTrouve = 0;

//     foreach ($allQuestions as $question) {
//         $propositionsCorrectes = Proposition::where('question', $question->id)
//                                             ->where('estCorrecte', true)
//                                             ->pluck('id')
//                                             ->toArray();

//         $reponsesCorrectes = Choix::where('joueur', $joueurId)
//             ->whereHas('proposition', function ($query) use ($question) {
//                 $query->where('question', $question->id);
//             })
//             ->whereHas('proposition', function ($query) use ($propositionsCorrectes) {
//                 $query->whereIn('id', $propositionsCorrectes);
//             })
//             ->count();
//         $nombrePoints = $question->nombrePoint;
//         $countPropo = count($propositionsCorrectes);
//         $scoreQuestion = ($reponsesCorrectes * $nombrePoints) / $countPropo;
        
//         $totalTrouve += $scoreQuestion;
//     }

//     // Resultat::create([
//     //     'score' => $totalTrouve,
//     //     'joueur' => $joueurId,
//     //     'partie' => $partie->id,
//     //     'rang' => 2,
//     //     'icone' => ' '
//     // ]);

//     return response()->json(['scoreTotal' => $totalTrouve], 200);
// }

public function calculerScoreTotal(Request $request, $id)
{
    $joueurId = auth()->id();

    $quest = Question::findOrFail($id);
    $questions = Question::where('partie',$id)->get();
    $partie = Partie::findOrFail($id);
    // $question= $partie->question;
    
    $evaluation = Partie::where('id',$id)->get();
    $choix = Choix::where('joueur', $joueurId)->get();
    // dd($choix);
    $totalTrouve=0;
    $points=0;
    $proposition;
    foreach ($questions as $index => $question) {
        foreach ($choix as $reponseText) {
            // Récupérer l'ID de la proposition à partir du libellé de la réponse
           $proposition = Proposition::where('id', $reponseText->proposition)
           ->where('question',$question->id)
           // dd($proposition);
           ->latest()->first();
           $propos = Proposition::where('libelle', $reponseText)->value('id');
           if ($proposition) {
               if ($proposition->estCorrecte) {
                   $points++;
                }
            }
        }
        $pointQuestion = $question->nombrePoint;
        $countPropo = Proposition::where('estCorrecte',1)
        ->where('question',$question->id)
        ->count();
        $totalTrouve=$totalTrouve + ($points * $pointQuestion)/$countPropo;
       $points=0;
    }
    // dd($choix[1]);
    
    Resultat::create([
        'score' => $totalTrouve,
        'joueur' => $joueurId,
        'partie' => $partie->id,
        'rang' => 0,
        'icone' => ' '
    ]);
    $users = User::where('status','joueur')->get();
    $classement = [];
    foreach ($users as $slug => $user) {
        $scores = Resultat::where('joueur', $user->id)->get();
        $scoreTotal = 0;
        foreach ($scores as $score) {
            $scoreTotal += $score->score;
        }
        $classement[$slug] = [
            'joueur' => $user->id,
            'score' => $scoreTotal,
        ];
       
    }
    
    $class = collect($classement);
    $classementTrie = $class->sortByDesc('score')->values()->all();
    // dd($classementTrie);
    foreach ($classementTrie as $key => $class) {
        // dd($class['joueur']);
        User::where('id', $class['joueur'])
        ->update([
            'classement'=> $key+1
        ]);
    }
    
    return response()->json(['scoreTotal' => $totalTrouve], 200);
}

// public function calculerScoreTotal(Request $request)
// {
//     // Récupérer l'ID du joueur connecté (exemple)
//     $joueurId = auth()->id();

//     // Calculer le score total du joueur
//     $scoreTotal = 0;
//     $scores = $request->input('scores',[]);
//     dd($scores);
//     // Parcourir toutes les questions et récupérer les scores du joueur
//     foreach ($scores as $questionId => $score) {
//         // Vous pouvez également vérifier si le score est correct et l'enregistrer dans la base de données si nécessaire
//         $scoreTotal += $score;
//     }
//     // Vous pouvez également enregistrer le score total dans la base de données si nécessaire
//     // Exemple : Enregistrer le score total pour le joueur dans une table Scores

//     // Retourner le score total
//     return response()->json(['scoreTotal' => $scoreTotal], 200);
// }

// console.log({{$question->id}});
//                 var somme;
//                 scores.forEach(function(score){
//                     somme += score
//                 });
//                 console.log(somme);
//                 scoreTotal = somme;

    public function JoueurPartie($id){
        $partie = Partie::where('id',$id)->first();
        $date = Carbon::parse($partie['dateDebut'])->translatedFormat('j F Y');
        $message1 = 'information de la partie';
        $message2 = '';
        // dd($partie);
        return view('joueur.jeu',[
            'partie' => $partie,
            'date' => $date,
            'message1' => $message1,
            'message2' => $message2,
        ]);
    }

    public function effectuer($id){
        $partie =Partie::where('id',$id)->first();
        // dd($partie->type);
        switch ($partie->type) {
            case 'text':
                return $this->test($id);
                break;
            case 'image':
                return $this->image($id);
                break;
            default:
                
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
        return view('joueur.notifications.notifications',[
            'message1' => $message1,
            'message2' => $message2,
            //'notification'=>$notificationData
        ]);
    }

    public function manotification(Request $request, string $ref, string $slug){
        $user = Auth::user();
        $notifications = $user->notifications()->where('id',$slug)->first();
        $notificationsJson = $notifications->toJson();
        $message1 = 'Ma notification';
        $message2 = '';
        return view('joueur.notifications.manotification',[
            'message1' => $message1,
            'message2' => $message2,
            'notification'=>$notifications,
            'notificationjson'=>$notificationsJson,
            'ref'=>$ref
        ]);
    }
}