<div class="h- relative" id="">
    {{-- <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
        <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
      </div> --}}
    <div class="flex flex-col justify-center items-center py-10 ">
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
                               <div class="">Catacteristique</div>
                               <div class="">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestias provident in ad voluptates voluptatibus esse quo. Similique alias sequi maxime, illum eaque nesciunt voluptatem vitae, sunt nulla ad mollitia laboriosam.</div>
                               <div class="">Disponible depuis : {{$partie->dateDebut}}</div>
                               <div class="">thématique</div>
                               <div class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis dicta quisquam doloremque minima sint accusantium, in eveniet laborum beatae sunt quis nam. Eum necessitatibus facilis cum, ab architecto reprehenderit iste!</div>
                               <div class="text-center">Plus d'informations  ></div>
                           </div>
                    </div>
                    <div class="flex justify-center items-center" style="background-image: linear-gradient(to right, {{$partie->couleurFond}}, rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25))">
                           <a href="" class=" h-12 bg-white text-[#722714] font-semibold rounded-lg p-5 flex justify-center items-center hover:ring-4 hover:h-20 hover:rounded-full hover:ring-white hover:outline-none hover:ring-opacity-50">Jouer</a>
                   </div>
                </div>
                @endforeach 
            </div>
            <div class="w-full bg-black">
                <div class=" w-1/2 m-auto text-white">{{ $parties->links('pagination::tailwindCust') }}</div>
            </div>
    </div>
</div>