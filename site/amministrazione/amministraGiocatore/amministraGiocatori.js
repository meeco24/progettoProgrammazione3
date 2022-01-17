//VARIABILI DI UTILITY
const token = window.localStorage.getItem("token");
const baseURL = 'http://localhost:80/server/api/';

if(!token){
    alert("Utente non autorizzato!");
    window.location.href = "http://127.0.0.1:5500/site/login/admin_login.html";
}


//DOM
$(document).ready ( () => {

    getAllGiocatori();

    $("#search-button").click(() => {
        $("#giocatori").empty();
        getAllGiocatori($("#search-bar").val());
    });

});


//RICHIESTE AL SERVER
const getAllGiocatori = (nickname=null) => $.ajax({

    type: "GET",
    url: baseURL + "giocatore/giocatore.php",
    data: {
        pageSize: 10,
        nickname: nickname
    },
    success: appendGiocatori,
    error: errore,
    beforeSend: before
});

const deleteGiocatore = (id_giocatore) => $.ajax({

    type: "DELETE",
    url: baseURL + "giocatore/giocatore.php/" + id_giocatore,
    success: giocatoreEliminato,
    error: errore,
    beforeSend: before

});


// FUNZIONE SUCESS - ERROR - BEFORE
const appendGiocatori = (response) => {
    console.log(response);
    response.forEach(elem => {
        document.querySelector("#giocatori").insertRow().innerHTML = (Mustache.render(giocatore.giocatoreTemp, elem));
        $("#elimina-"+elem.id_giocatore).click(() => deleteGiocatore($("#elimina-"+elem.id_giocatore).val()));
        $("#squadre-"+elem.id_giocatore).click(() => {
            localStorage.setItem("presidente", elem.id_giocatore);
            window.open("http://127.0.0.1:5500/site/amministrazione/amministraSquadre/amministraSquadre.html", "squadre presidente", "width=1000, height=1500");
        });
    });

}

const giocatoreEliminato = (response) => {
    alert(response.message);
    location.reload();
}

const errore = (error) => {
    console.log(error)
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}