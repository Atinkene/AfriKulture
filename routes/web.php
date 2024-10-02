<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('/')->controller(App\Http\Controllers\Afrikulture::class)->group(function(){
    Route::get('/','accueil')->name('accueil');
    Route::get('/connexion','login')->name('login');
    Route::post('/connexion','seconnect');
    Route::delete('/deconnexion','logout')->name('logout');
    Route::get('/inscription','index')->name('register');
    Route::post('/inscription','register');
    Route::get('/classement','classement')->name('classement');
    Route::get('/notif','mesNotif')->name('mesNotif')->middleware('auth');
            Route::get('/mynotif/','myNotif')->name('myNotif')->middleware('auth');
            Route::get('/manotif/{slug}','Notif')->name('Notif')->middleware('auth');

    Route::middleware(['auth'])->group(function () {
        Route::prefix('/joueur')->controller(App\Http\Controllers\Joueur::class)->group(function(){
            Route::get('/dashboard','dashboard')->name('JoueurDashboard');
            Route::get('/test/{id}','test')->where('id', '[0-9]+')->name('test');
            Route::get('/image/{id}','image')->where('id', '[0-9]+')->name('image');
            Route::post('/calcul/{id}','calculerScoreTotal')->name('calculerScoreTotal');
            Route::post('/question/{id}','correctionQuestion')->where('id', '[0-9]+')->name('correctionQuestion');
            Route::get('/parties','JoueurParties')->name('JoueurParties');
            Route::get('/partie/{id}','JoueurPartie')->where('id', '[0-9]+')->name('JoueurPartie');
            Route::get('/partie/avenir/','partieAvenir')->name('partieAvenir');
            Route::get('/partie/effectuer/{id}','effectuer')->where('id', '[0-9]+')->name('effectuer');
            Route::get('/partie/traitement/{id}','traitementPartie')->where('id', '[0-9]+')->name('traitementPartie');
            Route::post('/partie/traitement/{id}','postTraitementPartie')->where('id', '[0-9]+')->name('postTraitementPartie');
            // Route::get('/partie','partie')->name('PartiePartie');
            Route::get('/planning','planning')->name('JoueurPlanning');

            Route::get('/notifications','notifications')->name('joueurNotifications');
            Route::get('/manotification/{ref}/{slug}','manotification')->name('joueurMaNotification');
    //         Route::get('/planning','planning')->name('PartiePlanning');
    //         Route::get('/layout','layout')->name('Partielayout');


        });
    });
    Route::middleware(['auth'])->group(function () {
        Route::prefix('/admin')->controller(App\Http\Controllers\Admin::class)->group(function(){
            Route::get('/dashboard','dashboard')->name('AdminDashboard');
            Route::get('/test','test')->name('test');
            Route::get('/parties','parties')->name('AdminParties');
            Route::get('/parties/factory/{id}','factoParties')->where('id', '[0-9]+')->name('factoParties');
            Route::get('/partie/texte/{id}','partie')->where('id', '[0-9]+')->name('AdminPartie');
            Route::get('/partie/image/{id}','partieImage')->where('id', '[0-9]+')->name('AdminPartieImage');

            Route::get('/partie/texte/ajouter','AdminCreePartie')->name('AdminCreePartie');
            Route::post('/partie/texte/ajouter','AdminPostCreePartie')->name('AdminPostCreePartie');

            Route::get('/partie/texte/bilan','AdminBilanPartie')->name('AdminBilanPartie');
            Route::post('/partie/texte/bilan','AdminPostBilanPartie')->name('AdminPostBilanPartie');

            Route::get('/partie/image/ajouter','AdminCreePartieImage')->name('AdminCreePartieImage');
            Route::post('/partie/image/ajouter','AdminPostCreePartieImage')->name('AdminPostCreePartieImage');

            Route::get('/partie/image/bilan','AdminBilanPartieImage')->name('AdminBilanPartieImage');
            Route::post('/partie/image/bilan','AdminPostBilanPartieImage')->name('AdminPostBilanPartieImage');

            Route::get('/partie/validation','AdminValidationPartie')->name('AdminValidationPartie');
            Route::get('/planning','planning')->name('AdminPlanning');

            Route::get('/notifications','notifications')->name('adminNotifications');
            Route::get('/notifications','notifications')->name('adminNotifications');
            Route::get('/manotification/{ref}/{slug}','manotification')->name('adminMaNotification');

            
    //         Route::get('/etudiants','etudiants')->name('EnseignantParties');
    //         Route::get('/classes','classes')->name('EnseignantClasses');
    //         Route::get('/classes/{id}','classesEvalu')->where('id', '[0-9]+')->name('classesEvalu');

        });
    });

});
