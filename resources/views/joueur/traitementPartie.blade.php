@extends('joueur.layout')
@section('content')
    <div class="w-[95%] m-auto max-h-screen overflow-visible mt-10">
        <div class="flex justify-center items-center pb-5 ">
            {{-- <p class="text-blue-900 font-bold text-2xl italic">Bilan de l'évaluation : {{$partie['nom']}}</p> --}}
        </div>
        <div class="justify-center items-center shadow-lg p-5">
            <form id="form" action="{{route('postTraitementPartie',[request()->segment(4)])}}" method="post">
                @csrf
                <div class="w-full bg-white flex justify-center pb-5">
                    <span class="text-blue-900 text-lg flex justify-center items-center">
                       <label class="text-2xl" for="nom">Nom de la partie : </label>
                       <input class="text-3xl text-center font-bold" readonly name="nom" type="text" value=" {{$partie['nom']}}" placeholder="Entrez le libellé de l'évaluation"><br> 
                    </span>
               </div>
                <div class="flex justify-center items-center w-full space-x-2 p-3">
                    @foreach ($questions as $index=>$question)
                        <a href="#{{$index+1}}"><div class="flex justify-center items-center px-3  bg-blue-900 text-white font-semibold rounded-full">{{$index+1}}</div></a>
                    @endforeach
                </div>
                <div class="w-full bg-white flex justify-center items-center p-5 relative space-x-auto ">
                    
                    <div class="text-blue-900 text-lg w-1/2 flex justify-start bg-white items-center p-2">
                        <label class="text-lg font-bold" for="duree">Temps restant :</label>
                        <span id="remainingTime" class="w-24 text-center font-bold text-2xl">00:00:00</span>
                    </div>
                    <div class="w-full bg-white">
                        <span class="text-blue-900 text-lg flex justify-center items-center">
                            <label class="font-bold">Heure de fin :</label>
                            <span id="endTime" class="ml-2 text-2xl font-bold">00:00:00</span>
                        </span>
                    </div>
                     <div class=" w-1/2 flex justify-end items-center">
                        <div class="flex justify-center items-center ">
                            <input id="secInput"  class="h-12 bg-blue-900 rounded-lg p-3 font-bold text-white cursor-pointer" type="submit" value="Suivant">
                        </div>
                    </div>
               </div>
               <div class="flex justify-center items-center p-2">
                    <h3 class="font-bold">Veuillez cocher la ou les bonnes réponses</h3>
                </div>
                <div id="questions">
                    @foreach ($questions as $index => $question)
                        <div class="question shadow-md shadow-blue-900/400 hover:shadow-blue-900 rounded-b-2xl w-full mb-5" id="{{$index+1}}">
                            <div class="w-full ml-5  text-blue-900 text-lg p-5 space-x-2 flex justify-center items-center">
                                <div class="w-5/6">
                                <label class="font-bold" for="">Question {{$index+1}} : </label><input readonly class="w-[80%]" name="questions[0]" type="text" value="{{$question['libelle']}}" placeholder="Entrez le libellé de la question"> <br>
                                </div>
                                <div class="w-1/6">
                                    <label class="font-bold" for="">Points : </label><input readonly class="w-24 "  type="number" name="" id="" value="{{$question['nombrePoint']}}" placeholder="Points">
                                </div>
                            </div>
                            @foreach ($propositions as $slug => $proposition)
                                @foreach ($proposition as $key=>$item)
                                    @if ($item['question'] == $question->id)
                                        <div class="propositions p-1">
                                            <input class="ml-16" type="checkbox" name="reponses[{{$index}}][]" id="" value="{{$item['libelle']}}">
                                            <span class="ml-16">{{++$key}}.</span><input readonly class="ml-2 w-[80%]" type="text" value="{{$item['libelle']}}" name="propositions[0][]" placeholder="Entrez une proposition"><br><br>
                                        </div>
                                    @endif
                                @endforeach
                                
                            @endforeach
                            
                            
                        </div>
                    @endforeach
                    
                </div>
               
                
            </form>
        </div>
        {{-- <form method="POST" action="{{ route('logout') }}">
            @csrf
            @method('DELETE')
            <button type="submit">Se déconnecter</button>
        </form> --}}
      </div>
      <div id="noTime" class=" hidden absolute h-72 rounded-2xl w-1/3 right-96 p-5 shadow-lg  justify-center items-center bg-white">
        <div class="space-y-10">
            <h1 class="text-blue-900 font-bold text-4xl text-center">Temps écoulé!</h1>
            <p class="text-xl">Voulez-vous sauvegarder votre partie?</p>
            <div class="flex justify-center items-centerw-full ">
                <div class="m-auto">
                    <a class="bg-white border rounded-lg p-2 text-blue-900 text-lg border-blue-900" href="{{route('partieAvenir')}}">Annuler</a>
                </div>
                <div class=" w-1/2 flex justify-end items-center">
                    <div class="flex justify-center items-center ">
                        <input  id="input" class="h-12 bg-blue-900 rounded-lg p-3 font-bold text-white cursor-pointer" type="submit" value="Suivant">
                    </div>
                </div>
                
            </div>
        </div>
    </div>
      
   

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let remainingTimeMinutes = parseInt("{{ $partie['duree'] }}");
    
            let heureDebutParts = "{{ $partie['HeureDebut'] }}".split(':');
            let heureDebut = new Date();
            heureDebut.setHours(parseInt(heureDebutParts[0]));
            heureDebut.setMinutes(parseInt(heureDebutParts[1]));
            heureDebut.setSeconds(0); 
    
            let remainingTimeSeconds = parseInt(localStorage.getItem('remainingTimeSeconds'));
            if (!remainingTimeSeconds || isNaN(remainingTimeSeconds)) {
                remainingTimeSeconds = remainingTimeMinutes * 60;
                localStorage.setItem('remainingTimeSeconds', remainingTimeSeconds.toString());
            }
    
            function updateTimer() {
                let hours = Math.floor(remainingTimeSeconds / 3600);
                let minutes = Math.floor((remainingTimeSeconds % 3600) / 60);
                let seconds = remainingTimeSeconds % 60;
    
                document.getElementById('remainingTime').innerText = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    
                let endTime = new Date(heureDebut.getTime() + remainingTimeSeconds * 1000);
    
                let formattedEndTime = `${endTime.getHours().toString().padStart(2, '0')}:${endTime.getMinutes().toString().padStart(2, '0')}:${endTime.getSeconds().toString().padStart(2, '0')}`;
                document.getElementById('endTime').innerText = formattedEndTime;
    
                remainingTimeSeconds--;
    
                localStorage.setItem('remainingTimeSeconds', remainingTimeSeconds.toString());
    
                if (remainingTimeSeconds == 0) {
                    clearInterval(timerInterval);
                    const form = document.getElementById('form');
                    
                    const inputs = document.getElementById('input');
                    const secInput = document.getElementById('secInput');
                    inputs.addEventListener('click',()=>{
                        secInput.click();
                    })

                    const noTime = document.getElementById('noTime');
                    form.classList.add("blur");
                    noTime.classList.remove("hidden");
                    noTime.classList.add("flex");
            

                }
            }
    
            updateTimer();
    
            let timerInterval = setInterval(updateTimer, 1000);

        });
    </script>

@endsection
