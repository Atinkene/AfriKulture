<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    <title>E-Laab | Connexion</title>
</head>
<body>
    @include('afrikulture.composants.header')
    @auth
        {{-- {{Auth::user()}} --}}
    @endauth
    <div class="h-screen flex justify-center items-center bg-white">
        <div class="bg-white flex justify-center items-center rounded-lg rounded-br-lg h-5/6 w-2/3 shadow-sm shadow-blue-900/100 mt-16">
            <div class="w-2/3">
                <form class="text-center space-y-14 w-full" action="" method="post">
                    @csrf
                    <h2 class="font-bold text-5xl text-blue-900">Connexion</h2>
                    <input class="text-center text-white text-lg h-12 w-full bg-blue-900 rounded-r-full shadow-md italic shadow-blue-900/50" type="text" name="login" id="" placeholder="Entrer votre numéro d'identification"><br>
                    @error('numero')
                        <div class="text-red-500">
                            {{$message}}
                        </div>
                    @enderror
                    <input class="text-center text-white text-lg h-12 w-full bg-blue-900 rounded-r-full shadow-md italic shadow-blue-900/50" type="password" name="password" id="" placeholder="Entrez votre mot de passe"><br>
                    <input class="text-center text-white text-lg h-10 w-1/2 bg-blue-900 rounded-lg shadow-md font-semibold shadow-blue-900/50 cursor-pointer" type="submit" name="" id="" value="Se connecter"><br><br>
                    
                    <a class="text-blue-900 font-semibold" href="">Mot de passe oublié?</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>