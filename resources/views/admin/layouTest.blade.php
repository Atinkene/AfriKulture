<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>AfriKulture | Administration</title>
</head>
<body class="h-screen shadow-y-inner">
    @if (Auth()->user()->status == 'admin')
        <div class="flex  justify-end items-start w-full relative h-screen">
             <div class="  w-[10%] h-screen fixed left-0">
                 <div class=" text-blue-800 ">
                    <a class="" href="{{route('AdminDashboard')}}">
                        <div  class=" flex justify-center items-center">
                           <img class="h-14" src="{{asset('img/logoMini.png')}}" alt=""> 
                        </div>
                    </a>
                     <a class="" href="{{route('AdminDashboard')}}">
                         <div  class=" h-10 flex justify-center items-center text-center  hover:bg-gray-100 hover:text-white hover:rounded-l-full  text-lg">
                             Dashboard
                         </div>
                     </a>
                     <a class="" href="{{route('AdminParties')}}">
                         <div  class=" h-10 flex justify-center items-center text-center  hover:bg-gray-100 hover:text-white hover:rounded-l-full  text-lg">
                             Parties
                         </div>
                     </a>
                     <a class="" href="{{route('EnseignantPlanning')}}">
                         <div  class=" h-10 flex justify-center items-center text-center  hover:bg-gray-100 hover:text-white hover:rounded-l-full  text-lg">
                             Planning
                         </div>
                     </a>
                     <a class="" href="">
                         <div  class=" h-10 flex justify-center items-center text-center  hover:bg-gray-100 hover:text-white hover:rounded-l-full  text-lg">
                             Joueurs
                         </div>
                     </a>
                     
                 </div>
             </div>
             <div class="flex justify-end items-center w-[90%]  h-full py-1 ">
                <div class="h-full w-full  flex justify-start items-start">
                    <div class=" h-full w-full rounded-l-2xl shadow">
                        <div class=" p-3 w-full">
                            @yield('content')
                        </div>
                    </div>
                </div> 
             </div>
        </div>
    @else
        
    @endif
    
</body>
</html>