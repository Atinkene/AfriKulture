<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    <title>E-Laab | Connexion</title>
</head>
<body class="bg-fi" >
    {{-- style="background-image: url({{asset('img/12.png')}})" --}}
    @auth
        {{-- {{Auth::user()}} --}}
    @endauth
    <div class="h-screen flex justify-center items-center ">
       <div class="w-full h-full flex justify-center items-center" >
        <div class="backdrop-filter backdrop-blur-lg ring-8 ring-opacity-20 ring-[#e27b06] flex justify-center items-center rounded-t-full h-5/6 w-2/3 shadow-lg shadow-black pt-2  " style="background-image: url({{asset('img/4.png')}})" >
            <div class="w-full flex justify-center items-center backdrop-blur-sm h-full rounded-t-full ">
                <div class="w-2/3 ">
                    <form class="text-center space-y-0 w-full" action="" method="post">
                        @csrf
                        <div class="space-y-10">
                            <h2 class="font-bold text-5xl text-white font">Connexion</h2>
                            <input  class="text-center bg-opacity-25 text-[#e27b06] font-semibold text-lg h-12 w-full  rounded-full shadow-lg italic shadow-black-900/50 placeholder:text-[#e27b06] placeholder:font-normal  ring-4 ring-opacity-20 ring-[#bc2510] focus:outline-none focus:ring-opacity-50  focus:border-transparent" type="text" name="login" id="" placeholder="Entrer votre nom d'utilisateur"><br>
                            @error('numero')
                                <div class="text-red-500">
                                    {{$message}}
                                </div>
                            @enderror
                            <input  class="text-center text-[#e27b06] font-semibold text-lg h-12 w-full rounded-full shadow-lg italic shadow-black-900/50 placeholder:text-[#e27b06] placeholder:font-normal  ring-4 ring-opacity-20 ring-[#bc2510] focus:outline-none focus:ring-opacity-50  focus:border-transparent" type="password" name="password" id="" placeholder="Entrez votre mot de passe"><br>
                            <input class="text-center text-white text-lg h-10 w-1/2 bg-[#722714] rounded-lg shadow-lg font-semibold shadow-black-900/50 cursor-pointer  hover:bg-[#e27b06]" type="submit" name="" id="" value="Se connecter"><br><br>
                            
                        </div>
                        <a class="text-white font-semibold hover:underline" href="">Mot de passe oublié?</a>
                    </form>
                </div>
            </div>
        </div>
       </div>
    </div>
</body>
</html>