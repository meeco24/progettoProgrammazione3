const token = window.localStorage.getItem("token");
const baseURL = 'http://localhost:80/server/api/';

if(!token){
    alert("Utente non autorizzato!");
    window.location.href = "http://127.0.0.1:5500/site/login/login.html";
}

$(document).ready ( () => {

            getClubs();
            getSchedeTecniche({nominativo: null});

            $("#search-button").click(() => {
                $("#card-list").empty();
                getSchedeTecniche({nominativo: $("#search-bar").val()});
            });

            $("#ruoli").change(() => {
                $("#card-list").empty();
                getSchedeTecniche({ruolo: $("#ruoli").val()});
            });

            $("#club").change(() => {
                $("#card-list").empty();
                getSchedeTecniche({club: $("#club").val()});
            });

            $("#filtri").change(() => {
                $("#card-list").empty();
                getSchedeTecniche({filtro: $("#filtri").val()});
            });

            $("#remove-filters").click(() => location.reload());

        });


// RICHIESTE AL SERVER

const getSchedeTecniche = ({nominativo = null, ruolo = null, club = null, filtro = null}) => $.ajax({

    type: "GET",
    url: baseURL + "scheda_tecnica/scheda_tecnica.php",
    data: {
        nominativo : nominativo,
        ruolo : ruolo,
        club : club,
        filtro: filtro
    },
    success: appendSchedeTecniche,
    error: errore,
    beforeSend: before
});

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

const getClubs = () => $.ajax({
    type: "GET",
    url: baseURL + "club/club.php",
    success: appendClub,
    error: errore,
    beforeSend: before
});

// FUNZIONI SUCCESS - ERROR - BEFORE

const appendSchedeTecniche = (response) => {
    console.log(response);
    response.forEach(elem => {        
        $("#card-list").append(Mustache.render(schede.schedaTemplate, elem));
        getMedie(elem.calciatore); //chiamata per recuperare le medie del calciatore
    });
}

const appendMedie = (response) => {

    response[0].media_voto = parseFloat(response[0].media_voto).toFixed(2);
    response[1].media_fantavoto = parseFloat(response[1].media_fantavoto).toFixed(2);

    $("#"+response[0].calciatore).prepend(Mustache.render(home.media, response[0]));
    $("#"+response[1].calciatore).prepend(Mustache.render(home.fantamedia, response[1]));

}

const appendClub = (response) => {
    response.forEach(elem => {
        $("#club").append(Mustache.render(schede.club, elem));
    });
}

const errore = (error) => {
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}