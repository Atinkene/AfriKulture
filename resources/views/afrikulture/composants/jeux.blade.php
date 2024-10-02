<div id="jeux" class="h- relative" id="">
    
    <div class="flex flex-col justify-center items-center pt-28 ">
        <div class="flex flex-col justify-center items-center w-11/12 space-y-5 " >
            <span class="text-5xl text-red-900 font-bold">Nos Jeux</span>
            <p class="" >
                Votre passerelle vers une immersion enrichissante dans la culture générale africaine. 
                Plongez dans un monde fascinant où l'apprentissage devient jeu, et où chaque question vous rapproche un peu plus des trésors cachés du continent.
            </p>
        </div>
        <div class="">
                @foreach ($parties as $key => $partie)
                <div class="grid grid-cols-2 w-full text-white bg-cover" style="background-image: url('/storage/{{$partie->imageFond}}')">
                    <div class="  grid grid-cols-3 col-span- h-full " style="background-color: {{$partie->couleurFond}}">
                           <div class=" flex justify-center items-start p-3" style="background-color: {{$partie->couleurFond}}">
                               <div class=""><img src="/storage/{{$partie->miniature}}" alt=""></div>
                           </div>
                           <div class="grid grid-cols-1 col-span-2 gap-y-5 p-5">
                               <div class="font-bold text-4xl">{{$partie->nom}}</div>
                               <div class="">{{$partie->description}}</div>
                               <div class="">Disponible depuis : {{$partie->dateDebut}}</div>
                               <div class="text-center">Plus d'informations  ></div>
                           </div>
                    </div>
                    <div class="flex justify-center items-center" style="background-image: linear-gradient(to right, {{$partie->couleurFond}}, rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25))">
                           <a href="{{route('effectuer',[$partie->id])}}" class=" h-12 bg-white text-[#722714] font-semibold rounded-lg p-5 flex justify-center items-center hover:ring-4 hover:h-20 hover:rounded-full hover:ring-white hover:outline-none hover:ring-opacity-50">Jouer</a>
                   </div>
                </div>
                @endforeach 
            </div>
            <div class="w-full bg-black">
                <div class=" w-1/2 m-auto text-white">{{ $parties->links('pagination::tailwindCust') }}</div>
            </div>
    </div>
</div>