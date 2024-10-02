@extends('joueur.layout')
@section('content')
<div id="alert" >
    @if(session('message'))
    <div class="border-2 border-dashed border-[#c44241] bg-white  p-2 flex justify-center items-center  font-semibold fixed  z-10 bottom-56 rounded-xl h-[25%] w-[25%] left-[41%] text-[#c44241] text-xl">
        {{ session('message') }}
     </div>
   @endif
</div>
    <div class="m-auto max-h-screen overflow-visible space-y-1">
       
        @foreach ($parties as $key => $partie)
        <div class="grid grid-cols-3">
            @if ($key==0)
                <div class="py-3 col-span-3 grid grid-cols-3  justify-center items-center  rounded-2xl shadow-inner bg-gradient-to-l  from-[#c44241] via-[#c44241] to-[#cf6d60]" >
                    <div class="grid grid-cols-1 col-span-2 grid-row-2 gap-5 h-full">
                        <div class="text-white font-bold  text-4xl  flex justify-center items-center px-5">{{$partie->nom}}</div>
                        <div class=" flex justify-start items-start w-2/3 m-auto text-white/50 overflow-ellipsis overflow-hidden">{{$partie->description}} </div>
                        <div class="text-white font-bold  text-xl  flex justify-center items-center px-5">{{$planningJour[$key]}}</div>
                    </div>
                    
                    <div class="grid grid-cols-1 justify-center gap-5 items-end">
                        <div class="m-auto w-1/2 h-full flex justify-center items-end"><img class="rounded-xl  h-full w-full" src="/storage/{{$partie->miniature}}" alt=""></div>   
                        <a class="bg-[#e59b2e] rounded-full w-1/3 p-1 text-red-900  font-bold animate- relative shadow-lg" href="{{route('JoueurPartie',[$partie->id])}}">
                            <div class="  flex justify-center  w-full items-center">
                                Découvrir
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#e59b2e] opacity-75"></span>
                            </div>
                        </a>
                    </div>
                </div>
                
            @endif
        </div>
        @endforeach

        <div class="grid grid-cols-4 gap-3 p-5">
            @foreach ($parties as $key => $partie)
                @if ($key>=1)
                     <a href="{{route('JoueurPartie',$partie->id)}}">
                        <div class=" flex justify-center items-start rounded-2xl shadow-inner bg-gradient-to-b from-transparent to-black/25 group hover:bg-none  hover:border-dashed hover:border-2 hover:border-white/60" >
                            <div class="grid grid-cols-1 justify-center items-start w-full group-hover:rotate-2 group-hover:bg-[#c44241] group-hover:rounded-2xl transition duration-700 ease-in-out rounded-2xl">
                                <div class="flex justify-center items-start shadow-inner rounded-2xl"><img class="bg-white rounded-2xl w-full h-56" src="/storage/{{$partie->miniature}}" alt=""></div>   
                                <div class="flex justify-center items-start text-white/60 p-4 font-semibold">{{$partie->nom}}</div>   
                            </div>
                        </div>
                     </a>
                @endif
        @endforeach
        </div>
       
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Sélectionnez l'élément avec la classe "fade-out"
            var element = document.getElementById("alert");
    
            if (element) {
                // Définissez un délai de 3 secondes (3000 millisecondes) pour masquer l'élément
                setTimeout(function() {
                    element.style.display = "none"; // Masquez l'élément
                }, 3000); // 3 secondes
            }
        });
    </script>
@endsection