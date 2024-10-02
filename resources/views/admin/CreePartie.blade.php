@extends('admin.layout')

@section('content')
    <div class="">
        <form action="{{route('AdminPostCreePartie')}}" method="post" class="" >
            @csrf
           
            <div class="w-full bg-gradient-to-l  from-[#c44241] via-[#c44241] to-[#cf6d60] rounded-3xl p-2">
                <span class="text-[#c44241] w-full text-lg flex justify-center items-center space-x-1">
                    <label class="text-lg font-bold text-white " for="nom">Libellé :</label>
                    <input class="bg-black/25 rounded-3xl text-white w-2/3 p-2 placeholder:text-white/50" name="nom" type="text" placeholder="Entrez le libellé de l'évaluation"><br> 
                </span>
                @error('nom')
                    <div class="text-red-500 justify-center items-center flex">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full p-2 mt-5 bg-white rounded-3xl" id="ckbox">
                <fieldset class="border-2 border-dashed border-[#c44241] rounded-3xl">
                    <legend class="ml-5 text-xl font-bold  text-[#c44241]">Description</legend>
                    <textarea class="w-full h-full rounded-3xl text-gray-500 placeholder:text-lg p-2 focus-none focus:outline-none" maxlength="255" id="editor" name="description" placeholder="Entrez la description de la partie" ></textarea>
                </fieldset>
            </div>
            <div class="w-full flex justify-center items-center p-5">
                <div class="text-[#c44241] text-lg flex justify-center items-center m-auto bg-white rounded-full p-2 space-x-3">
                    <label class="text-lg font-bold" for="date">Date :</label>
                    <input name="date" type="date"><br>
                </div>
                <div class="text-[#c44241] text-lg flex justify-center items-center m-auto bg-white rounded-full p-2 space-x-3">
                    <label class="text-lg font-bold" for="debut">Début :</label>
                    <input name="debut" type="time"><br> 
                </div>
                <div class="text-[#c44241] text-lg flex justify-center items-center m-auto bg-white rounded-full p-2 space-x-3">
                    <label class="text-lg font-bold" for="duree">Durée :</label>
                    <input name="duree" class="" type="number" placeholder="en minutes" min="0"><br> 
                </div>
                <div class="hidden text-[#c44241] text-lg  justify-center items-center m-auto">
                    <label class="text-lg font-bold" for="duree">Type :</label>
                    <select name="type" id="">
                        <option value="">Choisir le type</option>
                        <option value="image">Image à texte</option>
                        <option selected value="text">Texte à texte</option>
                    </select>
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

            <div class="flex justify-center items-center text-white text-lg p-2">
                <p>Veuillez fournir les informations demandées (Cliquez sur le + pour obtenir plus d'éléments).</p>
            </div>

            <div id="questions">
                <div class="bg-gradient-to-l  from-[#c44241] via-[#c44241] to-[#cf6d60] question shadow-md shadow-[#c44241]/400 rounded-3xl w-full mb-5">
                    <div class="w-full ml-5 text-[#c44241] text-lg p-5 space-x-2 flex justify-center items-center">
                        <div class="w-5/6">
                            <label class="font-bold text-white" for="">Question 1 : </label>
                            <input class="w-[80%] bg-black/25 text-white rounded-3xl p-2 placeholder:text-white/50" name="questions[0][libelle]" type="text" placeholder="Entrez le libellé de la question"> <br>
                        </div>
                        <div class="w-1/6 bg-white rounded-full h-full flex justify-end items-center">
                            <label class="font-bold w-3/5 p-1" for="">Points :</label>
                            <input class=" shadow-inner w-2/5 h-full rounded-r-full p-2" type="number" min="0" placeholder="" name="questions[0][points]" >
                        </div>
                    </div>
                    <div class="propositions p-2">
                        <span class="ml-16 text-white">1.</span>
                        <input class="ml-2 w-[80%] bg-white/50 p-1 rounded-3xl text-[#c44241] placeholder:text-[#c44241]" type="text" name="propositions[0][]" placeholder="Entrez une proposition"><br><br>
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
                        <button type="button" class="add-proposition h-5 flex justify-center items-center mb-3 bg-white/50 rounded-full w-10 font-bold text-[#c44241] text-lg">+</button>
                    </div>
                </div>
                
            </div>
            
            <div class="flex justify-center items-center p-5">
                <button class="h-8 flex justify-center items-center mb-3 bg-[#c44241] rounded-full p-4 font-bold text-white text-sm" type="button" id="addQuestion">Ajouter une question</button>
            </div>
           
            <div class="h-12 text-[#c44241] w-full rounded-3xl flex justify-center items-center bg-white">
                <div class="m-auto flex justify-center items-center space-x-2">
                    <label class=" text-lg font-bold " for="niveau">Type :</label>
                    <select class="bg-transparent  text-center " name="niveau" id="">
                        <option class="text-sm" value="">Choisir le niveau</option>
                        @foreach ($niveaux as $niveau)
                            <option class="text-sm" value="{{$niveau->nom}}">{{$niveau->nom}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="m-auto font-semibold">
                    <input type="checkbox" name="joueurAnonyme"  value="1" id="">
                    <label for="joueurAnonyme">Cette évaluation est accessible aux joueurs anonymes</label>
                </div>
            </div>
            <div class="flex justify-center items-center p-5">
                <input class="h-12 bg-[#c44241] rounded-lg p-3 font-bold text-white cursor-pointer" type="submit" value="Suivant">
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
                <span class="ml-16 text-white">${propositionCount}.</span>
                <input class="ml-2 w-[80%] bg-white/50 p-1 rounded-3xl text-[#c44241] placeholder:text-[#c44241]" type="text" name="propositions[${index}][]" placeholder="Entrez une proposition"><br><br>
            `;
            propositionsDiv.insertAdjacentHTML('beforeend', newProposition);
        }

        function ajouterQuestion() {
            const newQuestion = document.createElement('div');
            newQuestion.classList.add('bg-gradient-to-l',  'from-[#c44241]', 'via-[#c44241]', 'to-[#cf6d60]','question', 'shadow-md', 'shadow-[#c44241]/400', 'rounded-3xl', 'w-full', 'mb-5');
            newQuestion.innerHTML = `
                <div class=" w-full ml-5 text-[#c44241] text-lg p-5 space-x-2 flex justify-center items-center">
                    <div class="w-5/6">
                        <span class="font-bold text-white">Question ${questionIndex + 1} : </span>
                        <input class="w-[80%] bg-black/25 text-white rounded-3xl p-2 placeholder:text-white/50" name="questions[${questionIndex}][libelle]" type="text" placeholder="Entrez le libellé de la question">
                    </div>
                    <div class="w-1/6 bg-white rounded-full h-full flex justify-end items-center">
                        <label class="font-bold w-3/5 p-1" for="">Points : </label>
                        <input class="shadow-inner w-2/5 h-full rounded-r-full p-2" type="number" min="0" placeholder=" name="questions[${questionIndex}][points]">
                    </div>
                </div>
                <div class="propositions p-2">
                    <span class="ml-16 text-white">1.</span>
                    <input class="ml-2 w-[80%] bg-white/50 p-1 rounded-3xl text-[#c44241] placeholder:text-[#c44241]" type="text" name="propositions[${questionIndex}][]" placeholder="Entrez une proposition"><br><br>
                </div>
                <div class="flex justify-center items-center">
                    <button type="button" class="add-proposition h-5 flex justify-center items-center mb-3 bg-white/50 rounded-full w-10 font-bold text-[#c44241] text-lg">+</button>
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
