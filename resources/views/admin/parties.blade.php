@extends('admin.layout')
@section('content')
    
    <div id="add" class="z-10 fixed text-white right-24  bottom-4 px-6 py-3 duration-700  cursor-pointer hover:px-8 hover:py-4 rounded-full bg-[#c44241] shadow-lg shadow-[#c44241]/25 hover:shadow-[#c44241] hover:shadow-inner hover:bg-black/25 group hover:text-[#c44241]">
        <div class="w-full h-hull relative p-1">
            <a id="textePartie" class="z-10 hidden focus group-focus:block absolute right-10 -top-16 px-6 py-3 duration-700 rounded-full bg-[#c44241] shadow-lg shadow-[#c44241]/25 hover:shadow-[#c44241] hover:shadow-inner hover:bg-black/25 group hover:text-[#c44241]" href="{{route('AdminCreePartie')}}">
                <span class="text-white font-bold text-2xl  duration-700 group-hover:animate-spin">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd" />
                        <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                      </svg>
                      
                </span>
            </a>
            <a id="imagePartie" class="z-10 hidden group-focus:block clicked: absolute left-10 -top-16 px-6 py-3 duration-700 rounded-full bg-[#c44241] shadow-lg shadow-[#c44241]/25 hover:shadow-[#c44241] hover:shadow-inner hover:bg-black/25 group hover:text-[#c44241]" href="{{route('AdminCreePartieImage')}}">
                <span class="text-white font-bold text-2xl duration-700 group-hover:animate-spin">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
</svg>

                </span>
            </a>
            <span class="text-white font-bold text-2xl group-hover:text-[#c44241] duration-700 group-hover:animate-spin">+</span>

        </div>
    </div>
    <div class="m-auto max-h-screen overflow-visible space-y-1">
        @if(Session::has('message'))
        <div class="text-red-500">
            {{ Session::get('message') }}clear

        </div>
    @endif
        @foreach ($parties as $key => $partie)
        <div class="grid grid-cols-3">
            @if ($key==0)
                <div class="py-3 col-span-3 grid grid-cols-3  justify-center items-center  rounded-2xl shadow-inner bg-gradient-to-l  from-[#c44241] via-[#c44241] to-[#cf6d60]" >
                    <div class="grid grid-cols-1 col-span-2 grid-row-2 gap-5 h-full">
                        <div class="text-white font-bold  text-4xl  flex justify-center items-center px-5">{{$partie->nom}}</div>
                        <div class=" flex justify-start items-start w-2/3 m-auto text-white/50 overflow-ellipsis overflow-hidden">{{$partie->description}} </div>
                        <div class="text-white font-bold  text-xl  flex justify-center items-center px-5">{{$planningJour[$key]}}</div>
                    </div>
                    <div class="grid grid-cols-1 justify-center items-end">
                        <div class="m-auto w-1/2 h-full flex justify-center items-end"><img class="rounded-xl  h-full w-full" src="/storage/{{$partie->miniature}}" alt=""></div>   
                        <a class="bg-[#e59b2e] rounded-full w-1/3 p-1 text-red-900  font-bold animate- relative shadow-lg" href="{{route('factoParties',[$partie->id])}}">
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

        <div class="grid grid-cols-4 gap-x-3">
            @foreach ($parties as $key => $partie)
                @if ($key>=1)
                     <a href="{{route('factoParties',$partie->id)}}">
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
        document.addEventListener('DOMContentLoaded', function() {
            const add = document.getElementById('add');
            const textePartie = document.getElementById('textePartie');
            const imagePartie = document.getElementById('imagePartie');

            var clicked = false;
            add.addEventListener('click', ()=>{
                if (clicked) {
                    textePartie.classList.add('hidden');
                    imagePartie.classList.add('hidden');
                    clicked=!clicked;
                } else {
                    
                    textePartie.classList.remove('hidden');
                    imagePartie.classList.remove('hidden');
                    clicked=!clicked;
                }
            })
        })
    </script>
@endsection
