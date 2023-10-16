// FUNCIONABILIDAD DEL BUSCADOR

// EjECUTANDO FUNCIONES
document.getElementById("icon-search").addEventListener("click", mostrar_buscador);
document.getElementById("icon-menu").addEventListener("click", ocultar_buscador);

bars_search =  document.getElementById("ctn_bars-search");
inputSearch =  document.getElementById("inputSearch");
box_search  =  document.getElementById("box-search");
icon_menu = document.getElementById("icon-menu");
ctn_icon_search = document.getElementById("ctn-icon-search");


// MOSTRAR EL BUSCADOR
function mostrar_buscador(){

    bars_search.style.top = "210px";
    box_search.style.display = "block";
    box_search.style.transition = "all 700ms";
    icon_menu.style.display = "flex";
    ctn_icon_search.style.display = "none";
    inputSearch.focus();
}

// OCULTAR EL BUSCADOR
function ocultar_buscador(){

    bars_search.style.top = "5px";
    box_search.style.display = "none";
    icon_menu.style.display = "none";
    ctn_icon_search.style.display = "flex";
    inputSearch.value = "";

}



