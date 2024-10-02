@extends('joueur.layout')
@section('content')
    <div class="w- m-auto max-h-screen overflow-visible">
       <div class="w-full ">
            <span class="font-bold text-blue-900 text-lg flex justify-center items-center">
                Mes parties
            </span>
            <div class="flex justify-end items-center w-full p-5">
                    <a href="{{route('partieAvenir')}}" class="font-bold text-md p-2 rounded-full bg-blue-800 text-white">Nouvelle évaluation</a>
            </div>
            <table class="mt-5 shadow-md shadow-blue-900/400 rounded-bl-2xl rounded-th-2xl space-y-10 w-full pb-5 p-5">
                <thead class="bg-blue-800 h-10 text-white shadow-md shadow-blue-900/400">
                    <th>Nom</th>
                    <th>Score</th>
                </thead>
                <tbody class="text-center ">
                    @foreach ($parties as $key => $partie)
                        <tr class=" h-12 rounded-lg">
                            <td class="font-bold"><a href="/">{{$partie->nom}}</a></td>
                            <td class="">{{$note[$key]}}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
       </div>
       
    </div>
@endsection