<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
=======
use App\Http\Controllers\afrikulture;
use App\Http\Controllers\Partie;
use App\Http\Controllers\Joueur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Livewire\Counter;
>>>>>>> b63bbc5 (useCase(creerPartie,effectuerPartie))

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

<<<<<<< HEAD
Route::get('/', function () {
    return view('welcome');
});
=======
Route::prefix('/')->controller(App\Http\Controllers\afrikulture::class)->group(function(){
    Route::get('/','accueil')->name('accueil');
    Route::get('/connexion','login')->name('login');
    Route::post('/connexion','seconnect');
    Route::delete('/deconnexion','logout')->name('logout');

    Route::middleware(['auth'])->group(function () {
        Route::prefix('/joueur')->controller(App\Http\Controllers\Joueur::class)->group(function(){
            Route::get('/dashboard','dashboard')->name('JoueurDashboard');
            Route::get('/partie','parties')->name('JoueurEvaluations');
            Route::post('/partie/traitement/{id}','postTraitementEvaluation')->name('postTraitementPartie');
            Route::get('/partie/avenir/','evaluationAvenir')->name('evaluationAvenir');
            Route::get('/partie/traitement/{id}','traitementPartie')->name('traitementPartie');
            Route::get('/partie','partie')->name('EtudiantPartie');
    //         Route::get('/planning','planning')->name('planning');
    //         Route::get('/planning','planning')->name('EtudiantPlanning');
    //         Route::get('/layout','layout')->name('Etudiantlayout');


        });
    });
    Route::middleware(['auth'])->group(function () {
        Route::prefix('/admin')->controller(App\Http\Controllers\Admin::class)->group(function(){
            Route::get('/dashboard','dashboard')->name('AdminDashboard');
            Route::get('/partie','parties')->name('AdminParties');
            Route::get('/partie/{id}','partie')->where('id', '[0-9]+')->name('AdminPartie');
            Route::get('/partie/ajouter','AdminCreePartie')->name('AdminCreePartie');
            Route::post('/partie/ajouter','AdminPostCreePartie')->name('AdminPostCreePartie');
            Route::get('/partie/bilan','AdminBilanPartie')->name('AdminBilanPartie');
            Route::post('/partie/bilan','AdminPostBilanPartie')->name('AdminPostBilanPartie');
            Route::get('/partie/validation','AdminValidationPartie')->name('AdminValidationPartie');
    //         Route::get('/planning','planning')->name('EnseignantPlanning');
    //         Route::get('/etudiants','etudiants')->name('EnseignantEtudiants');
    //         Route::get('/classes','classes')->name('EnseignantClasses');
    //         Route::get('/classes/{id}','classesEvalu')->where('id', '[0-9]+')->name('classesEvalu');

        });
    });

});
>>>>>>> b63bbc5 (useCase(creerPartie,effectuerPartie))
