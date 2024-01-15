window.addEventListener("load",arrancaMenu);

function arrancaMenu(){
    const colores=document.querySelector('.colores');
    colores.addEventListener("click",mostrarColores)
    
}

function mostrarColores(){

    document.querySelector("nav>ul").classList.toggle("desplegar");

}


