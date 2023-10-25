// Js del buscador

document.getElementById("icon-search").addEventListener("click", mostrar_buscador);
document.getElementById("icon-menu").addEventListener("click", ocultar_buscador);
document.getElementById("inputSearch").addEventListener("keyup", buscador_interno);

bars_search =  document.getElementById("ctn_bars-search");
inputSearch =  document.getElementById("inputSearch");
box_search  =  document.getElementById("box-search");
icon_menu = document.getElementById("icon-menu");
ctn_icon_search = document.getElementById("ctn-icon-search");
cover_ctn_search = document.getElementById("cover-ctn-search");


function mostrar_buscador(){
    cover_ctn_search.style.display = "block";
    bars_search.style.top = "210px";
    icon_menu.style.display = "flex";
    ctn_icon_search.style.display = "none";
    inputSearch.focus();
}

function ocultar_buscador(){
    cover_ctn_search.style.display = "none";
    bars_search.style.top = "5px";
    icon_menu.style.display = "none";
    box_search.style.display = "none";
    ctn_icon_search.style.display = "flex";
    inputSearch.value = "";

    if (inputSearch.value === ""){

        box_search.style.display = "none";

    }

}


function buscador_interno(){

    filter = inputSearch.value.toUpperCase();
    li = box_search.getElementsByTagName("li");



    for (i = 0; i < li.length; i++){

        a = li[i].getElementsByTagName("a")[0];
        textValue = a.textContent || a.innerText;

        if(textValue.toUpperCase().indexOf(filter) > -1){

            li[i].style.display = "";
            box_search.style.display = "block";

            if (inputSearch.value === ""){

                box_search.style.display = "none";

            }

        }
        else{

            li[i].style.display = "none";

        }
    }
}



