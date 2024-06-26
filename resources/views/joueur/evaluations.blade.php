@extends('etudiant.layout')
@section('content')
    <div class="w-[95%] m-auto max-h-screen overflow-visible mt-20">
       <div class="w-full bg-white">
            <span class="font-bold text-blue-900 text-lg flex justify-center items-center">
                Mes évaluations
            </span>
            <div class="flex justify-end items-center w-full p-5">
                    <a href="{{route('evaluationAvenir')}}" class="font-bold text-md p-2 rounded-full bg-blue-900 text-white">Nouvelle évaluation</a>
            </div>
            <table class="mt-5 shadow-md shadow-blue-900/400 rounded-bl-2xl rounded-th-2xl space-y-10 w-full pb-5 p-5">
                <thead class="bg-blue-900 h-10 text-white shadow-md shadow-blue-900/400">
                    <th>Nom</th>
                    <th>Note</th>
                    <th>Appréciation</th>
                </thead>
                <tbody class="text-center ">
                    @foreach ($evaluations as $evaluation)
                        <tr class=" h-12 rounded-lg">
                            <td class="font-bold "><a href="/">{{$evaluation->nom}}</a></td>
                            <td class="">{{$note}}</td>
                            <td class="">{{$appreciation}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
       </div>
       
    </div>
@endsection