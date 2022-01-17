//VARIABILI DI UTILITY
const token = window.localStorage.getItem("token");
var url = new URL(window.location.href);
var id_calciatore = url.searchParams.get("id");
const baseURL = 'http://localhost:80/server/api/';


// if(!token) window.location.href = "http://127.0.0.1:5500/site/login.html";

//DOM
$(document).ready(() => {

    getAllClubs();

    getCalciatore();

    $("#update-calciatore").click(() => {

        updateCalciatore(id_calciatore, $("#nominativo").val(), $("#prezzo").val(), $("#ruolo").val(), $("#club").val());

    });

});

//RICHIESTE AL SERVER

const getCalciatore = () => $.ajax({

    type: "GET",
    url: baseURL + "calciatore/calciatore.php/" + id_calciatore,
    success: appendCalciatore,
    error: errore,
    beforeSend: before

});

const updateCalciatore = (id_calciatore, nominativo=null, prezzo=null, ruolo=null, club=null) => $.ajax({

    type: "PUT",
    url: baseURL + "calciatore/calciatore.php/" + id_calciatore,
    crossDomain: true,
    data: JSON.stringify({
        nominativo: nominativo,
        prezzo: prezzo,
        ruolo: ruolo,
        club: club
    }),
    success: calciatoreAggiornato,
    error: errore,
    beforeSend: before

});

const getAllClubs = () => $.ajax({

    type: "GET",
    crossDomain: true,
    url: baseURL + "club/club.php",
    success: appendClub,
    error: errore,
    beforeSend: before

});


// FUNZIONI SUCCESS - ERROR - BEFORE

const appendCalciatore = (response) => {

    console.log(response);

    document.getElementById("nominativo").value = response.nominativo;
    document.getElementById("prezzo").value = response.prezzo;
    document.getElementById("ruolo").value = response.ruolo;
    document.getElementById("club").value = response.club;


}

const appendClub = (response) => {
    response.forEach(elem => {
        $("#club").append(Mustache.render(calciatore.clubTemplate, elem));   
    });
}

const calciatoreAggiornato = () => {

    alert("Calciatore aggiornato!");
    window.close();

}

const errore = (error) => {
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}