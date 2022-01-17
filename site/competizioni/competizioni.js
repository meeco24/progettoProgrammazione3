//VARIABILI DI UTILITY
const token = window.localStorage.getItem("token");
const baseURL = 'http://localhost:80/server/api/';

//se il token non è valido il giocatore verrà reindirizzato alla schermata di login
if(!token){
    alert("Utente non autorizzato!");
    window.location.href = "http://127.0.0.1:5500/site/login/login.html";
}

//DOM

$(document).ready ( () => {

        getAllCompetizioni({nome_competizione : null, filtro : null});

        $("#search-button").click(() => {

            $("#lista-competizioni").empty();
            getAllCompetizioni({nome_competizione: $("#search-bar").val()});

        });

        $("#filtri").change(() => {

            $("#lista-competizioni").empty();
            getAllCompetizioni({filtro: $("#filtri").val(),});

        });

        $("#rimuovi-filtri").click(() => {
            location.reload();
        });

});

//RICHIESTE

//richiesta per recuperare tutte le competizioni
const getAllCompetizioni = ({nome_competizione=null, filtro=null}) => $.ajax({

    type: "GET",
    url: baseURL + "competizione/competizione.php",
    data: {
        pageSize : 5,
        nome_competizione : nome_competizione,
        filtro: filtro
    },
    success: appendCompetizioni,
    error: errore,
    beforeSend: before

});

//FUNZIONI SUCCESS

//funzione che inserisce le competizioni recuperate con getAllCompetizioni() nella pagina 
const appendCompetizioni = (response) => {
    // console.log(response);
    response.forEach(elem => {     
        elem.link = window.location.href.split("?")[0] + "?id=" + elem.id_competizione;
        elem.data_creazione = elem.data_creazione.slice(0,10); //TODO: aggiustare con moment.js
        elem.data_termine = elem.data_termine.slice(0,10); //TODO: aggiustare con moment.js
        $("#lista-competizioni").append(Mustache.render(competizioni.competizioneTemp, elem));
    });
}

const errore = (error) => {
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}