@extends('joueur.layout')
@section('content')
    
    <div class="space-x-3 flex justify-start items-start relative">
        <div class="space-y-3 ">
            <div class="grid grid-cols-2">
                <div class="text-white h-full relative grid grid-cols-3">
                    <div class="col-span-2 relative rounded-3xl flex justify-start items-center h-52 bg-gradient-to-l  from-[#c44241] via-[#c44241] to-[#cf6d60] shadow-inner">
                        <div class="grid grid-cols-1 w-3/4 p-3  bg-">
                            <span class="text-2xl font-bold text-center">Expert</span>
                            <span class="text-xs">Représenté par la figure du vieillard sage, ce niveau incarne la maîtrise, l'expérience et la sagesse. Les experts sont des mentors et des leaders, capables d'analyser les situations complexes et de transmettre leur savoir avec clarté et perspicacité.</span>
                        </div>
                    </div>
                    <div class="absolute right-[-35px] flex justify-center items-center h-52"><img class="h-full rounded-3xl" src="{{asset('img/badge.png')}}" alt=""></div>
                </div>
                <div class="h-full grid grid-cols-1 gap-5">
                    <div class="p-2 bg-gradient-to-l  from-[#c44241] via-[#c44241] to-[#cf6d60] rounded-3xl text-md font-semibold text-white flex justify-center items-end italic -space-x-2"><span class="text-xl text-[#7d63d7] font-bold">#</span><span class="text-5xl ">{{$joueur->classement}}</span></div>
                    <div class="p-2 bg-black bg-opacity-35 rounded-3xl text-md font-semibold text-white flex justify-center items-center space-x-2"><span>Vous avez débloqué le niveau </span><span class="text-2xl text-[#cf6d60]">Expert</span></div>
                    <div class="p-2 bg-black bg-opacity-35 rounded-3xl backdrop-blur  z-10 text-md font-semibold text-white flex justify-center items-center space-x-2"><span>Vous avez jouer à </span><span class="text-3xl text-[#c44241]">{{$totaljouer}}</span><span>partie au total!</span></div>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-3">
                <div class="col-span-2 grid grid-cols-1 grid-rows-2 gap-8">
                    <div class="py-3 ">
                        <div class="flex justify-start items-center w-full">
                            <span class="m-auto w-full  text-white/100 font-semibold text-2xl">À venir</span>
                            <span class="m-auto w-full text-end text-[#c44241]/45 font-semibold text-sm">voir plus</span>
                        </div>
                        <div class="flex justify-center items-center h-full  space-x-8 ">
                            @foreach ($plans as  $key=> $plan)
                                @if ($key==0)
                                    <div class="m-auto h-full w-1/3 rounded-3xl border-dashed border-2 border-white">
                                        <div class="bg-black bg-opacity-35 bg-cover h-full rounded-3xl -rotate-6 text-white" style="background-image: url('/storage/{{$plan->miniature}}')"><div class="bg-[#c44241]/50 font-semibold rounded-t-3xl px-2">{{$plan->nom}}</div></div>
                                    </div>
                                @elseif ($key==1) 
                                    <div class="m-auto bg-cover bg-black/45 h-full w-1/3 rounded-3xl text-white text-center font-semibold" style="background-image: url('/storage/{{$plan->miniature}}')"><div class="bg-[#c44241]/50 font-semibold rounded-t-3xl px-2">{{$plan->nom}}</div></div>   
                                @elseif($key=2)
                                    <div class="m-auto bg-cover bg-black/45 h-full w-1/3 rounded-3xl text-white" style="background-image: url('/storage/{{$plan->miniature}}')"><div class="bg-[#c44241]/50 font-semibold rounded-t-3xl px-2">{{$plan->nom}}</div></div>
                                
                                @endif 
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="py-3">
                        <div class="">
                            <div class="flex justify-start items-center w-full">
                                <span class="m-auto w-full  text-white/100 font-semibold text-2xl">Ma dernière partie</span>
                                <span class="m-auto w-full text-end text-[#c44241]/45 font-semibold text-sm">voir plus</span>
                            </div>
                            <div class="flex justify-start items-center h-full ">
                                <div class=" bg-gradient-to-r from-[#c44241]/5 via-black/25 to-black/35 h-full w-[98%] grid grid-cols-2 rounded-3xl">
                                    <div class="space-x-5 bg-[#c44241] rounded-3xl shadow-inner flex justify-center items-center">
                                        <div class="bg-white rounded-3xl"><img class="h-20" src="" alt=""></div>
                                        <div class="text-white ">
                                            <div class="font-bold">{{$dernierePartie->nom}}</div>
                                            <div class="p-2 text-center">
                                                    <span class="bg-black/45 p-2 rounded-full text-sm">{{$niveau}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-center items-center">
                                        <div class="">
                                            <div class="text-[#c44241]/35 font-semibold text-xl ">Score</div>
                                            <div class="text-white font-semibold text-lg  text-center">{{$score}}</div>
                                        </div>
                                        <div class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-3">
                    <div class="flex justify-start items-center w-full">
                        <span class="m-auto w-3/4  text-white/100 font-semibold text-2xl">Mes statistiques</span>
                        <span class="m-auto w-1/4 flex justify-end items-center text-white font-semibold text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                              </svg>
                              
                        </span>
                    </div>
                    <div class="bg-black bg-opacity-35 w-full h-full rounded-3xl grid grid-cols-1 ">
                        <div class="py-8 w-full flex justify-center items-center">
                            <div class=" p-16 relative ">
                                <div class="z-50 bg-[#40191d;]  top-0 w-full h-full rotate-0 left-0 rounded-full w- absolute  flex justify-center items-center ">
                                    <div class="border-dashed border-[#c44241]/45 border-2 p-3 rounded-full grid grid-cols-1">
                                        <div class="text-[#c44241]/45 font-semibold text-md text-center">Score total</div>
                                        <div class="text-white font-semibold text-2xl text-center">{{$scoreTotal}}</div>
                                    </div>
                                </div>
                                <div class="animate-spin backdrop-blur z-40 bg-gradient-to-tr from-[#c44241] via-[#fffdc3] to-[#7d63d7] top-0 w-full h-full rotate-45 left-0 rounded-3xl w- absolute "></div>
                                <div class="animate-spin backdrop-blur z-30 bg-gradient-to-tr from-[#c44241]/80 via-[#fffdc3]/80 to-[#7d63d7]/80 top-0 w-full h-full rotate-12 left-0 rounded-3xl w- absolute "></div>
                                <div class="animate-spin backdrop-blur z-20 bg-gradient-to-tr from-[#c44241]/40 via-[#fffdc3]/40 to-[#7d63d7]/40 top-0 w-full h-full -rotate-12 left-0 rounded-3xl w- absolute   "></div>
                                <div class="animate-spin backdrop-blur z-10 bg-gradient-to-tr from-[#c44241]/25 via-[#fffdc3]/25 to-[#7d63d7]/25 top-0 w-full h-full -rotate-45 left-0 rounded-3xl w- absolute  "></div>
                            </div>
                        </div>
                        <div class="flex justify-center items-center">
                                <div class="m-auto">
                                    <div class="bg-[#c44241] rounded-full flex justify-center items-center"><img class="h-14" src="{{asset('img/7.png')}}" alt=""></div>
                                    <div class="text-center font-semibold text-lg text-white/80 ">5 325</div>
                                </div>
                                <div class="m-auto">
                                    <div class="bg-[#fffdc3] rounded-full flex justify-center items-center"><img class="h-14" src="{{asset('img/7.png')}}" alt=""></div>
                                    <div class="text-center font-semibold text-lg text-white/80 ">4 006</div>
                                </div>
                                <div class="m-auto">
                                    <div class="bg-[#7d63d7] rounded-full flex justify-center items-center"><img class="h-14" src="{{asset('img/7.png')}}" alt=""></div>
                                    <div class="text-center font-semibold text-lg text-white/80 ">4 000</div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-start items-start  w-1/5 h-screen ">
            <div class="bg-black bg-opacity-35 h- py-4 shadow-inner rounded-full w-full text-white">
                <a class="" href="">
                    <div  class=" h-10 flex justify-center items-center text-center">
                       <svg class="h-8 w-6 fill-current text-white hover:text-[#c44241]" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 48 48" viewBox="0 0 48 48" width="256" height="256"><circle cx="24" cy="15.8" r="7.9" fill="" class="color010101 svgShape"></circle><path fill="" d="M30 27.9H18c-2.9 0-5.3 2.4-5.3 5.3v12.5c3.5 1.1 7.3 1.6 11.3 1.6 4 0 7.8-.6 11.3-1.6V33.2C35.3 30.3 32.9 27.9 30 27.9zM36.2.6c-3.6 0-6.7 2.5-7.6 5.8 3.5 1.7 5.9 5.3 5.9 9.4 0 .1 0 .3 0 .4.6.1 1.1.2 1.8.2 4.4 0 7.9-3.5 7.9-7.9S40.5.6 36.2.6z" class="color010101 svgShape"></path><path fill="" d="M42.2 20.6h-8.9c-1.1 2.1-2.9 3.8-5.1 4.8H30c4.3 0 7.9 3.5 7.9 7.9v6.9c3.4-.1 6.6-.7 9.6-1.6V25.9C47.5 23 45.1 20.6 42.2 20.6zM13.6 16.2c0-.1 0-.3 0-.4 0-4.1 2.4-7.7 5.9-9.4-.9-3.4-4-5.8-7.6-5.8-4.4 0-7.9 3.5-7.9 7.9s3.5 7.9 7.9 7.9C12.4 16.4 13 16.3 13.6 16.2zM10.1 33.2c0-4.3 3.5-7.9 7.9-7.9h1.9c-2.2-1-4-2.7-5.1-4.8H5.8c-2.9 0-5.3 2.4-5.3 5.3v12.5c3 .9 6.3 1.5 9.6 1.6V33.2z" class="color010101 svgShape"></path></svg>
                    </div>
                </a>
                <div class="grid grid-cols-1 gap-1 p-1 pt-5">
                    <a class="" href="">
                        <div  class=" px-1 py-4 flex justify-center items-center text-center bg-cover  bg-black/25 rounded-full  text-lg" style="background-image: url({{asset('img/badge.png')}})">
                           D
                        </div>
                    </a>
                    <a class="" href="">
                        <div  class=" px-1 py-4 flex justify-center items-center text-center  bg-black/25 rounded-full  text-lg">
                            P
                        </div>
                    </a>
                    <a class="" href="">
                        <div  class=" px-1 py-4 flex justify-center items-center text-center  bg-black/25 rounded-full  text-lg">
                            P
                        </div>
                    </a>
                    <a class="" href="">
                        <div  class=" px-1 py-4 flex justify-center items-center text-center  bg-black/25 rounded-full  text-lg">
                            J
                        </div>
                    </a>
                    <a class="" href="">
                        <div  class=" px-1 pt-5  flex justify-center items-end text-center  rounded-full  text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 5.25 7.5 7.5 7.5-7.5m-15 6 7.5 7.5 7.5-7.5" />
                              </svg>
                              
                        </div>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
   
@endsection