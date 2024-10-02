<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    @vite('resources/css/app.css')
    <title>AfriKulture | Administration</title>
</head>
<body class="h-screen bg-[#62272d]">
    @if (Auth()->user()->status == 'admin')
        <div class="flex  justify-end items-start w-full relative h-screen">
             <div class="flex justify-center items-center py-5  w-[10%] h-screen fixed left-0">
                 <div class="relative bg-black bg-opacity-35 h-full py-4 shadow-inner rounded-full w-1/2 text-white">
                    <div class="space-x-4">
                        <a class="" href="/">
                            <div  class=" flex justify-center items-center">
                               <img class="h-14" src="{{asset('img/logoWhite.png')}}" alt=""> 
                            </div>
                        </a>
                         <a class="" href="{{route('AdminDashboard')}}">
                             <div  class=" h-10 flex justify-center items-center text-center">
                                <svg class="h-8 w-6 fill-current text-white hover:text-[#c44241]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="256" height="256"><path fill="" d="M9.135 20.773v-3.057c0-.78.637-1.414 1.423-1.414h2.875c.377 0 .74.15 1.006.414.267.265.417.625.417 1v3.057c-.002.325.126.637.356.867.23.23.544.36.87.36h1.962a3.46 3.46 0 0 0 2.443-1 3.41 3.41 0 0 0 1.013-2.422V9.867c0-.735-.328-1.431-.895-1.902l-6.671-5.29a3.097 3.097 0 0 0-3.949.072L3.467 7.965A2.474 2.474 0 0 0 2.5 9.867v8.702C2.5 20.464 4.047 22 5.956 22h1.916c.68 0 1.231-.544 1.236-1.218l.027-.009Z" class="color200E32 svgShape"></path></svg>
                             </div>
                         </a>
                         <a class="" href="{{route('AdminParties')}}">
                             <div  class=" h-10 flex justify-center items-center text-center">
                                 <svg  class="h-8 w-6 fill-current text-white hover:text-[#c44241]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="256" height="256"><path d="M20.4 46.9c-2.4 0-4.3 1.9-4.3 4.3s1.9 4.3 4.3 4.3 4.3-1.9 4.3-4.3-1.9-4.3-4.3-4.3zm23.2 0c-2.4 0-4.3 1.9-4.3 4.3s1.9 4.3 4.3 4.3 4.3-1.9 4.3-4.3-2-4.3-4.3-4.3z"></path><path d="M58.8 31.4c-4-6.4-8.4-7.7-11.4-7.7-1.5 0-2.5.4-2.5.4h-.2c-2.2.5-4.5.9-6.7 1.1H37.4v-1.6c0-1.1-.9-1.9-1.9-1.9h-1c.7-1.9 1-3.7.7-5.4-.1-.7-.3-1.4-.4-2-.3-1.4-.6-2.5-.3-3.8.4-1.5 1.5-3 3.4-4.6.3-.3.6-.7.6-1.1 0-.4-.1-.8-.3-1.2-.4-.3-.8-.6-1.3-.6-.4 0-.7.1-1 .4-2.5 2-3.9 4-4.5 6.3-.5 2-.1 3.8.3 5.4l.1.3c.1.5.2.9.3 1.4.2 1.5-.1 3.1-1.1 4.9h-2.4c-1.1 0-1.9.9-1.9 1.9v1.6H26.1c-2.2-.2-4.4-.6-6.7-1.1h-.1s-1-.4-2.5-.4c-3 0-7.4 1.3-11.4 7.8C1.6 37.9-.1 44.8.2 51.6c0 1 .2 2.4.5 3.8.5 1.9 1.9 3.9 3.5 4.8.8.5 1.8.8 3.1.8.8 0 1.7-.1 2.6-.3l.2-.1c1.1-.4 4-1.6 6.9-4.3l.3-.3-.3-.2c-1.4-1.1-2.3-2.8-2.3-4.6 0-3.2 2.6-5.7 5.7-5.7 2.1 0 4 1.2 5.1 3l.1.2h12.9l.1-.2c1-1.9 3-3 5.1-3 3.2 0 5.7 2.6 5.7 5.7 0 1.8-.9 3.5-2.3 4.6l-.4.2.3.3c3.1 2.9 6.2 4.1 7.2 4.4.9.2 1.8.3 2.6.3 1.2 0 2.3-.3 3.2-.8 1.6-.9 3.1-2.9 3.5-4.8.3-1.4.5-2.9.5-3.8.3-6.8-1.5-13.8-5.2-20.2zm-34.7 6c0 .2-.1.4-.2.5-.1.1-.3.2-.5.2h-3.3v3.3c0 .4-.3.7-.7.7h-4.5c-.2 0-.4-.1-.5-.2-.1-.1-.2-.3-.2-.5v-3.3h-3.3c-.4 0-.7-.3-.7-.7v-4.5c0-.2.1-.4.2-.5.1-.1.3-.2.5-.2v-.3.3h3.3v-3.3c0-.4.3-.7.7-.7h4.5c.2 0 .4.1.5.2.1.1.2.3.2.5v3.3h3.3c.4 0 .7.3.7.7v4.5zm21.4-10.2c1.5 0 2.8 1.2 2.8 2.8 0 1.5-1.2 2.8-2.8 2.8s-2.8-1.2-2.8-2.8c.1-1.6 1.3-2.8 2.8-2.8zm-5.2 10.7c-1.5 0-2.8-1.2-2.8-2.8 0-1.5 1.2-2.8 2.8-2.8 1.5 0 2.8 1.2 2.8 2.8 0 1.6-1.2 2.8-2.8 2.8zm5.2 5.2c-1.5 0-2.8-1.2-2.8-2.8 0-1.5 1.2-2.8 2.8-2.8s2.8 1.2 2.8 2.8c0 1.6-1.2 2.8-2.8 2.8zm5.3-5.2c-1.5 0-2.8-1.2-2.8-2.8 0-1.5 1.2-2.8 2.8-2.8s2.8 1.2 2.8 2.8c-.1 1.6-1.3 2.8-2.8 2.8z"></path><circle cx="50.8" cy="35.2" r="1.3"></circle><circle cx="45.5" cy="40.4" r="1.3"></circle><path d="M45.5 31.3c.7 0 1.3-.6 1.3-1.3 0-.7-.6-1.3-1.3-1.3-.7 0-1.3.6-1.3 1.3 0 .7.6 1.3 1.3 1.3zm-5.2 2.5c-.7 0-1.3.6-1.3 1.3 0 .7.6 1.3 1.3 1.3.7 0 1.3-.6 1.3-1.3.1-.7-.5-1.3-1.3-1.3zm-21.7-.9v-3.3h-3.1v3.3c0 .4-.3.7-.7.7h-3.3v3.1h3.3c.2 0 .4.1.5.2.1.1.2.3.2.5v3.3h3.1v-3.3c0-.4.3-.7.7-.7h3.3v-3.1h-3.3c-.4 0-.7-.3-.7-.7z"></path></svg>
                             </div>
                         </a>
                         <a class="" href="{{route('AdminPlanning')}}">
                             <div  class=" h-10 flex justify-center items-center text-center">
                                 <svg class="h-8 w-6 fill-current text-white hover:text-[#c44241]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="256" height="256"><path fill="" d="M0.00676782204,6.77232286 C-0.0494507818,5.65586163 0.245894841,4.55305045 0.84355309,3.62839007 L0.99923733,3.40103165 L1.01210426,3.38857175 L1.12018651,3.26174784 L1.12018651,3.26174784 L1.23341553,3.13225394 L1.24628246,3.11890406 C1.46244695,2.89729595 1.70177193,2.70238761 1.9599684,2.53595903 L2.03288103,2.48979068 L2.03288103,2.48979068 L2.10579365,2.44695979 L2.27735277,2.34817064 C2.34683422,2.31524092 2.42232023,2.27608125 2.49180167,2.24315153 C2.54241161,2.2235717 2.59302155,2.19776192 2.64363149,2.17818209 C2.73884681,2.13813243 2.84006669,2.09897277 2.94128657,2.06604305 C2.97559839,2.04913319 3.01162581,2.03578331 3.04851102,2.02688338 L3.08947076,2.01041852 L3.08947076,2.01041852 L3.13429058,1.99395366 C3.59578461,1.85600484 4.07014558,1.76077565 4.54965332,1.71716603 L4.5,1.72298326 L4.5,0.728345984 C4.5,0.329539814 4.82169259,0.00708167176 5.21955196,0.00708167176 C5.61741133,0.00708167176 5.94,0.329539814 5.94,0.728345984 L5.94,3.87208831 C5.94,4.27089448 5.61741133,4.59425084 5.21955196,4.59425084 C4.82169259,4.59425084 4.5,4.27089448 4.5,3.87208831 L4.50004747,3.14527577 C4.02769655,3.19256915 3.56389095,3.31009562 3.12399703,3.49626084 C1.98883322,4.00693847 1.44745054,4.97946655 1.39615018,6.52067306 L1.39210771,6.76876289 L1.39210771,7.15590959 L16.6085438,7.15590959 L16.6085438,6.75897298 C16.6377089,6.04519907 16.494457,5.33498514 16.1907974,4.69330061 C15.8991469,4.1441753 15.4325061,3.71786894 14.8689344,3.48647092 C14.5100327,3.33196824 14.1341124,3.22417236 13.7499572,3.16536166 L13.5,3.13498326 L13.5000297,3.86846142 C13.5000297,4.26554745 13.1778298,4.58716917 12.7800299,4.58716917 C12.38223,4.58716917 12.06003,4.26554745 12.06003,3.86846142 L12.06,3.08098326 L5.94700235,3.08152438 L5.94700235,1.65130659 L12.06,1.65098326 L12.06003,0.724115014 C12.05643,0.327028983 12.37683,0.00271211083 12.7746299,1.15491618e-13 C13.1724298,-0.00267819729 13.4973297,0.316248366 13.5000297,0.713334398 L13.500604,1.71745172 C13.8499757,1.75192359 14.19651,1.8128727 14.5375476,1.89995417 L14.8766545,1.99573365 C14.904104,2.0010736 14.9246911,2.00819354 14.9624341,2.02154343 C15.0001771,2.03489331 15.0319155,2.0482432 15.0696585,2.06070309 C15.1700206,2.09363281 15.2635203,2.13279248 15.3604513,2.17284213 C15.416208,2.19242197 15.4676757,2.21823175 15.5114233,2.23781158 C15.5869093,2.2707413 15.6641109,2.30990096 15.7258722,2.34283068 C15.7893491,2.3757604 15.8502525,2.41225009 15.9034359,2.44161984 C15.9566192,2.47098959 15.9977934,2.50391931 16.0423988,2.53061908 C16.2366895,2.65610801 16.42133,2.7976168 16.5937871,2.95326813 L16.7620893,3.1135641 L16.7698094,3.12691399 L16.8874346,3.25173542 L16.8874346,3.25173542 L16.9979831,3.3832318 L17.0039876,3.39569169 C17.6508975,4.29033944 17.9988681,5.37684638 17.9999972,6.49001176 L17.9930259,6.76876289 L17.9930259,7.15590959 L18,7.15590959 L18,14.9101539 C18,18.291571 16.111588,19.9999833 12.3690987,19.9999833 L12.3690987,19.9999833 L5.6223176,19.9999833 C1.88841202,19.9999833 0,18.291571 0,14.9101539 L0,14.9101539 L0,7.15590959 L0.00676782204,7.15590959 L0.00676782204,6.77232286 Z M13.1158798,14.2462631 C12.6523605,14.2462631 12.2832618,14.6268939 12.2832618,15.0960433 C12.2918455,15.5651928 12.6609442,15.9458235 13.1158798,15.9458235 C13.5708155,15.9458235 13.9399142,15.5651928 13.9399142,15.0960433 C13.9399142,14.6268939 13.5708155,14.2462631 13.1158798,14.2462631 L13.1158798,14.2462631 Z M9.00429185,14.2374113 C8.54077253,14.2462631 8.17167382,14.6268939 8.17167382,15.0960433 C8.17167382,15.5651928 8.54935622,15.9458235 9.00429185,15.9458235 C9.45922747,15.9458235 9.82832618,15.5651928 9.82832618,15.0871915 C9.81974249,14.6268939 9.45922747,14.2462631 9.00429185,14.2374113 L9.00429185,14.2374113 Z M4.88412017,14.2374113 C4.42060086,14.2374113 4.05150215,14.6268939 4.06008584,15.0960433 C4.06008584,15.5651928 4.42918455,15.9458235 4.88412017,15.9458235 C5.33905579,15.9458235 5.70815451,15.556341 5.70815451,15.0871915 C5.70815451,14.618042 5.33905579,14.2374113 4.88412017,14.2374113 Z M13.1158798,10.6169935 C12.6523605,10.6169935 12.2918455,10.9976242 12.2918455,11.4667737 C12.2918455,11.9359232 12.6609442,12.3165539 13.1158798,12.3165539 C13.5708155,12.3165539 13.9399142,11.9359232 13.9399142,11.4667737 C13.9399142,10.9976242 13.5708155,10.6169935 13.1158798,10.6169935 Z M9.00429185,10.6081417 C8.54077253,10.6169935 8.17167382,10.9976242 8.17167382,11.4667737 C8.17167382,11.9359232 8.54935622,12.3165539 9.00429185,12.3165539 C9.45922747,12.3165539 9.82832618,11.9359232 9.82832618,11.4579219 C9.82832618,10.9976242 9.45922747,10.6169935 9.00429185,10.6081417 L9.00429185,10.6081417 Z M4.89270386,10.6081417 C4.42918455,10.6081417 4.06008584,10.9976242 4.06008584,11.4667737 C4.06008584,11.9359232 4.42918455,12.3165539 4.88412017,12.3165539 C5.34763948,12.3165539 5.7167382,11.9270713 5.70815451,11.4579219 C5.70815451,10.9887724 5.33905579,10.6081417 4.89270386,10.6081417 L4.89270386,10.6081417 Z" transform="translate(3 2)" class="color200E32 svgShape"></path></svg>
                             </div>
                         </a>
                         <a class="" href="{{route('classement')}}">
                            <div  class=" h-10 flex justify-center items-center text-center">
                                <svg class="h-8 w-6 fill-current text-white hover:text-[#c44241]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M5.566 4.657A4.505 4.505 0 0 1 6.75 4.5h10.5c.41 0 .806.055 1.183.157A3 3 0 0 0 15.75 3h-7.5a3 3 0 0 0-2.684 1.657ZM2.25 12a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3v-6ZM5.25 7.5c-.41 0-.806.055-1.184.157A3 3 0 0 1 6.75 6h10.5a3 3 0 0 1 2.683 1.657A4.505 4.505 0 0 0 18.75 7.5H5.25Z" />
                                  </svg>
                                  
                            </div>
                        </a>
                        
                    </div>
                     
                     <div class="absolute p-5 h-24 bottom-0 w-full rounded-full flex justify-center items-center">
                        <div class="group border-2 border-dashed border-[#c44241] p-2 rounded-2xl">
                            <div class="bg-[#c44241] text-xl rounded-full px-3 py-1 flex justify-center items-center shadow-md shadow-[#c44241]/50 group-hover:bg-white group-hover:text-[#c44241] group-hover:cursor-pointer">
                                <form class="flex justify-center items-center w-full hover:bg-white hover:text-blue-800 rounded-t-full h-8" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <svg class="h-8 w-4 fill-current text-white group-hover:text-[#c44241]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="256" height="256"><path fill="" fill-rule="evenodd" d="M11 1H9V8C9 8.55228 9.44771 9 10 9H13C13.5523 9 14 8.55228 14 8V4C14 2.34315 12.6569 1 11 1ZM14 16C14 15.4477 13.5523 15 13 15H10C9.44772 15 9 15.4477 9 16V18C9 18.5523 8.55228 19 8 19H1V20C1 21.6569 2.34315 23 4 23H11C12.6569 23 14 21.6569 14 20V16Z" clip-rule="evenodd" class="colorC4E6FF svgShape"></path><path fill="" fill-rule="evenodd" d="M4 3C3.44772 3 3 3.44772 3 4V20C3 20.5523 3.44772 21 4 21H11C11.5523 21 12 20.5523 12 20V16C12 15.4477 12.4477 15 13 15C13.5523 15 14 15.4477 14 16V20C14 21.6569 12.6569 23 11 23H4C2.34315 23 1 21.6569 1 20V4C1 2.34315 2.34315 1 4 1H11C12.6569 1 14 2.34315 14 4V8C14 8.55228 13.5523 9 13 9C12.4477 9 12 8.55228 12 8V4C12 3.44772 11.5523 3 11 3H4Z" clip-rule="evenodd" class="color024493 svgShape"></path><path fill="" d="M17.7071 6.2929C17.3166 5.90237 16.6834 5.90237 16.2929 6.29289C15.9024 6.68341 15.9024 7.31658 16.2929 7.7071L19.5858 11H6C5.44772 11 5 11.4477 5 12C5 12.5523 5.44772 13 6 13H19.5858L16.2929 16.2929C15.9024 16.6834 15.9024 17.3166 16.2929 17.7071C16.6834 18.0976 17.3166 18.0976 17.7071 17.7071L22.7071 12.7071C23.0976 12.3166 23.0976 11.6834 22.7071 11.2929L17.7071 6.2929Z" class="color1E93FF svgShape"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                     </div>
                 </div>
             </div>
             <div class="justify-start items-start w-[92%]  h-full py-1 ">
                <div class="p-5 grid grid-cols-1 ">
                    <div class="grid grid-cols-8 font-bold text-lg text-white space-x-2">
                        <div class="col-span-3">
                            <span class="text-[#c44241] text-opacity-45 ">{{$message1}}</span>
                            <span class=""> {{$message2}}</span>
                        </div>
                        <div class=" col-span-4 flex justify-center  items-center">
                            <div class="text-sm space-x-2 flex justify-center rounded-full items-center w-1/2 bg-black/25 px-3">
                                <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                  </svg>
                                  
                                <input class="h-8 bg-transparent w-full rounded-r-full focus:border-transparent focus:outline-none font-none placeholder:text-sm placeholder:italic " type="text" name="" id="" placeholder="recherche">
                            </div>
                        </div>
                        <div class="relative flex justify-end  items-center">
                            <div class="rounded-full bg-black/35 px-5 relative mr-2">
                                <svg id="notif" class="h-8 w-6 fill-current text-white hover:text-[#c44241]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path fill-rule="evenodd" d="M5.25 9a6.75 6.75 0 0 1 13.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 0 1-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 1 1-7.48 0 24.585 24.585 0 0 1-4.831-1.244.75.75 0 0 1-.298-1.205A8.217 8.217 0 0 0 5.25 9.75V9Zm4.502 8.9a2.25 2.25 0 1 0 4.496 0 25.057 25.057 0 0 1-4.496 0Z" clip-rule="evenodd" />
                                  </svg>
                                  <div id="notification" class=" hidden z-50 absolute w-[300px] right-1 top-10 backdrop-blur bg-[#c44241]/25 rounded-lg">
                                    <div class="w-11/12 text-md font-none m-auto text-center">nouveaux messages</div>
                                    <div class="w-11/12 text-md font-none m-auto text-center" id="notificationsSection"></div>
                                    @switch(auth()->user()->status)
                        
                                        @case('joueur')
                                        <a class="w-11/12 text-md font-none m-auto flex justify-center items-center" href="{{route('joueurNotifications')}}">Toutes les notifications</a>
                                    
                                            @break
                                        @case('admin')
                                        <a class="w-11/12 text-md font-none m-auto flex justify-center items-center" href="{{route('adminNotifications')}}">Toutes les notifications</a> 
                                        @break

                                        @default 
                                        
                                    @endswitch
                                </div>
                                <span class="absolute  right-2 top-0 animate-ping  p-1 bg-[#c44241]  rounded-full"></span>
                            </div>
                            <div class="rounded-full bg-black/35 px-5 relative mr-2">
                                A
                                <span class="absolute  right-2 top-0 animate-ping  p-1 bg-[#c44241]  rounded-full"></span>
                            </div>
                        </div>
                    </div>
                    <div class="h-full w-full py-5">
                        <div class=" h-full w-full ">
                                @yield('content')
                        </div>
                    </div> 
                </div>
             </div>
        </div>
    @else
        
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notif = document.getElementById('notif');
        const notification = document.getElementById('notification');
        const notificationsSection = document.getElementById("notificationsSection");
        let not = true;
        notif.addEventListener('click',()=>{
            if (not) {
                notification.style.display = 'block';
                 // Effectuez une requête AJAX pour récupérer les notifications
        fetch("/notif")
        .then((response) => response.json())
        .then((data) => {
        // Vérifiez si le tableau data est vide
        if (data.length === 0) {
            // Si le tableau est vide, affichez un message indiquant qu'il n'y a pas de notifications
            notificationsSection.classa
            notificationsSection.innerHTML = `
                <div class="w-full text-black flex justify-center items-center">
                    <p>Vous n'avez aucune notification</p>
                </div>
            `;
        } else {
            // Si le tableau n'est pas vide, générez le contenu HTML pour les notifications
            const notificationsHTML = data.map((notification) => {
                console.log(notification);
                return `
                    <a href="${notification.data.url}/${notification.id}" class="h-56 hover:bg-yellow-500 border-b-2 m-auto hover:border-blue-800 cursor-pointer w-full ">
                        <div class="hover:bg-yellow-500 text-black hover:text-white border-b-2 flexbox hover:border-blue-800 rounded-lg ">
                            <div class="font-semibold">${notification.data.titre}</div>
                            <div>${notification.data.descrip}</div>
                            <div class="text-sm text-zinc-400 font-semibold flex justify-end">${notification.data.date}</div>
                        </div>
                    </a>
                `;
            }).join("");

            // Mettez à jour le contenu de la section de notifications
            notificationsSection.innerHTML = notificationsHTML;
        }
            })
            .catch((error) => {
                console.error("Erreur lors de la récupération des notifications : ", error);
            });
           
             
            } else {
                notification.style.display = 'none';
            }
            not = !not;
            
            document.addEventListener("click", function (e) {
                if (!notif.contains(e.target)) {
                    notification.style.display = 'none';
                }
            });
        })
        })
    </script>
    
</body>
</html>