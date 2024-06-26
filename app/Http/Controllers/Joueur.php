<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Partie;
use App\Models\Question;
use App\Models\Proposition;
use App\Models\Partiejoueur;
use App\Models\Choix;
use App\Models\Score;
use Carbon\Carbon;

class Joueur extends Controller
{
   public function layout(){
    return view('joueur.layout');
   }
   public function dashboard(){
      $partie = Partie::get();
      $attente= $partie->count();
    return view('joueur.dashboard');
   }
   public function JoueurParties(){
      $resultatExist = Score::where('joueur',auth()->id())->value('partie');
      $note = Score::where('joueur',auth()->id())->value('score');
      $partie = Partie::where('id', $resultatExist)->get();
      // dd($resultatExist);
      return view('joueur.parties',[
         'parties' => $partie,
         'note' => $note,
      ]);
   }

  
   public function  partieAvenir(){
      $partie = Partie::where('dateDebut','>=', now())->get();
      return view('joueur.partiesAvenir',[
         'parties' => $partie,
      ]);
   }

   public function traitementPartie($id){
      $partie = Partie::where('id',$id)->first();
      $questions = Question::where('partie',$id)->get();
      foreach ($questions as $question) {  
         $propositions[] = Proposition::where('question',$question->id)->get();
      }
      // dd($partie, $questions, $propositions);
      return view('joueur.traitementPartie',[
         'partie' => $partie ,
         'propositions' => $propositions ,
         'questions' => $questions
      ]);
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
     
      $resultat = Score::create([
         'score'=> $totalTrouve,
         'joueur' => auth()->id(),
         'partie' => $id

      ]);
      return redirect()->route('JoueurParties')->with('success','L\'évaluation  a été effectuée avec succès!');
   }

   
}