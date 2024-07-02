@extends('admin.layouTest')
@section('content')
    <div class="text-black">
        <div class="flex justify-end items-center font-bold text-lg">{{Auth::user()->prenom.' '.Auth::user()->nom}}</div>
    </div>
   
@endsection