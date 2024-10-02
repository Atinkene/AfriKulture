@extends('joueur.layout')
@section('content')
<div id="jeux" class="h-full relative" id="">
    
    <div class="flex flex-col justify-center items-center ">
        <div class="h-w">
                <div class="grid grid-cols-2 w-full text-white bg-[#c44241] rounded-3xl" >
                    <div class="  grid grid-cols-3 col-span- h-full bg-[#c44241] " >
                           <div class=" flex justify-center items-start p-3 bg-[#c44241]" >
                               <div class=""><img src="/storage/{{$partie->miniature}}" alt=""></div>
                           </div>
                           <div class="grid grid-cols-1 col-span-2 gap-y-5 p-5">
                               <div class="font-bold text-4xl">{{$partie->nom}}</div>
                               <div class="itatic text-white/50">{{$partie->description}}</div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r  space-x-14 from-[#c44241] via-[#c44241] to-[#cf6d60] flex justify-center items-center rounded-3xl">
                            <a href="{{route('effectuer',[$partie->id])}}" class="bg-white hover:bg-black/25 hover:text-white text-[#722714] font-semibold p-5 flex justify-center items-center ring-4 h-20 rounded-full ring-white outline-none ring-opacity-50">Jouer</a>
                            <div class="">Disponible depuis : <span class="font-bold text-lg">{{$date}}</span></div>
                   </div>
                </div>
            </div>
           
    </div>
</div>
@endsection