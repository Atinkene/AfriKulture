@extends('admin.layout')
@section('content')
    <div class="m-auto max-h-screen overflow-visible">
        <div class="flex justify-center items-center pb-5 ">
            <p class="text-white font-bold text-2xl italic">Bilan de la partie : {{$partie['nom']}}</p>
        </div>
        <div class="justify-center items-center shadow-lg p-5">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="w-full bg-gradient-to-l  from-[#c44241] via-[#c44241] to-[#cf6d60] rounded-3xl p-2">
                    <span class="text-[#c44241] w-full text-lg flex justify-center items-center space-x-1">
                        <label class="text-lg font-bold text-white" for="nom">Nom de la partie : </label>
                        <input class="bg-black/25 rounded-3xl text-white w-2/3 p-2 placeholder:text-white/50" readonly name="nom" type="text" value=" {{$partie['nom']}}" ><br> 
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
                        <input readonly name="date" value="{{$partie['date']}}" type="date"><br>
                    </div>
                    <div class="text-[#c44241] text-lg flex justify-center items-center m-auto bg-white rounded-full p-2 space-x-3">
                        <label class="text-lg font-bold" for="debut">Début :</label>
                        <input readonly name="debut" value="{{$partie['debut']}}" type="time"><br> 
                    </div>
                            
                   <div class="text-[#c44241] text-lg flex justify-center items-center m-auto bg-white rounded-full p-2 space-x-3">
                        <label class="text-lg font-bold" for="duree">Durée :</label>
                        <input readonly name="duree" class="w-" value="{{$partie['duree']}}" type="number" placeholder="Entrez la durée en minutes"><br> 
                    </div>
                </div> 
                <div class="flex justify-center items-center p-2 text-white">
                    <h3 class="font-bold">Veuillez cocher la ou les bonnes réponses</h3>
                </div>
                <div id="questions">
                    @foreach ($partie['questions'] as $index => $question)
                    <div class="hover:shadow-[#c44241] bg-gradient-to-l  from-[#c44241] via-[#c44241] to-[#cf6d60] question shadow-md shadow-[#c44241]/400 rounded-3xl w-full mb-5">
                        <div class="w-full ml-5 text-[#c44241] text-lg p-5 space-x-2 flex justify-center items-center">
                            
                                <div class="w-5/6 flex justify-center items-center space-x-2">
                                    <label class="font-bold text-white" for="">Image  {{$index+1}} : </label>
                                    <img  class="h-72 rounded-3xl" src="/storage/{{$question['libelle']}}" alt="">

                                </div>
                                <div class="w-1/6 bg-white rounded-full h-full flex justify-end items-center">
                                    <label class="font-bold w-3/5 p-1" for="">Points :</label>
                                    <input class=" shadow-inner w-2/5 h-full rounded-r-full p-2" type="number" min="0" placeholder="" value="{{$question['points']}}" name="questions[0][points]" >
                                </div>
                            </div>
                            @foreach ($question['propositions'] as $slug => $proposition)
                                <div class="propositions p-2">
                                    <input class="ml-16  bg-white/50 p-1 rounded-3xl text-[#c44241] placeholder:text-[#c44241]" type="checkbox" name="corrections[{{$index}}][]" id="" value="{{$proposition}}">
                                    <span class="ml-4 text-white">{{$slug+1}}.</span>
                                    <input readonly class="ml-2 w-[80%] bg-white/50 p-1 rounded-3xl text-[#c44241] placeholder:text-[#c44241]" type="text" value="{{$proposition}}" name="propositions[0][]" placeholder="Entrez une proposition"><br><br>
                                </div>
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
                            <input checked readonly type="checkbox" name="joueurAnonyme"  value="1" id="">
                        @else
                        <input type="checkbox" name="joueurAnonyme"  value="1" id="">
                            
                        @endif
                        <label for="">Cette partie est accessible aux joueurs anonymes</label>
                    </div>
                </div>
                <div class="text-black mt-5 bg-white flex justify-center items-center space-x-auto rounded-3xl shadow-lg p-5 w-full">
                    <fieldset class="m-auto border-[#c44241] border-2 p-3 border-dashed rounded-lg">
                        <legend class="text-[#c44241] font-bold">Miniature</legend>
                        <input type="file" name="miniature" id="">
                    </fieldset>
                    <fieldset class="m-auto border-[#c44241] border-2 p-3 border-dashed rounded-lg">
                        <legend class="text-[#c44241] font-bold">Image de fond</legend>
                        <input type="file" name="imageFond" id="">
                    </fieldset>
                    <fieldset class="m-auto border-[#c44241] border-2 p-3 border-dashed rounded-lg">
                        <legend class="text-[#c44241] font-bold">Couleur de fond</legend>
                        <input type="color" name="couleurFond" id="">
                    </fieldset>
                </div>
                <div class="flex justify-center items-center p-5">
                    <div class="flex justify-center items-center p-5">
                        <input class="h-12 bg-[#c44241] shadow-lg rounded-lg p-3 font-bold text-white cursor-pointer" type="submit" value="Créer la partie">
                    </div>
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
