<header class="fixed z-50 relatif text-weight top-0 font-bold  bg-white text-blue-800 w-full p- shadow shadow-black-500/50 z-10 rounded-br-full  rounded-bl-full ">
    <div class="flex justify-center items-center relative">
        <div class="ml-12 m-auto flex justify-start items-start w-full" ><a href="{{route('accueil')}}"><img class="h-14" src="{{asset('img/logo2.png')}}" alt="logo"></a></div>
        @auth
            <svg id="menuBottom" width="73" height="71" viewBox="0 0 73 71" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-20 cursor-pointer h-12">
                <g filter="">
                <ellipse cx="36.5" cy="31.5" rx="32.5" ry="31.5" fill="white"/>
                </g>
                <rect x="21" y="28" width="31" height="7" rx="3.5" fill="#722714"/>
                <rect x="6" y="39" width="61" height="7" rx="3.5" fill="#722714"/>
                <rect x="0" y="49" width="71" height="7" rx="3.5" fill="#722714"/>
                <ellipse cx="28.5" cy="17.5" rx="7.5" ry="6.5" fill="#722714"/>
                <defs>
                <filter id="filter0_d_49_2" x="0" y="0" width="73" height="71" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                <feOffset dy="4"/>
                <feGaussianBlur stdDeviation="2"/>
                <feComposite in2="hardAlpha" operator="out"/>
                <feColorMatrix type="matrix" values="0 0 0 0 0.0666667 0 0 0 0 0.137255 0 0 0 0 0.352941 0 0 0 1 0"/>
                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_49_2"/>
                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_49_2" result="shape"/>
                </filter>
                </defs>
            </svg>
            <div id="menu" class="hidden h- w-36 text-white fixed top-16 rounded-t-full right-12 shadow-2xl  justify-center items-center" style="background-image: url({{asset('img/4.png')}})">
                <div class="backdrop-blur mt-2 rounded-t-full">
                    <a href="" class="flex justify-center items-center w-2/3 m-auto hover:bg-white hover:text-[#722714] rounded-t-full h-8">Profil</a>
                {{-- {{Auth()->user()->status}} --}}
                @if (Auth()->user()->status == 'joueur')
                <a class="flex justify-center items-center w-full m-auto hover:bg-white hover:text-[#722714] rounded-t-full h-8" href="{{route('JoueurDashboard')}}">Dashbord</a>
                <a href="{{route('joueurNotifications')}}" class="flex justify-center items-center w-full hover:bg-white hover:text-[#722714] rounded-t-full h-8">Notification</a>
                <a href="" class="flex justify-center items-center w-full hover:bg-white hover:text-[#722714] rounded-t-full h-8">Paramètres</a>
                @elseif (Auth()->user()->status == 'admin')
                    <a class="flex justify-center items-center w-full m-auto hover:bg-white hover:text-[#722714] rounded-t-full h-8" href="{{route('AdminDashboard')}}">Dashbord</a>
                    <a href="{{route('adminNotifications')}}" class="flex justify-center items-center w-full hover:bg-white hover:text-[#722714] rounded-t-full h-8">Notification</a>
                <a href="" class="flex justify-center items-center w-full hover:bg-white hover:text-[#722714] rounded-t-full h-8">Paramètres</a>
                @endif

                
                <form class="flex justify-center items-center w-full hover:bg-white hover:text-[#722714] rounded-t-full h-8" method="POST" action="{{ route('logout') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Se déconnecter</button>
                </form>
                </div>
            </div>
            <script>
                 const menuBottom = document.getElementById('menuBottom');
                const menu = document.getElementById('menu');
                let click = 0; // Initialisation de la variable click en dehors de l'événement

                menuBottom.addEventListener('click', () => {
                    if (click === 0) {
                        menu.classList.remove('hidden');
                        click = 1; // Met à jour la variable click après avoir montré le menu
                    } else {
                        menu.classList.add('hidden');
                        click = 0; // Met à jour la variable click après avoir caché le menu
                    }
                });
            </script>
        @endauth

        @guest 
            <div class="mr-5 m-auto flex justify-end items-center h-12 w-full ">
                <div class="space-x-5 flex justify-center items-center text-[#722714]">
                    <a href="#jeux">Jeux</a>
                    <a href="#apropos">À propos</a>
                    <a href="#contact">Nous contacter</a>
                    <a href="#"></a>
                </div>
                <div id="contentSeConnecter" class="flex justify-start items-center shadow shadow-black-500/50 bg-[#722714] h-9 rounded-full w-1/3 text-sm">
                    <div id="seConnecter" class="m-auto flex justify-center items-center shadow shadow-black-500/50  h-8 rounded-full w-1/2 border-2 bg-containt" style="background-image: url({{asset('img/4.png')}})"><span id="seConnectermessage" class="hidden text-white" >Se connecter</span></div>
                    <span id="messageConnect" class="m-auto italic text-[white]">Se connecter</span>
                </div>
            </div>
            
            
            {{-- <div id="login" class="hidden h-96 w-1/2 bg-white absolute top-32 rounded-lg left-auto shadow-lg  justify-center items-center pb-5">
                    <div class="w-2/3 flex justify-center items-center">
                        <form class="text-center mt-0  space-y-8 h-full w-full" action="" method="post">
                            @csrf
                            <h2 class="font-bold text-4xl text-blue-800">Connexion</h2>
                            <input class="text-center text-white text-lg h-10 w-full bg-blue-900 rounded-r-full shadow-md italic shadow-blue-900/50" type="text" name="numero" id="" placeholder="Entrer votre numéro d'identification"><br>
                            @error('numero')
                                <div class="text-red-500">
                                    {{$message}}
                                </div>
                            @enderror
                            <input class="text-center text-white text-lg h-10 w-full bg-blue-900 rounded-r-full shadow-md italic shadow-blue-900/50" type="password" name="password" id="" placeholder="Entrez votre mot de passe"><br>
                            <input class="text-center text-white text-lg h-10 w-1/2 bg-blue-900 rounded-lg shadow-md font-semibold shadow-blue-900/50 cursor-pointer" type="submit" name="" id="" value="Se connecter">
                            <div class="pb-5">
                                <a class="text-blue-800 font-semibold p-2" href="">Mot de passe oublié?</a>
                            </div>
                        </form>
                    </div>
            </div> --}}
            <script>
                const contentSeConnecter = document.getElementById('contentSeConnecter');
                const login = document.getElementById('login');
                const seConnecter = document.getElementById('seConnecter');
                const seConnectermessage = document.getElementById('seConnectermessage');
                const messageConnect = document.getElementById('messageConnect');
                seConnecter.addEventListener('click',()=>{
                    messageConnect.classList.add('hidden');
                    contentSeConnecter.classList.remove('justify-start');
                    seConnecter.classList.remove('m-auto');
                    messageConnect.classList.remove('justify-start', 'm-auto');
                    contentSeConnecter.classList.add('justify-end', 'transition');login
                    seConnectermessage.classList.remove('hidden');
                    // login.classList.remove('hidden');
                    // login.classList.add('flex');
                    window.location.href = "http://localhost:8000/connexion";
                    
                })
                
                
            </script>
        @endguest
    </div>
</header> 