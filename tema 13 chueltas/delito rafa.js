import Jugador from './Jugador.js';

// Array para almacenar jugadores
let misJugadores = [];

// Array para almacenar los dos jugadores que compiten
let dosJugadores = []

//Letras a pulsar para sumar puntos
let letras = []

//Jugadores dummies para llenar el array Jugadores dummy para practicar
misJugadores.push(new Jugador());
misJugadores.push(new Jugador("Paco"));

//Creamos variables de arranque
let nuevoJugador = document.getElementById("nuevoJugador");
nuevoJugador.addEventListener("click", introducirJugador);

/**************************************************************************************************************/
//Función raíz añadir jugador
// Observo si el array misJugadores tiene alguna entrada
// - De no tenerla, creo los campos para la inserción y desactivo el botón "Nuevo Jugador"
// - De tenerla, habré creado los campos anteriormente, por tanto únicamente los vuelvo a mostrar
// Deshabilito el botón Nuevo Jugador

function introducirJugador(e) {
    e.target.disabled = true;
    let camposJugadores = document.querySelector(".addJugador");

    // Evalúo si existen los campos para insertar nuevos jugadores Si no existen, se crean Si existen, se muestran
    if (document.querySelector(".addJugador").children.length === 0) {
        camposJugadores.appendChild(crearCampos(['nombreJugador', 'apellidosJugador', 'edadJugador'], ['Nombre', 'Apellidos', 'Edad']));
    } else {
        camposJugadores.classList.remove("hidden");
    }
    resetearNodos(camposJugadores.children);
}

// Creamos los distintos campos text donde irán los datos de los jugadores
function crearCampos(arrayCampos, arrayHolders) {
    const campos = document.createDocumentFragment();

    for (let intcont = 0; intcont < arrayCampos.length; intcont++) {
        campos.appendChild(crearInput(arrayCampos[intcont], arrayHolders[intcont]));
    }
    campos.appendChild(crearBoton());
    return campos;
}

function crearBoton() {
    let botonInsertar = document.createElement("button");
    botonInsertar.innerText = "Insertar Jugador";
    botonInsertar.addEventListener("click", insertarJugador);
    return botonInsertar;
}

function crearInput(idCampo, holderCampo) {
    let campo = crearElemento("input", idCampo)
    campo.placeholder = holderCampo;
    campo.type = "text";
    return campo;
}

// Versión con modificación de clases

function insertarJugador() {
    misJugadores.push(new Jugador(document.getElementById("nombreJugador").value, document.getElementById("apellidosJugador").value, document.getElementById("edadJugador").value))
    // Oculto campos de inserción de jugadores
    document.querySelector(".addJugador").classList.add("hidden")
    // Reactivo botón
    document.getElementById("nuevoJugador").disabled = false;
}

function resetearNodos(nodos) {
    if (nodos === undefined) {
        return;
    }
    for (const nodo of nodos) {
        nodo.value = ""
    }
}

/**************************************************************************************************************/

// Función raíz inicio de juego

let botonInicia = document.getElementById("iniciaJuego")
botonInicia.addEventListener("click", arrancoJuego)

function arrancoJuego() {
    // Deshabilito adición de jugadores
    activarDesactivarBoton(true);
    document.querySelector(".addJugador").classList.add("hidden");

    //Recibo dos jugadores nuevos
    introducirJugadores(generarJugadorLetra(false));

    //Arranco los listeners
    preparadosYa();
}

function activarDesactivarBoton(blnValor) {
    nuevoJugador.disabled = blnValor;
    botonInicia.disabled = blnValor;
}

//Función para solicitar dos jugadores diferentes
function generarJugadorLetra(blnValor) {
    let funcion = randomNumber;

    if (blnValor == true)
        funcion = crearLetra;

    let arrayValores = [funcion(), funcion()];

    while (arrayValores[0] === arrayValores[1]) {
        arrayValores[1] = funcion();
    }

    if (blnValor == true)
        return ponmeLetras(arrayValores[0], arrayValores[1]);
    else
        return cambiarJugadores(arrayValores[0], arrayValores[1]);
}

function randomNumber() {
    return Math.floor(Math.random() * misJugadores.length);
}

function cambiarJugadores(numeroJugador1, numeroJugador2) {
    dosJugadores = [];
    dosJugadores.push(misJugadores[numeroJugador1])
    dosJugadores.push(misJugadores[numeroJugador2])
    return dosJugadores;
}

// Introduzco jugadores dentro de los contenedores de juego
function introducirJugadores(jugadoresPasados) {
    meterJugador(jugadoresPasados[0], document.getElementById("jugador1"));
    meterJugador(jugadoresPasados[1], document.getElementById("jugador2"));
}

// Función de introducción individualizada
function meterJugador(jugador, nodo) {
    let misP = nodo.getElementsByTagName("p");
    let arrayCampos = ['Nombre:', 'Edad:', 'Entrenamiento:'];
    let valoresCampos = [jugador.nombre, jugador.edad, jugador.entrenamiento];

    for (let intcont = 0; intcont < misP.length; intcont++) {
        misP[intcont].innerHTML = `<strong>${arrayCampos[intcont]}:</strong> ${valoresCampos[intcont]}`
    }
}
// Saco los dos contadores al global por uso masivo
let contador1 = document.getElementById("contador1")
let contador2 = document.getElementById("contador2")

function activoTeclas() {
    document.addEventListener("keyup", detectarTecla)
}

// Función para detectar pulsaciones de ambas teclas
function detectarTecla(evento) {
    if (evento.key === letras[0]) {
        sumarLetra(contador1);
        return;
    }
    if (evento.key === letras[1]) {
        sumarLetra(contador2);
    }
}

function sumarLetra(contador) {
    let sumador = Number.parseInt(contador.innerText);
    sumador++
    contador.innerText = sumador.toString();
}

// Preparamos a los jugadores con un contador aleatorio entre 1 y 10 segundos

function preparadosYa() {
    let i = 2
    iniciarAviso();
    setTimeout(function () {
            cambiarPanel(document.getElementById("alerta"), "ya", "preparados", 'GO!');
            comienzaLaBatalla();
        }
        , i * 1000);
}

// Funcionalidad del botón aviso
// Busca si el aviso ya estaba creado. Si no existe, lo crea. En ambos casos reinicia su estado a "preparado"

function iniciarAviso() {
    let contenedorAviso;
    if (document.getElementById("contenedorAviso") === null) {
        contenedorAviso = generarAviso();
    } else {
        contenedorAviso = document.getElementById("contenedorAviso")
        verPanel(true);
    }
    cambiarPanel(contenedorAviso.getElementsByTagName("p")[0], "preparados", "ya", "Ready");
}

// Creo los nodos para generar el aviso
function generarAviso() {
    let avisoMedio = document.querySelector(".resumen");
    let contenedorAviso = crearElemento("div", "contenedorAviso");
    let textoAviso = crearElemento("p", "alerta");

    contenedorAviso.classList.add("aviso");
    contenedorAviso.appendChild(textoAviso);
    avisoMedio.before(contenedorAviso);
    return contenedorAviso;
}

// Activo el panel para notificar a los jugadores la activación de las pulsaciones
function cambiarPanel(nodo, aniadirClase, eliminarClase, text) {
    cambiarContenido(nodo, aniadirClase, eliminarClase).innerText = text;
}

function crearElemento(etiqueta, id) {
    let elemento = document.createElement(etiqueta);
    elemento.id = id;
    return elemento;
}

function verPanel(visible) {
    if (visible)
        cambiarContenido(document.getElementById("contenedorAviso"), 'aviso', 'hidden')
    else
        cambiarContenido(document.getElementById("contenedorAviso"), 'hidden', 'aviso')
}

function cambiarContenido(nodo, aniadirClase, eliminarClase) {
    nodo.classList.add(aniadirClase);
    nodo.classList.remove(eliminarClase);
    return nodo;
}

function comienzaLaBatalla() {
    letras = generarJugadorLetra(true);
    activoTeclas();

    // Variable de control de duración de la partida y Variable de control de dificultad
    let segundos = 4;
    let dificultad = 2;

    let dificultadPartida = setInterval(function () {
        letras = generarJugadorLetra(true);
    }, dificultad * 1000)

    let partidaActiva = setInterval(function () {
        console.log(segundos);
        segundos--;
        if (segundos === 0) {
            document.removeEventListener("keyup", detectarTecla)
            verPanel(false);
            finalPartida();
            clearInterval(partidaActiva); // Detiene el setInterval cuando segundos llega a 0
            clearInterval(dificultadPartida); // Detiene el setInterval para refrescar letra cuando llega a 0
        }
    }, 1000);
}

function ponmeLetras(letra1, letra2) {
    ponerLetra(letra1, ".area1");
    ponerLetra(letra2, ".area2");
    return [letra1, letra2];
}

function crearLetra() {
    return String.fromCharCode(crearNumeroLetra() + 97);
}

function ponerLetra(letra, clase) {
    let contenedorLetra = document.querySelector(clase);
    contenedorLetra.innerText = letra;
}

function crearNumeroLetra() {
    return Math.floor(Math.random() * 25);
}

function finalPartida() {
    // Reactivo botones
    activarDesactivarBoton(false);
    // Introduzco resultados
    let ganador = devolverGanador();
    let camposResumen = document.getElementsByClassName("resumen")[0];
    if (ganador === undefined) {
        camposResumen.innerHTML = `<br><p>¡EMPATE!</p>`
    } else {
        ganador.entrenamiento = ganador.entrenamiento + 1
        camposResumen.innerHTML = `<br><p>El ganador es ${ganador.nombre}</p>`
    }

    setTimeout(function () {
        camposResumen.innerHTML = ""
    }, 3000)

    // Reseteo campos
    vaciarCampos();
    vaciarContadores();
}

function devolverGanador() {
    if (Number.parseInt(contador1.innerText) > Number.parseInt(contador2.innerText))
        return dosJugadores[0];
    else if (Number.parseInt(contador1.innerText) < Number.parseInt(contador2.innerText))
        return dosJugadores[1];
}

function vaciarCampos() {
    let jugadores = document.getElementsByClassName("jugadores")[0].children
    for (let i = 0; i < jugadores.length; i++) {
        let miLetra = String.fromCharCode(i + 65)
        jugadores[i].innerHTML = `<h2>Jugador ${miLetra} </h2><p><strong>Nombre:</strong></p><p><strong>Edad:</strong></p><p><strong>Entrenamiento:</strong></p>`
    }
}

function vaciarContadores() {
    contador1.innerText = 0;
    contador2.innerText = 0;
}