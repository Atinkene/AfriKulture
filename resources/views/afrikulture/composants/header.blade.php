<header class="fixed  relatif text-weight top-0 font-bold  bg-white text-blue-900 w-full p-2 shadow shadow-black-500/50 z-10 rounded-br-full  rounded-bl-full ">
    <div class="flex justify-center items-center relative">
        <div class="ml-12 m-auto flex justify-start items-start w-full" ><img class="h-12" src="{{asset('img/logo.png')}}" alt="logo"></div>
        @auth
            <svg id="menuBottom" width="50" height="" viewBox="0 0 94 91" fill="none" class="mr-24 cursor-pointer" xmlns="http://www.w3.org/2000/svg">
                <g filter="url(#filter0_d_52_2)">
                <ellipse cx="47" cy="41.5" rx="43" ry="41.5" fill="white"/>
                </g>
                <rect x="27" y="37" width="40" height="9" rx="4.5" fill="#11235A"/>
                <rect x="7" y="51" width="80" height="9" rx="4.5" fill="#11235A"/>
                <ellipse cx="37" cy="23.5" rx="10" ry="8.5" fill="#11235A"/>
                <defs>
                <filter id="filter0_d_52_2" x="0" y="0" width="94" height="91" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                <feOffset dy="4"/>
                <feGaussianBlur stdDeviation="2"/>
                <feComposite in2="hardAlpha" operator="out"/>
                <feColorMatrix type="matrix" values="0 0 0 0 0.0666667 0 0 0 0 0.137255 0 0 0 0 0.352941 0 0 0 1 0"/>
                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_52_2"/>
                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_52_2" result="shape"/>
                </filter>
                </defs>
            </svg>
            <div id="menu" class="hidden bg-[#11235A] h- w-36 text-white fixed top-16 rounded-t-full right-12 shadow-2xl pt-8  justify-center items-center">
                <a href="" class="flex justify-center items-center w-full m-auto hover:bg-white hover:text-blue-900 rounded-t-full h-8">Profil</a>
                {{-- <a class="flex justify-center items-center w-full m-auto hover:bg-white hover:text-blue-900 rounded-t-full h-8" href="{{route('EnseignantDashboard')}}">Dashbord</a> --}}
                <a href="" class="flex justify-center items-center w-full hover:bg-white hover:text-blue-900 rounded-t-full h-8">Notification</a>
                <a href="" class="flex justify-center items-center w-full hover:bg-white hover:text-blue-900 rounded-t-full h-8">Paramètres</a>
                <form class="flex justify-center items-center w-full hover:bg-white hover:text-blue-900 rounded-t-full h-8" method="POST" action="{{ route('logout') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Se déconnecter</button>
                </form>
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
                <div id="contentSeConnecter" class="flex justify-start items-center shadow shadow-black-500/50 bg-blue-900 h-10 rounded-full w-1/3">
                    <div id="seConnecter" class="m-auto flex justify-center items-center shadow shadow-black-500/50 bg-white h-9 rounded-full w-1/2"><span id="seConnectermessage" class="hidden">Se connecter</span></div>
                    <span id="messageConnect" class="m-auto italic text-white">Se connecter</span>
                </div>
            </div>
            
            
            {{-- <div id="login" class="hidden h-96 w-1/2 bg-white absolute top-32 rounded-lg left-auto shadow-lg  justify-center items-center pb-5">
                    <div class="w-2/3 flex justify-center items-center">
                        <form class="text-center mt-0  space-y-8 h-full w-full" action="" method="post">
                            @csrf
                            <h2 class="font-bold text-4xl text-blue-900">Connexion</h2>
                            <input class="text-center text-white text-lg h-10 w-full bg-blue-900 rounded-r-full shadow-md italic shadow-blue-900/50" type="text" name="numero" id="" placeholder="Entrer votre numéro d'identification"><br>
                            @error('numero')
                                <div class="text-red-500">
                                    {{$message}}
                                </div>
                            @enderror
                            <input class="text-center text-white text-lg h-10 w-full bg-blue-900 rounded-r-full shadow-md italic shadow-blue-900/50" type="password" name="password" id="" placeholder="Entrez votre mot de passe"><br>
                            <input class="text-center text-white text-lg h-10 w-1/2 bg-blue-900 rounded-lg shadow-md font-semibold shadow-blue-900/50 cursor-pointer" type="submit" name="" id="" value="Se connecter">
                            <div class="pb-5">
                                <a class="text-blue-900 font-semibold p-2" href="">Mot de passe oublié?</a>
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