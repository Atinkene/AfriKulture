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
   public function parties(){
      $resultatExist = Resultat::where('joueur',auth()->id())->value('partie');
      $note = Resultat::where('joueur',auth()->id())->value('note');
      $appreciation = Resultat::where('joueur',auth()->id())->value('appreciation');
      $partie = Partie::where('id', $resultatExist)->get();
      // dd($resultatExist);
      return view('joueur.parties',[
         'parties' => $partie,
         'note' => $note,
         'appreciation' => $appreciation
      ]);
   }

  
   public function  partieAvenir(){
      $partie = Partie::where('dateDebutHeure','>=', now())->get();
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
      return view('joueur.traitementpartie',[
         'partie' => $partie ,
         'propositions' => $propositions ,
         'questions' => $questions
      ]);
   }

   // public function postTraitementEvaluation(Request $request, $id){
   //    $evaluation = Evaluation::where('id',$id)->get();
   //    $questions = Question::where('evaluation',$id)->get();
   //    $reponses = $request->input('reponses'); // Tableau des réponses
   //    // dd($reponses);
   //    $totalTrouve=0;
   //    $points=0;
   //    foreach ($questions as $index => $question) {
   //       foreach ($reponses[$index] as $reponseText) {
   //           // Récupérer l'ID de la proposition à partir du libellé de la réponse
   //           $proposition = Proposition::where('libelle', $reponseText)->latest()->first();
   //           $propos = Proposition::where('libelle', $reponseText)->value('id');
   //           //  dd($proposition);
   //           if ($proposition) {
   //               Reponse::create([
   //                   'joueur' => auth()->id(),
   //                   'proposition' => $propos
   //               ]);

   //               if ($proposition->estCorrecte) {
   //                   $points++;
   //               }
   //           }
   //       }
   //       $pointQuestion = $question->nombrePoint;
   //       $countPropo = Proposition::where('estCorrecte',1)
   //       ->where('question',$question->id)
   //       ->count();
   //       $totalTrouve=$totalTrouve + ($points * $pointQuestion)/$countPropo;
   //       $points=0;
   //    }
   //    //   dd($totalTrouve);
   //    $appreciation = '';
   //    if($totalTrouve<10){
   //       $appreciation="FAIBLE";
   //    }elseif($totalTrouve>=10 && $totalTrouve<12) {
   //       $appreciation="PASSABLE";
   //    }elseif($totalTrouve>=12 && $totalTrouve<14) {
   //       $appreciation="ABIEN";
   //    }elseif($totalTrouve>=14 && $totalTrouve<16) {
   //       $appreciation="BIEN";
   //    }elseif($totalTrouve>=16 && $totalTrouve<18) {
   //       $appreciation="TRES BIEN";
   //    }elseif($totalTrouve>=18 && $totalTrouve<20) {
   //       $appreciation="EXCELLENT";
   //    }
   //    $resultat = Resultat::create([
   //       'note'=> $totalTrouve,
   //       'appreciation' => $appreciation,
   //       'joueur' => auth()->id(),
   //       'evaluation' => $id

   //    ]);
   //    return redirect()->route('joueurEvaluations')->with('success','L\'évaluation  a été effectuée avec succès!');
   // }

   
}