<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{$title}}</title>
</head>
<body class=" h-screen w-full ">
    @include('afrikulture.composants.header')
    <div class="absolute inset-x-0 top-[-10rem]   -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
        <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
      </div>
      <div class="  w-full h-full rounded-3xl">
        <div class="mt-24  m-auto p-36 col-span-2 w-full flex justify-center items-center">
            <div class=" p-  ">
                <div class="bg-gradient-to-r  from-[#c44241] via-[#c44241] to-[#cf6d60] top-0 w-full h-full rounded-full p-1  flex justify-center items-center ">
                    <div class="border-dashed border-[#40191d] border-2 px-14 py-8  rounded-full grid grid-cols-1">
                        <div class="text-[#40191d;] font-semibold text-2xl text-center italic">#2</div>
                        <div class="text-white font-semibold text-2xl text-center italic">{{$users[1]->login}}</div>
                    </div>
                </div>
            </div>
            <div class=" p-36 relative ">
                <div class="z-40 bg-[#40191d;]  top-0 w-full h-full rotate-0 left-0 rounded-full w- absolute  flex justify-center items-center ">
                    <div class="border-dashed border-[#c44241]/45 border-2 p-16 rounded-full grid grid-cols-1">
                        <div class="text-[#c44241]/45 font-semibold text-4xl text-center italic">#1</div>
                        <div class="text-white font-semibold text-2xl text-center italic">{{$users[0]->login}}</div>
                    </div>
                </div>
                <div class="animate-spin backdrop-blur z-30 bg-gradient-to-tr from-[#c44241] via-[#fffdc3] to-[#7d63d7] top-0 w-full h-full rotate-45 left-0 rounded-3xl w- absolute "></div>
                <div class="animate-spin backdrop-blur z-20 bg-gradient-to-tr from-[#c44241]/80 via-[#fffdc3]/80 to-[#7d63d7]/80 top-0 w-full h-full rotate-12 left-0 rounded-3xl w- absolute "></div>
                <div class="animate-spin backdrop-blur z-10 bg-gradient-to-tr from-[#c44241]/40 via-[#fffdc3]/40 to-[#7d63d7]/40 top-0 w-full h-full -rotate-12 left-0 rounded-3xl w- absolute   "></div>
                <div class="animate-spin backdrop-blur z-0 bg-gradient-to-tr from-[#c44241]/25 via-[#fffdc3]/25 to-[#7d63d7]/25 top-0 w-full h-full -rotate-45 left-0 rounded-3xl w- absolute  "></div>
            </div>
            <div class=" p- ">
                <div class="bg-gradient-to-l  from-[#c44241] via-[#c44241] to-[#cf6d60] top-0 w-full h-full rounded-full p-1  flex justify-center items-center ">
                    <div class="border-dashed border-[#40191d;] border-2 px-14 py-8  rounded-full grid grid-cols-1">
                        <div class="text-[#40191d;] font-semibold text-2xl text-center italic">#3</div>
                        <div class="text-white font-semibold text-2xl text-center italic">{{$users[2]->login}}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class=" flex justify-center items-center pb-5">
            <table class="w-11/12  text-center rounded-3x p-8 text-white">
                <thead class="rounded-t-3xl bg- p-1 text-xl ">
                    <tr class="border-2 border-dashed border-[#c44241]/45 rounded-3xl h-14 space-x-2 bg-[#c44241]">
                        <th>Rang</th>
                        <th  class="col-span-3  w-2/3">Joueur</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $slug => $user)
                    <tr class="border-2 border-dashed border-[#c44241]/45 h-10 bg-[#40191d]">
                        <td class="italic text-lg ">{{ $slug+1 }}</td> <!-- Affiche le numéro du rang -->
                        <td class="text-lg  font-semibold rounded- border-dashed border-2  bg-[#c44241]">{{ $user['login'] }}</td> <!-- Affiche l'ID du joueur -->
                        <td>{{ $score[$slug] }}</td> <!-- Affiche le score -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
      </div> 
      <div class=""></div>
</body>
</html>