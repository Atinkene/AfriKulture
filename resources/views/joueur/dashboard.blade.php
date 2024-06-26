@extends('joueur.layout')
@section('content')
    <div class="w-[95%] m-auto max-h-screen overflow-visible mt-10">
       <div class="space-y-5  w-full bg-white mt-10">
            <span class="font-bold text-blue-900 text-lg flex justify-center items-center">
                Bonjour {{Auth()->user()->prenom.' '.Auth()->user()->nom}}!
            </span>
            <div class="shadow-md shadow-blue-900/400 rounded-bl-2xl rounded-tr-2xl w-full pb-5 pr-5">
                <span class="w-full ml-5 font-bold text-blue-900 text-lg">
                    Évaluations
                </span>
                <div class="flex justify-center items-center mt-3 ">
                    <div class="shadow shadow-gray-600 rounded-bl-full rounded-tr-full  w-1/4  grid grid-cols-1 gap-y-0 items-center text-center text-blue-900 m-auto">
                        <span class="font-bold text-2xl">2</span>
                        <span class="text-lg">en attente</span>
                    </div>
                    <div class="shadow shadow-gray-600 rounded-bl-full rounded-tr-full  w-1/4  grid grid-cols-1 gap-y-0 items-center text-center text-blue-900 m-auto">
                        <span class="font-bold text-2xl">2</span>
                        <span class="text-lg">non effectuée(s)</span>
                    </div>
                </div>
                
            </div>
            <div class="shadow-md shadow-blue-900/400 rounded-bl-2xl rounded-tr-2xl space-y-10 space-x-10 w-full pb-5 pr-5">
                <span class="w-full ml-5 font-bold text-blue-900 text-lg">
                    Planning
                </span>
                <div class="flex justify-center items-center">
                    <div class="shadow shadow-gray-600 rounded-bl-full rounded-tr-full  w-1/4  grid grid-cols-1 gap-y-0 items-center text-center text-blue-900 m-auto">
                        <span class="font-bold text-2xl">2</span>
                        <span class="text-lg">en attente</span>
                    </div>
                    <div class="shadow shadow-gray-600 rounded-bl-full rounded-tr-full  w-1/4  grid grid-cols-1 gap-y-0 items-center text-center text-blue-900 m-auto">
                        <span class="font-bold text-2xl">2</span>
                        <span class="text-lg">non effectuée(s)</span>
                    </div>
                    <div class="shadow shadow-gray-600 rounded-bl-full rounded-tr-full  w-1/4  grid grid-cols-1 gap-y-0 items-center text-center text-blue-900 m-auto">
                        <span class="font-bold text-2xl">2</span>
                        <span class="text-lg">non effectuée(s)</span>
                    </div>
                    <div class="shadow shadow-gray-600 rounded-bl-full rounded-tr-full  w-1/4  grid grid-cols-1 gap-y-0 items-center text-center text-blue-900 m-auto">
                        <span class="font-bold text-2xl">2</span>
                        <span class="text-lg">non effectuée(s)</span>
                    </div>
                </div>
                <div class="flex justify-center items-center mt-3 ">
                    <div class="shadow shadow-gray-600 rounded-bl-full rounded-tr-full  w-1/4  grid grid-cols-1 gap-y-0 items-center text-center text-blue-900 m-auto">
                        <span class="font-bold text-2xl">2</span>
                        <span class="text-lg">en attente</span>
                    </div>
                    <div class="shadow shadow-gray-600 rounded-bl-full rounded-tr-full  w-1/4  grid grid-cols-1 gap-y-0 items-center text-center text-blue-900 m-auto">
                        <span class="font-bold text-2xl">2</span>
                        <span class="text-lg">non effectuée(s)</span>
                    </div>
                    <div class="shadow shadow-gray-600 rounded-bl-full rounded-tr-full  w-1/4  grid grid-cols-1 gap-y-0 items-center text-center text-blue-900 m-auto">
                        <span class="font-bold text-2xl">2</span>
                        <span class="text-lg">non effectuée(s)</span>
                    </div>
                    <div class="shadow shadow-gray-600 rounded-bl-full rounded-tr-full  w-1/4  grid grid-cols-1 gap-y-0 items-center text-center text-blue-900 m-auto">
                        <span class="font-bold text-2xl">2</span>
                        <span class="text-lg">non effectuée(s)</span>
                    </div>
                </div>
                <div class="flex justify-center items-center mt-3 ">
                    <div class="shadow shadow-gray-600 rounded-bl-full rounded-tr-full  w-1/4  grid grid-cols-1 gap-y-0 items-center text-center text-blue-900 m-auto">
                        <span class="font-bold text-2xl">2</span>
                        <span class="text-lg">en attente</span>
                    </div>
                    <div class="shadow shadow-gray-600 rounded-bl-full rounded-tr-full  w-1/4  grid grid-cols-1 gap-y-0 items-center text-center text-blue-900 m-auto">
                        <span class="font-bold text-2xl">2</span>
                        <span class="text-lg">non effectuée(s)</span>
                    </div>
                    <div class="shadow shadow-gray-600 rounded-bl-full rounded-tr-full  w-1/4  grid grid-cols-1 gap-y-0 items-center text-center text-blue-900 m-auto">
                        <span class="font-bold text-2xl">2</span>
                        <span class="text-lg">non effectuée(s)</span>
                    </div>
                    <div class="shadow shadow-gray-600 rounded-bl-full rounded-tr-full  w-1/4  grid grid-cols-1 gap-y-0 items-center text-center text-blue-900 m-auto">
                        <span class="font-bold text-2xl">2</span>
                        <span class="text-lg">non effectuée(s)</span>
                    </div>
                </div>
                
                
            </div>
       </div>
    </div>
@endsection