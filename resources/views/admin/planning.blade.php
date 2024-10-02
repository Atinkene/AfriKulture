@extends('admin.layout')
@section('content')

                
                <div class="  justify-center items-center mt-3 grid grid-cols-3 grid-row-2 gap-y-10 gap-x-4">
                    @foreach ($planElems as $key=>$plan)
                        <a href="{{route('AdminPartie',[$plan->id])}}" class="bg-gradient-to-l  from-[#c44241] via-[#c44241] to-[#cf6d60] group hover:bg-none  hover:border-dashed hover:border-2 hover:border-white/60  rounded-3xl  px-14 w-  grid grid-cols-1 gap-y-0 items-center text-center text-white">
                            <div class="group-hover:rotate-2 w-full transition duration-700 ease-in-out">
                                <span class="font-bold text-lg">{{$planningJour[$key]}}</span>
                            <img class="h-36 rounded-3xl w-full" src="/storage/{{$plan->miniature}}" alt="">
                            <span class="text-lg font-bold">{{$plan['nom']}}</span>
                            </div>
                        </a>
                    @endforeach   
                </div>
                <div class="w-">{{ $plans->links('pagination::tailwind') }}</div>
            
@endsection