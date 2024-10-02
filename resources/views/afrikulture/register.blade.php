<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{$title}}</title>
</head>

<body class="bg-fi">
    {{-- style="background-image: url({{asset('img/12.png')}})" --}}

    @session('success')
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
            <div>
                <p class="font-bold">Our privacy policy has changed</p>
                <p class="text-sm">Make sure you know how these changes affect you.</p>
            </div>
        </div>
    </div>
    {{ success }}
    @endsession

    <div class="h-screen flex justify-center items-center ">
        <div class="w-full h-full flex justify-center items-center">
            <div class="backdrop-filter backdrop-blur-lg ring-8 ring-opacity-20 ring-[#e27b06] flex justify-center items-center rounded-full h-5/6 w-5/6 shadow-lg shadow-black pt-2  " style="background-image: url({{asset('img/4.png')}})">
                <div class="w-full flex justify-center items-center backdrop-blur-sm h-full  rounded-full">
                    <div class="w-2/3 ">
                        <form class="text-center space-y-0 w-full " action="" method="post">
                            @csrf
                            <h2 class="font-bold text-5xl text-white font">S'inscrire</h2>
                            <div class="space-y-10 py-5 grid grid-cols-2 gap-2">
                                <div class=" col-span-2 w-2/3 m-auto">
                                    <input class="text-center bg-opacity-25 text-[#e27b06] font-semibold text-lg h-12 w-full  rounded-full shadow-lg italic shadow-black-900/50 placeholder:text-[#e27b06] placeholder:font-normal  ring-4 ring-opacity-20 ring-[#bc2510] focus:outline-none focus:ring-opacity-50  focus:border-transparent" type="text" name="prenom" id="" placeholder="Entrer votre prenom"><br>
                                    @error('prenom')
                                    <div class="text-red-500">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                               <div class="">
                                    <input class="text-center bg-opacity-25 text-[#e27b06] font-semibold text-lg h-12 w-full  rounded-full shadow-lg italic shadow-black-900/50 placeholder:text-[#e27b06] placeholder:font-normal  ring-4 ring-opacity-20 ring-[#bc2510] focus:outline-none focus:ring-opacity-50  focus:border-transparent" type="text" name="nom" id="" placeholder="Entrer votre nom"><br>
                                    @error('nom')
                                    <div class="text-red-500">
                                        {{$message}}
                                    </div>
                                    @enderror
                               </div>
                                <div class="">
                                    <input class="text-center bg-opacity-25 text-[#e27b06] font-semibold text-lg h-12 w-full  rounded-full shadow-lg italic shadow-black-900/50 placeholder:text-[#e27b06] placeholder:font-normal  ring-4 ring-opacity-20 ring-[#bc2510] focus:outline-none focus:ring-opacity-50  focus:border-transparent" type="text" name="email" id="" placeholder="Entrer votre email"><br>
                                    @error('email')
                                    <div class="text-red-500">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="">
                                    <input class="text-center bg-opacity-25 text-[#e27b06] font-semibold text-lg h-12 w-full  rounded-full shadow-lg italic shadow-black-900/50 placeholder:text-[#e27b06] placeholder:font-normal  ring-4 ring-opacity-20 ring-[#bc2510] focus:outline-none focus:ring-opacity-50  focus:border-transparent" type="text" name="login" id="" placeholder="Entrer votre nom d'utilisateur"><br>
                                    @error('login')
                                    <div class="text-red-500">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="">
                                    <input class="text-center text-[#e27b06] font-semibold text-lg h-12 w-full rounded-full shadow-lg italic shadow-black-900/50 placeholder:text-[#e27b06] placeholder:font-normal  ring-4 ring-opacity-20 ring-[#bc2510] focus:outline-none focus:ring-opacity-50  focus:border-transparent" type="password" name="password" id="" placeholder="Entrez votre mot de passe"><br>
                                    @error('password')
                                    <div class="text-red-500">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="p-3">
                                <input class="text-center text-white text-lg h-10 w-1/2 bg-[#722714] rounded-lg shadow-lg font-semibold shadow-black-900/50 cursor-pointer  hover:bg-[#e27b06]" type="submit" name="" id="" value="S'inscrire"><br><br>

                            </div>
                            <a class="text-white font-semibold hover:underline" href="">Mot de passe oublié?</a> <br>
                            <a class="text-white font-semibold hover:underline" href="{{ route('login') }}">Se connecter </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>