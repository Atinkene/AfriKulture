@extends('admin.layout')
@section('content')
    <div class="m-auto max-h-screen overflow-visible ">
        <div class="flex justify-center items-center pb-5 ">
            <p class="text-white font-bold text-2xl italic">{{$partie['nom']}}</p>
        </div>
        <div class="justify-center items-center p-5">
            <form action="{{route('AdminPostBilanPartie')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="w-full bg-white">
                     <span class="text-white text-lg flex justify-center items-center">
                    </span>
                </div>
                <div class="w-full bg-gradient-to-l  from-[#c44241] via-[#c44241] to-[#cf6d60] rounded-3xl p-2">
                    <span class="text-[#c44241] w-full text-lg flex justify-center items-center space-x-1">
                        <label class="text-lg font-bold text-white" for="nom">Nom de la partie : </label>
                        <input readonly class="bg-black/25 rounded-3xl text-white w-2/3 p-2 placeholder:text-white/50" readonly name="nom" type="text" value=" {{$partie['nom']}}" ><br> 
                    </span>
                    @error('nom')
                        <div class="text-red-500 justify-center items-center flex">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-white text-lg flex justify-center items-center m-auto">
                    <div class="w-full p-2 mt-5 bg-white rounded-3xl" id="ckbox">
                        <fieldset class="border-2 border-dashed border-[#c44241] rounded-3xl">
                            <legend class="ml-5 text-xl font-bold  text-[#c44241]">Description</legend>
                            <textarea class="w-full h-full rounded-3xl text-gray-500 placeholder:text-lg p-2 focus-none focus:outline-none" maxlength="255" id="editor" name="description" placeholder="Entrez la description de la partie" >{{$partie['description']}}</textarea>
                        </fieldset>
                    </div>
                </div>
                
                <div class="w-full flex justify-center items-center p-5">
                    <div class="text-[#c44241] text-lg flex justify-center items-center m-auto bg-white rounded-full p-2 space-x-3">
                        <label class="text-lg font-bold" for="date">Date :</label>
                        <input readonly readonly name="date" value="{{$partie['dateDebut']}}" type="text"><br>
                    </div>
                    <div class="text-[#c44241] text-lg flex justify-center items-center m-auto bg-white rounded-full p-2 space-x-3">
                        <label class="text-lg font-bold" for="debut">Début :</label>
                        <input readonly readonly name="debut" value="{{$partie['HeureDebut']}}" type="text"><br> 
                    </div>
                    <div class="text-[#c44241] text-lg flex justify-center items-center m-auto bg-white rounded-full p-2 space-x-3">
                        <label class="text-lg font-bold" for="duree">Durée :</label>
                        <input readonly readonly name="duree" class="w-" value="{{$partie['duree']}}" type="number" placeholder="Entrez la durée en minutes"><br> 
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
               <div class="flex justify-center items-center p-2 text-white">
                    <h3 class="font-bold">Les bonnes réponses sont celles qui sont cochées</h3>
                </div>
                <div id="questions">
                    @foreach ($questions as $index => $question)
                    <div class="bg-gradient-to-l  from-[#c44241] via-[#c44241] to-[#cf6d60] question shadow-md shadow-[#c44241]/400 rounded-3xl w-full mb-5">
                        <div class="w-full ml-5 text-[#c44241] text-lg p-5 space-x-2 flex justify-center items-center">
                            
                                <div class="w-5/6">
                                    <label class="font-bold text-white" for="">Question  {{$index+1}} : </label>
                                    <input readonly class="w-[80%] bg-black/25 text-white rounded-3xl p-2 placeholder:text-white/50" name="questions[0][libelle]" type="text" value="{{$question['libelle']}}" placeholder="Entrez le libellé de la question"> <br>
                                </div>
                                <div class="w-1/6 bg-white rounded-full h-full flex justify-end items-center">
                                    <label class="font-bold w-3/5 p-1" for="">Points :</label>
                                    <input readonly class=" shadow-inner w-2/5 h-full rounded-r-full p-2" type="number" min="0" placeholder="" value="{{$question['nombrePoint']}}" name="questions[0][points]" >
                                </div>
                            </div>
                            @foreach ($propositions as $slug => $proposition)
                                @foreach ($proposition as $key=>$item)
                                    @if ($item['question'] == $question->id)
                                        @if ($item['estCorrecte']==1)
                                            <div class="propositions p-1">
                                                <input class="ml-16  bg-white/50 p-1 rounded-3xl text-[#c44241] placeholder:text-[#c44241]" type="checkbox" readonly name="reponses[{{$index}}][]" id="" value="{{$item['libelle']}}" readonly checked>
                                                <span class="text-white">{{++$key}}.</span><input readonly class="ml-2 w-[80%] bg-white/50 p-1 rounded-3xl text-[#c44241] placeholder:text-[#c44241]" type="text" value="{{$item['libelle']}}" name="propositions[0][]" placeholder="Entrez une proposition"><br><br>
                                            </div>
                                        @else
                                            <div class="propositions p-1">
                                                <input class="ml-16  bg-white/50 p-1 rounded-3xl text-[#c44241] placeholder:text-[#c44241]" type="checkbox" readonly name="reponses[{{$index}}][]" id="" value="{{$item['libelle']}}" readonly >
                                                <span class="text-white">{{++$key}}.</span><input readonly class="ml-2 w-[80%] bg-white/50 p-1 rounded-3xl text-[#c44241] placeholder:text-[#c44241]" type="text" value="{{$item['libelle']}}" name="propositions[0][]" placeholder="Entrez une proposition"><br><br>
                                            </div>
                                        @endif
                                        
                                    @endif
                                @endforeach
                            @endforeach
                            
                            
                        </div>
                    @endforeach
                    
                </div>
                <div class="h-12 text-[#c44241] w-full rounded-3xl flex justify-center items-center bg-white">
                    <div class="m-auto flex justify-center items-center space-x-2">
                        <div class="w-full h-12 text-center flex justify-center items-center shadow-inner space-x-2" id="">
                                <span class="flex justify-center items-center font-bold">Niveau choisi : </span>
                                {{' '.$partie['niveau']}}
                            </fieldset>
                        </div>
                    </div>
                    <div class="m-auto font-semibold">
                        @if ($partie['joueurAnonyme'])
                            <input readonly checked readonly type="checkbox" name="joueurAnonyme"  value="1" id="">
                        @else
                        <input readonly type="checkbox" name="joueurAnonyme"  value="1" id="">
                            
                        @endif
                        <label for="">Cette partie est accessible aux joueurs anonymes</label>
                    </div>
                </div>
                <div class="text-black mt-5 bg-white flex justify-center items-center space-x-auto rounded-3xl shadow-lg p-5 w-full">
                    <fieldset class="m-auto border-[#c44241] border-2 p-3 border-dashed rounded-lg">
                        <legend class="text-[#c44241] font-bold">Miniature</legend>
                        <img class="h-36" src="/storage/{{$partie->miniature}}" alt="">
                    </fieldset>
                    <fieldset class="m-auto border-[#c44241] border-2 p-3 border-dashed rounded-lg">
                        <legend class="text-[#c44241] font-bold">Image de fond</legend>
                        <img class="h-36" src="/storage/{{$partie->imageFond}}" alt="">
                    </fieldset>
                    <fieldset class="m-auto border-[#c44241] border-2 p-3 border-dashed rounded-lg">
                        <legend class="text-[#c44241] font-bold">Couleur de fond</legend>
                        <input readonly type="color" name="couleurFond" value="{{$partie->couleurFond}}" id="">
                    </fieldset>
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
