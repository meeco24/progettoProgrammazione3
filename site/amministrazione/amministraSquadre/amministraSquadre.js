//VARIABILI DI UTILITY
const token = window.localStorage.getItem("token");
const baseURL = 'http://localhost:80/server/api/';
const id_giocatore = localStorage.getItem("presidente");

if(!token){
    alert("Utente non autorizzato!");
    window.location.href = "http://127.0.0.1:5500/site/login/admin_login.html";
}

//DOM

$(document).ready ( () => {

    getSquadreGiocatore();

});

//RICHIESTE AL SERVER

const getSquadreGiocatore = () => $.ajax({
    type: "GET",
    url: baseURL + "competizione/iscrizione.php",
    data: {
        id_giocatore: id_giocatore
    },
    success: appendSquadre,
    error: errore,
    beforeSend : before
});

const deleteSquadra = (id_giocatore) => $.ajax({

    type: "DELETE",
    url: baseURL + "squadra/squadra.php/" + id_giocatore,
    success: squadraEliminata,
    error: errore,
    beforeSend: before

});

//FUNZIONI SUCCESS - ERROR - BEFORE

const appendSquadre = (response) => {
    console.log(response);

    response.forEach(elem => {
        document.querySelector("#squadre").insertRow().innerHTML = (Mustache.render(giocatore.squadreGiocatore, elem));
        $("#elimina-"+elem.id_squadra).click(() => deleteSquadra(elem.id_squadra));
    });

}

const squadraEliminata = (response) => {
    alert(response.message);
    location.reload();
}

const errore = (error) => {
    console.log(error)
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token) //inserimento del token tra gli header
}