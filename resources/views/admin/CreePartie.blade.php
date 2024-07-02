@extends('admin.layout')

@section('content')
    <div class="w-[95%] m-auto max-h-screen overflow-visible mt-20">
        <form action="{{route('AdminPostCreePartie')}}" method="post">
            @csrf
           
            <div class="w-full bg-white">
                <span class="text-blue-900 text-lg flex justify-center items-center">
                    <label class="text-lg font-bold" for="nom">Libellé :</label>
                    <input name="nom" type="text" placeholder="Entrez le libellé de l'évaluation"><br> 
                </span>
                @error('nom')
                    <div class="text-red-500 justify-center items-center flex">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full" id="ckbox">
                <fieldset class="border-2">
                    <legend class="ml-5">Description</legend>
                    <textarea class="w-full h-full"  id="editor" name="description" ></textarea>
                </fieldset>
            </div>
            <div class="w-full bg-white flex justify-center items-center p-5">
                <div class="text-blue-900 text-lg flex justify-center items-center m-auto">
                    <label class="text-lg font-bold" for="date">Date :</label>
                    <input name="date" type="date"><br>
                </div>
                <div class="text-blue-900 text-lg flex justify-center items-center m-auto">
                    <label class="text-lg font-bold" for="debut">Début :</label>
                    <input name="debut" type="time"><br> 
                </div>
                <div class="text-blue-900 text-lg flex justify-center items-center m-auto">
                    <label class="text-lg font-bold" for="duree">Durée :</label>
                    <input name="duree" class="w-" type="number" placeholder="Entrez la durée en minutes"><br> 
                </div>
            </div>

            <div class="flex space-x-12 w-full justify-center items-center">
                @error('date')
                    <div class="text-red-500 justify-center items-center flex">{{ $message }}</div>
                @enderror
                @error('debut')
                    <div class="text-red-500 justify-center items-center flex">{{ $message }}</div>
                @enderror
                @error('duree')
                    <div class="text-red-500 justify-center items-center flex">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-center items-center">
                <p>Veuillez fournir les informations demandées (Cliquez sur le + pour obtenir plus d'éléments).</p>
            </div>

            <div id="questions">
                <div class="question shadow-md shadow-blue-900/400 rounded-b-2xl w-full mb-5">
                    <div class="w-full ml-5 text-blue-900 text-lg p-5 space-x-2 flex justify-center items-center">
                        <div class="w-5/6">
                            <label class="font-bold" for="">Question 1 : </label>
                            <input class="w-[80%]" name="questions[0][libelle]" type="text" placeholder="Entrez le libellé de la question"> <br>
                        </div>
                        <div class="w-1/6">
                            <label class="font-bold" for="">Points : </label>
                            <input class="w-24 " type="number" name="questions[0][points]" placeholder="Points">
                        </div>
                    </div>
                    <div class="propositions p-2">
                        <span class="ml-16">1.</span>
                        <input class="ml-2 w-[80%]" type="text" name="propositions[0][]" placeholder="Entrez une proposition"><br><br>
                    </div>
                    <div class="flex justify-center items-center w-full space-x-10">
                        @error('questions.*.libelle')
                            <div class="text-red-500 justify-center items-center flex">{{ $message }}</div>
                        @enderror
                        @error('questions.*.points')
                            <div class="text-red-500 justify-center items-center flex">{{ $message }}</div>
                        @enderror
                        @error('propositions.*.*')
                            <div class="text-red-500 justify-center items-center flex">{{ $message }}</div>
                        @enderror
                        @error('questions.*.propositions.*.correct')
                        <div class="text-red-500 justify-center items-center flex">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="flex justify-center items-center">
                        <button type="button" class="add-proposition h-10 flex justify-center items-center mb-3 bg-blue-900 rounded-full p-4 font-bold text-white text-xl">+</button>
                    </div>
                </div>
                
            </div>
            
            <div class="flex justify-center items-center p-5">
                <button class="h-8 flex justify-center items-center mb-3 bg-blue-900 rounded-full p-4 font-bold text-white text-sm" type="button" id="addQuestion">Ajouter une question</button>
            </div>
           
            <div class="text-black flex justify-center items-center space-x-auto">
                <div class="m-auto w-1/6">
                    <select class="w-full h-12 text-center" name="niveau" id="">
                        <option value="">Choisir le niveau</option>
                        @foreach ($niveaux as $niveau)
                            <option value="{{$niveau->nom}}">{{$niveau->nom}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="m-auto">
                    <input type="checkbox" name="joueurAnonyme"  value="1" id="">
                    <label for="">Cette évaluation est accessible aux joueurs anonymes</label>
                </div>
            </div>
            <div class="flex justify-center items-center p-5">
                <input class="h-12 bg-blue-900 rounded-lg p-3 font-bold text-white cursor-pointer" type="submit" value="Suivant">
            </div>
        </form>
      </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addQuestion = document.getElementById('addQuestion');
        const questionsDiv = document.getElementById('questions');
        let questionIndex = 1;
        
        addQuestion.addEventListener('click', () => {
            ajouterQuestion();
        });

        questionsDiv.addEventListener('change', function(event) {
            const target = event.target;
            if (target.classList.contains('proposition-checkbox')) {
                const correctInput = target.previousElementSibling;
                if (target.checked) {
                    correctInput.value = "true";
                } else {
                    correctInput.value = "false";
                }
            }
        });

        function ajouterProposition(questionElement, index) {
            const propositionsDiv = questionElement.querySelector('.propositions');
            const propositionCount = propositionsDiv.querySelectorAll('input[type="text"]').length + 1; // +1 pour le prochain numéro de proposition
            const newProposition = `
                <span class="ml-16">${propositionCount}.</span>
                <input class="ml-2 w-[80%]" type="text" name="propositions[${index}][]" placeholder="Entrez une proposition"><br><br>
            `;
            propositionsDiv.insertAdjacentHTML('beforeend', newProposition);
        }

        function ajouterQuestion() {
            const newQuestion = document.createElement('div');
            newQuestion.classList.add('question', 'shadow-md', 'shadow-blue-900/400', 'rounded-b-2xl', 'w-full', 'mb-5');
            newQuestion.innerHTML = `
                <div class="w-full ml-5 text-blue-900 text-lg p-5 space-x-2 flex justify-center items-center">
                    <div class="w-5/6">
                        <span class="font-bold">Question ${questionIndex + 1} : </span>
                        <input class="w-[80%]" name="questions[${questionIndex}][libelle]" type="text" placeholder="Entrez le libellé de la question">
                    </div>
                    <div class="w-1/6">
                        <label class="font-bold" for="">Points : </label>
                        <input class="w-24" type="number" name="questions[${questionIndex}][points]" placeholder="Points">
                    </div>
                </div>
                <div class="propositions p-2">
                    <span class="ml-16">1.</span>
                    <input class="ml-2 w-[80%]" type="text" name="propositions[${questionIndex}][]" placeholder="Entrez une proposition"><br><br>
                </div>
                <div class="flex justify-center items-center">
                    <button type="button" class="add-proposition h-10 flex justify-center items-center mb-3 bg-blue-900 rounded-full p-4 font-bold text-white text-xl">+</button>
                </div>
            `;
            questionsDiv.appendChild(newQuestion);

            const addPropositionBtn = newQuestion.querySelector('.add-proposition');
            addPropositionBtn.addEventListener('click', () => ajouterProposition(newQuestion, questionIndex-1));
            
            questionIndex++;
        }


        // Ajouter une proposition initiale à la première question
        const initialAddPropositionBtn = document.querySelector('.add-proposition');
        initialAddPropositionBtn.addEventListener('click', () => ajouterProposition(document.querySelector('.question'), 0));
    });
</script>
