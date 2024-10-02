
@extends('joueur.layout')
@section('content')


<div class="w-full h-full text-lg">
    <div class=" rounded-lg   m-auto w-[98%] flex justify-center content-center items-center ">
        <div class="h-[30em] relative rounded-lg  flex w-[98%] mb-5 mt-5  text-center content-center justify-center items-center ">

                <div id="notification" class=" w-full backdrop-blur  rounded-lg justify-center items-center content-center   z-10">
                    <div class=" w-full">
                        <div   class="w-full h-full flex  justify-center items-center content-center ">
                            <div class="w-full h-full  ">
                                <div  id="notificationsSection" class="w-[99%] h-full flexbox m-auto justify-center items-center content-center">
                                        <div class="w-full h-full flex justify-center items-center">
                                            <div class="w-1/2 h-78 bg-black/25 text-white rounded-lg flexbox ">
                                                
                                                <div id="manotif"></div>
                                                <div class="flex justity-center items-center cursor-pointer" id="action"></div>
                                                <div class="m-auto mt-5 mb-2 text-lg text-white font-semibold flex justify-center">Merci pour votre confiance! </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                              
                        </div>  
                    </div>
                </div>
        </div>
    </div>
</div>
<script>
    const manotif = document.getElementById("manotif");
    const action = document.getElementById("action");
    $notification= JSON.parse(@json($notificationjson))
    $id=$notification.id;
    console.log("/manotif/"+$id);
    
fetch("/manotif/"+$id)
.then((response) => response.json())
.then((data) => {
// Vérifiez si le tableau data est vide
if (data.length === 0) {
    // Si le tableau est vide, affichez un message indiquant qu'il n'y a pas de notifs
    manotif.class
    manotif.innerHTML = `
        <div class="w-full text-black flex justify-center items-center">
            <p>Vous n'avez aucune notif</p>
        </div>
    `;
} else {
    
console.log(data);

        // Si le tableau n'est pas vide, générez le contenu HTML pour les notifs
    const notifsHTML =  `
            <div class="m-auto mt-5 text-2xl font-semibold">${data.data.titre}</div>
            <div class=" mt-5 text-xl p-3">${data.data.message}</div>
        `;
    const lien = `
                <a href="${data.data.link}" class=" p-5 h-24 bottom-0 w-full rounded-full flex justify-center items-center">
                        <div class="group border-2 border-dashed border-[#c44241] p-2 rounded-2xl">
                            <div class="bg-[#c44241] text-xl rounded-full px-3 py-1 flex justify-center items-center shadow-md shadow-[#c44241]/50 group-hover:bg-white group-hover:text-[#c44241] group-hover:cursor-pointer">
                                Découvrir
                            </div>
                        </div>
                     </a>
    `;
    // Mettez à jour le contenu de la section de notifs
    manotif.innerHTML = notifsHTML;
    action.innerHTML = lien;
   
}
    })
    .catch((error) => {
        console.error("Erreur lors de la récupération des notifs : ", error);
    });
</script>
@endsection