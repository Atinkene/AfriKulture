@extends('admin.layout')
@section('content')

<div class="w-full">
    <div class=" rounded-lg   m-auto w-[98%] flex justify-center content-center items-center ">
        <div class="relative rounded-lg  flex w-[98%] mb-5 mt-5  text-center content-center justify-center items-center ">
            <div class=" h-[31em] overflow-y-auto overflow-x-hidden rounded-lg  bg-black/25 m-auto w-full mt-10  ">

                <div id="notif" class=" w-full backdrop-blur rounded-lg justify-center items-center content-center   z-10">
                    <div class="flexbox  w-full">
                        <div   class="w-full flex  justify-center items-center content-center ">
                            <div class="w-full">
                                <div  id="notifsSection" class="w-[99%] text-white flexbox m-auto justify-center items-center content-center">
                                   
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
            const notifsSection = document.getElementById("notifsSection");

    fetch("/mynotif")
        .then((response) => response.json())
        .then((data) => {
        // Vérifiez si le tableau data est vide
        if (data.length === 0) {
            // Si le tableau est vide, affichez un message indiquant qu'il n'y a pas de notifs
            notifsSection.class
            notifsSection.innerHTML = `
                <div class="w-full text-black flex justify-center items-center">
                    <p>Vous n'avez aucune notif</p>
                </div>
            `;
        } else {
            // Si le tableau n'est pas vide, générez le contenu HTML pour les notifs
            const notifsHTML = data.map((notif) => {
                console.log(notif);
                let message = `${notif.data.message}`.slice(0,50);
                return `
                    <a href="${notif.data.url}/${notif.id}" class=" border-b-2 m-auto  hover:border-black/25 cursor-pointer group w-full ">
                        <div class="grid grid-cols-3 justify-center text-white h-10 items-center  bg-gradient-to-r  from-[#c44241] via-[#c44241] to-[#cf6d60] shadow-inner border-b-2  hover:border-black/25 rounded-lg ">
                            <div class="m-auto font-semibold"><p>${notif.data.titre}</p></div>
                            <div class="m-auto "><p class="">${message}...</p></div>
                            <div class="m-auto text-sm text-black/35 font-semibold flex justify-end">${notif.data.date}</div>
                        </div>
                    </a>
                `;
            }).join("");

            // Mettez à jour le contenu de la section de notifs
            notifsSection.innerHTML = notifsHTML;
        }
            })
            .catch((error) => {
                console.error("Erreur lors de la récupération des notifs : ", error);
            });
</script>
@endsection