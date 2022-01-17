const token = window.localStorage.getItem("token");
const baseURL = 'http://localhost:80/server/api/';


if(!token){
    alert("Utente non autorizzato!");
    window.location.href = "http://127.0.0.1:5500/site/login/login.html";
}

$(document).ready( () => {

    getAllArticoli(3); //news
    getAllArticoli(1); //consigli
    getAllArticoli(2); //indisponibili

    getSchedeTecniche("Attaccante"); //attaccante
    getSchedeTecniche("Centrocampista"); //centrocampista
    getSchedeTecniche("Difensore"); //difensore

    getCompetizioniGiocatore(); //competizioni a cui è iscritto il giocatore

    $("#logout").click(() => localStorage.removeItem("token"));
});

// SERVER REQUEST

//richiesta per recuperare tutti gli articoli di una determinata tipologia, se non specificata vengono recuperati tutti
const getAllArticoli = (tipologia=null) => $.ajax({
        type: "GET",
        url: baseURL + "articolo/articolo.php",
        data: {
            pageSize : 1,
            tipologia : tipologia
        },
        success: appendArticoli,
        error: errore,
        beforeSend : before
    });

//richiesta per recuperare utte le competizioni a cui partecipa un giocatore
const getCompetizioniGiocatore = () => $.ajax({
        type: "GET",
        url: baseURL + "competizione/iscrizione.php",
        success: appendCompetizioni,
        error: errore,
        beforeSend : before
    });

//richiesta per recupeare tutte le schede tecniche di un determinato ruolo
const getSchedeTecniche = (ruolo) => $.ajax({
        type: "GET",
        url : baseURL + "scheda_tecnica/scheda_tecnica.php",
        data : {
            pageSize: 3,
            ruolo: ruolo
        },
        success: appendSchedeTecniche,
        error: errore,
        beforeSend : before
    });

//richiesta per recuperare media voto e media fantavoto di un giocatore
const getMedie = (calciatore) => $.ajax({
    type: 'GET',
    url: baseURL + 'valutazione/valutazione.php',
    data:{
        calciatore: calciatore
    },
    success: appendMedie,
    error: errore,
    beforeSend: before
});

// FUNZIONI SUCCESS - ERROR - BEFORE

//recuperati i dati degli articoli dal db, per ciascun elemento, viene inizializzato il template che verrà poi inserito nella pagina
const appendArticoli = (response) => {
    // console.log(response)
    $("#articoli-content").append(Mustache.render(home.articolo, response[0]));
}

//recuperati i dati delle competizioni dal db, per ciascun elemento, viene inizializzato il template che verrà poi inserito nella pagina 
const appendCompetizioni = (response) => {
    response.forEach(elem => {
        $("#competizioni-content").append(Mustache.render(home.competizione, elem));
    });
}

//recuperati i dati delle schede tecniche dal db, per ciascun elemento, viene inizializzato il template che verrà poi inserito nella pagina 
const appendSchedeTecniche = (response) => {
    response.forEach(elem => {
        $("#schede-"+elem.ruolo).append(Mustache.render(home.scheda, elem));
        getMedie(elem.calciatore); //chiamata per recuperare le medie del calciatore
    });
}

//recuperati i dati delle medie dal db, per ciascun elemento, viene inizializzato il template che verrà poi inserito nella pagina 
const appendMedie = (response) => {

    response[0].media_voto = parseFloat(response[0].media_voto).toFixed(2);
    response[1].media_fantavoto = parseFloat(response[1].media_fantavoto).toFixed(2);

    $("#"+response[0].calciatore).prepend(Mustache.render(home.media, response[0]));
    $("#"+response[1].calciatore).prepend(Mustache.render(home.fantamedia, response[1]));

}

const errore = (error) => {
    if (error.responseJSON) alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token) //inserimento del token tra gli header
}