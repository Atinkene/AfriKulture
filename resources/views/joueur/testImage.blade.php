@extends('joueur.layout')

@section('content')
    <div class="mt-10 space-y-8">
        <audio id="sound-uncheck">
            <source src="{{asset('songs/mixkit-game-quick-warning-notification-268.wav')}}" type="audio/wav">
            </audio>
            <audio id="sound-check">
                <source src="{{asset('songs/mixkit-quick-positive-video-game-notification-interface-265.wav')}}" type="audio/wav">
                </audio>
                <audio id="sound-validate">
                    <source src="{{asset('songs/ticket-validator-88908.mp3')}}" type="audio/wav">
                    </audio>
                    <audio id="sound-reponse">
                        <source src="{{asset('songs/wrong-answer-129254.mp3')}}" type="audio/wav">
                        </audio>
                        <audio id="sound-suivant">
                            <source src="{{asset('songs/game-bonus-144751.mp3')}}" type="audio/wav">
                            </audio>
                            <audio id="sound-resultat">
                                <source src="{{asset('songs/bongo-drum-roll-1-184062.mp3')}}" type="audio/wav">
                                </audio>
                            <audio id="sound-alert">
                                <source src="{{asset('songs/level-up-191997.mp3')}}" type="audio/wav">
                                </audio>
            <audio id="sound-partie">
                <source src="{{asset('songs/afro-percussion-loop-3-106bpm-164718.mp3')}}" type="audio/wav">
                </audio>
                @foreach ($questions as $key => $question)
                <form id="form-{{ $key }}" action="{{ route('correctionQuestion', $question->id) }}" method="post" class="transition question-suivante duration-700 ease-in-out grid grid-cols-3 gap-20{{ $key > 0 ? ' hidden' : '' }}">
                    @csrf
                    @if ($key % 2 == 0)
                    <div class="col-span-2 bg-black/25 rounded-3xl overflow-hidden">
                        <div class="w-full flex justify-center items-center text-white font-bold text-2xl "><h1>Qui est cette personnalité?</h1></div>
                        <div class="m-auto w-3/4 flex justify-center items-center text-white/100 font-semibold text-xl p-4">
                            <img class="h-96 rounded-3xl" src="/storage/{{$question->libelle}}" alt="">
                        </div>
                        <div class="flex justify-center items-center text-white ">Répondez à cette question et remportez <span class="text-[#c44241] font-semibold px-1 text-lg">{{$question->nombrePoint}}</span> point(s)</div>
                        <div class="grid grid-cols-2 gap-2 p-5 text-white">
                            @foreach ($propositions[$question->id] as $index => $item)
                                <label for="checkbox-{{ $key }}-{{ $index }}" class="flex justify-start items-center p-2 bg-black/25 rounded-3xl space-x-2 cursor-pointer">
                                    <input id="checkbox-{{ $key }}-{{ $index }}" type="checkbox" name="reponses[{{ $question->id }}][]" value="{{ $item->id }}" class="hidden">
                                    <span class="numero bg-[#c44241] rounded-full py-2 px-4 font-semibold text-white">{{ $index+1 }}</span>
                                    <span class="text-white">{{ $item->libelle }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <input type="submit" class="bg-[#c44241] p-3 text-white/100 font-semibold cursor-pointer rounded-3xl" value="Valider"/>
                        <div id="questionSuivante" class="question-suivante bg-white/100 p-3 text-[#c44241]/100 font-semibold cursor-pointer rounded-3xl hidden">Question suivante</div>
                    </div>
                @else
                    <div class="flex justify-center items-center">
                        <input type="submit" class="bg-[#c44241] p-3 text-white/100 font-semibold cursor-pointer rounded-3xl" value="Valider"/>
                        <div id="questionSuivante" class="question-suivante bg-white/100 p-3 text-[#c44241]/100 font-semibold cursor-pointer rounded-3xl hidden">Question suivante</div>
                    </div>
                    <div class="col-span-2 bg-black/25 rounded-3xl overflow-hidden">
                        <div class="w-full flex justify-center items-center text-white font-bold text-2xl "><h1>Qui est cette personnalité?</h1></div>
                        <div class="m-auto w-3/4 flex justify-center items-center text-white/100 font-semibold text-xl p-4">
                            <img class="h-96 rounded-3xl" src="/storage/{{$question->libelle}}" alt="">

                        </div>
                        <div class="">Répondez à cette question et remportez <span class="text-[#c44241] font-semibold px-1 text-lg">{{$question->nombrePoint}}</span> point(s)</div>
                        <div class="grid grid-cols-2 gap-2 p-5 text-white">
                            @foreach ($propositions[$question->id] as $index => $item)
                                <label for="checkbox-{{ $key }}-{{ $index }}" class="flex justify-start items-center p-2 bg-black/25 rounded-3xl space-x-2 cursor-pointer">
                                    <input  id="checkbox-{{ $key }}-{{ $index }}" type="checkbox" name="reponses[{{ $question->id }}][]" value="{{ $item->id }}" class="hidden">
                                    <span class="numero bg-[#c44241] rounded-full py-2 px-4 font-semibold text-white">{{ $index+1 }}</span>
                                    <span class="text-white">{{ $item->libelle }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif
            </form>
        @endforeach
        <div class=" flex justify-center w-1/4 m-auto items-center">
            <div id="resultcontainer" class="w-1/2 hidden py-16  flex justify-center items-center">
                <div class=" p-36 relative ">
                    <div class="z-50 bg-[#40191d;]  top-0 w-full h-full rotate-0 left-0 rounded-full w- absolute  flex justify-center items-center ">
                        <div class="border-dashed border-[#c44241]/45 border-2 p-14 rounded-full grid grid-cols-1">
                            <div class="text-[#c44241]/45 font-semibold text-xl text-center">Score total</div>
                            <div id="resultat" class="text-white font-semibold text-4xl text-center"></div>
                        </div>
                    </div>
                    <div class="animate-spin backdrop-blur z-40 bg-gradient-to-tr from-[#c44241] via-[#fffdc3] to-[#7d63d7] top-0 w-full h-full rotate-45 left-0 rounded-3xl w- absolute "></div>
                    <div class="animate-spin backdrop-blur z-30 bg-gradient-to-tr from-[#c44241]/80 via-[#fffdc3]/80 to-[#7d63d7]/80 top-0 w-full h-full rotate-12 left-0 rounded-3xl w- absolute "></div>
                    <div class="animate-spin backdrop-blur z-20 bg-gradient-to-tr from-[#c44241]/40 via-[#fffdc3]/40 to-[#7d63d7]/40 top-0 w-full h-full -rotate-12 left-0 rounded-3xl w- absolute   "></div>
                    <div class="animate-spin backdrop-blur z-10 bg-gradient-to-tr from-[#c44241]/25 via-[#fffdc3]/25 to-[#7d63d7]/25 top-0 w-full h-full -rotate-45 left-0 rounded-3xl w- absolute  "></div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var forms = document.querySelectorAll('form');
            var resultat = document.getElementById('resultat');
            var resultcontainer = document.getElementById('resultcontainer');
            var labels = document.querySelectorAll('label');
            playSound('sound-partie');
            function playSound(soundId) {
                var sound = document.getElementById(soundId);
                sound.currentTime = 0; // Réinitialiser le son à 0 (utile pour rejouer rapidement)
                sound.play();
            }

            labels.forEach(function(label) {
                label.addEventListener('click', function() {
                    
                    var checkbox = label.querySelector('input[type="checkbox"]');
                    var span = label.querySelector("span.numero");
    
                    checkbox.checked = !checkbox.checked;
    
                    if (checkbox.checked) {
                        label.classList.remove('bg-black/25');
                        label.classList.add('bg-[#c44241]');
                        span.classList.remove('bg-[#c44241]');
                        span.classList.add('bg-black/25');
                        playSound('sound-check');
                    } else {
                        label.classList.remove('bg-[#c44241]');
                        label.classList.add('bg-black/25]');
                        span.classList.add('bg-[#c44241]');
                        span.classList.remove('bg-black/25');
                        playSound('sound-uncheck');

                    }
                });
            });
            // var datas = ;
             // Calculer le score total basé uniquement sur les questions visibles
             var scoreTotal = 0;
             let scores = {}; // Pour stocker les scores individuels des questions visibles
                
            forms.forEach(function(form, index) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Empêche la soumission normale du formulaire
                    playSound('sound-validate');
                    var submitBtn = form.querySelector('input[type="submit"]');
                    submitBtn.disabled = true; // Désactiver le bouton de soumission pendant le traitement
                    submitBtn.classList.add('hidden'); // Désactiver le bouton de soumission pendant le traitement
                    var checkboxes = form.querySelectorAll('input[type="checkbox"]');
                    var isChecked = false;
                    checkboxes.forEach(function(checkbox) {
                        if (checkbox.checked) {
                            isChecked = true;
                        }
                    });

                    if (!isChecked) {
                        playSound('sound-alert')
                        alert('Veuillez cocher au moins une réponse.');
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('hidden');
                        return; // Arrêter la soumission si aucune case n'est cochée
                    }
                    var formData = new FormData(form); // Récupérer les données du formulaire
                    var url = form.getAttribute('action'); // Récupérer l'URL d'action du formulaire
    
                    fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Traiter la réponse du serveur
                        console.log('Réponse du serveur :', data);
                        // datas = data;
                        // Marquer les bonnes réponses
                        playSound('sound-reponse');
                        var bonnesReponses = data.bonnesReponses;
                        bonnesReponses.forEach(function(reponseId) {
                            var label = form.querySelector('label input[value="' + reponseId + '"]').parentNode;
                            if (label) {
                                label.classList.add('bg-green-500'); // Appliquer une classe pour indiquer la bonne réponse
                            }
                        });
    
                        // Calculer et afficher le score pour cette question
                        const score = parseInt(data.score,10);
                        scores += score;
                        var questionSuivante = form.querySelector('#questionSuivante');
                        var messageScore = document.createElement('div');
                        messageScore.textContent = 'Score pour cette question : ' + score;
                        messageScore.classList.add('message-score');
                        form.querySelector('.grid').appendChild(messageScore); // Ajouter le message sous la grille des propositions
    
                        // Afficher la question suivante s'il y en a une
                        // var questionSuivante = form.nextElementSibling;
                        // if (questionSuivante && questionSuivante.classList.contains('question-suivante')) {
                        //     questionSuivante.classList.remove('hidden');
                        // }

                        if (questionSuivante) {
                        questionSuivante.classList.remove('hidden');
                        questionSuivante.addEventListener('click',()=>{
                            playSound('sound-suivant');
                            var nextQuestion = form.nextElementSibling;
                            console.log(nextQuestion);
                            if (nextQuestion && questionSuivante.classList.contains('question-suivante') ) {
                                nextQuestion.classList.remove('hidden');
                                questionSuivante.classList.add('hidden');
                            }
                    })//&& nextQuestion.classList.contains('question-suivante')
                    }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la soumission du formulaire :', error);
                        // Gérer les erreurs si nécessaire
                    });
                });
            });
            
            // Gérer la soumission finale pour calculer le score total
            console.log({{$question->id}});
            var dernierForm = forms[forms.length - 2];
            questionSuivante.classList.add('hidden');
            console.log(scores);
            dernierForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Empêche la soumission normale du formulaire
                
               
                // forms.forEach(function(form, index) {
                //     // Vérifier si le formulaire est visible
                //     if (!form.classList.contains('hidden')) {
                    //         var bonnesReponses = form.querySelectorAll('.bg-green-500').length;
                    //         scoreTotal += bonnesReponses;
                //         scores['question_' + (index + 1)] = bonnesReponses;
                //     }
                // });
    
                // console.log('Scores individuels :', scores);
                console.log({{$question->id}});
                var url = "{{ route('calculerScoreTotal',[$partie->id])}}"; // URL pour calculer le score total
    
                fetch(url, {
                    method: 'POST',
                    body: JSON.stringify({
                        scores: scores
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Traiter la réponse du serveur
                    
                    playSound('sound-resultat')
                    console.log(scores);
                    console.log('Score total :', data.scoreTotal);
                    var messageScoreTotal = document.createElement('div');
                    messageScoreTotal.textContent = data.scoreTotal;
                    messageScoreTotal.classList.add('message-score');
                    resultcontainer.classList.remove('hidden');
                    resultat.appendChild(messageScoreTotal); // Ajouter le message sous la dernière question
    
                    // Rediriger ou afficher une autre action après avoir obtenu le score total
                    // Par exemple, rediriger l'utilisateur vers une autre page
                    // window.location.href = '/resultats';
                })
                .catch(error => {
                    console.error('Erreur lors du calcul du score total :', error);
                    // Gérer les erreurs si nécessaire
                });
            });
        });
    </script>
    
@endsection
