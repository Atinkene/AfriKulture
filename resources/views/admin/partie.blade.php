@extends('admin.layout')
@section('content')
    <div class="w-[95%] m-auto max-h-screen overflow-visible mt-10">
        <div class="flex justify-center items-center pb-5 ">
            {{-- <p class="text-blue-900 font-bold text-2xl italic">Bilan de l'évaluation : {{$partie['nom']}}</p> --}}
        </div>
        <div class="justify-center items-center shadow-lg p-5">
            <form action="" method="post">
                @csrf
                <div class="w-full bg-white">
                     <span class="text-blue-900  flex justify-center items-center">
                        <input class="text-center font-bold text-2xl" readonly name="nom" type="text" value=" {{$partie['nom']}}" class="text-2xl font-bold"><br> 
                     </span>
                </div>
                <div class="flex justify-center items-center w-full space-x-2 p-3">
                    @foreach ($questions as $index=>$question)
                        <a href="#{{$index+1}}"><div class="flex justify-center items-center px-3  bg-blue-900 text-white font-semibold rounded-full">{{$index+1}}</div></a>
                    @endforeach
                </div>
                <div class="w-full bg-white flex justify-center items-center p-5 relative ">
                    <div class="text-blue-900 text-lg flex justify-center items-center m-auto">
                        <label class="text-lg font-bold" for="date">Date :</label>
                        <input readonly name="date" value=" {{$partie['dateDebut']}}" type="text"><br>
                     </div>
                     
                     <div class="text-blue-900 text-lg flex justify-center items-center m-auto">
                        <label class="text-lg font-bold" for="duree">Durée : </label>
                        <input readonly name="duree" value=" {{$partie['duree']}} mn(s)" type="text" ><br> 
                     </div>
               </div>
               <div class="flex justify-center items-center p-2">
                    <h3 class="font-bold">Les bonnes réponses sont celles qui sont cochées</h3>
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
                                        @if ($item['estCorrecte']==1)
                                            <div class="propositions p-1">
                                                <input class="ml-16" type="checkbox" readonly name="reponses[{{$index}}][]" id="" value="{{$item['libelle']}}" readonly checked>
                                                <span class="ml-16">{{++$key}}.</span><input readonly class="ml-2 w-[80%]" type="text" value="{{$item['libelle']}}" name="propositions[0][]" placeholder="Entrez une proposition"><br><br>
                                            </div>
                                        @else
                                            <div class="propositions p-1">
                                                <input class="ml-16" type="checkbox" readonly name="reponses[{{$index}}][]" id="" value="{{$item['libelle']}}" readonly >
                                                <span class="ml-16">{{++$key}}.</span><input readonly class="ml-2 w-[80%]" type="text" value="{{$item['libelle']}}" name="propositions[0][]" placeholder="Entrez une proposition"><br><br>
                                            </div>
                                        @endif
                                        
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
@endsection
