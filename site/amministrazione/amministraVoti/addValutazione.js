// VARIABILI DI UTILITY
const token = window.localStorage.getItem("token");
const baseURL = 'http://localhost:80/server/api/';

// if(!token) window.location.href = "http://127.0.0.1:5500/site/login.html";


// DOM 
$(document).ready ( () => {

    getCalciatori(1);
    getCalciatori(2);
    getCalciatori(3);
    getCalciatori(4);
    $("#aggiungi-valutazione").click(() => {
        // if($("#giornate").val() == "" || $("#calciatori").val() == "" || $("#voto").val() == "" || $("#goal").val() == "" || $("#assist").val() == "" || $("#ammonizioni").val() == "" || $("#espulsioni").val()
        // == "" || $("#autogoal").val() == "" || $("#rigore_sbagliato").val() == "" || $("#clean_sheet").val() == "" || $("#goal_subiti").val() == "" || $("#fantavoto").val())
        // {
        //     alert("Compilare tutti i campi per aggiungere una nuova valutazione!");
        // }else{
        addValutazione();
        // }
    });
});


// RICHIESTE AL SERVER

const addValutazione = () => $.ajax({
    type: "POST",
    url: baseURL + "valutazione/valutazione.php",
    data: JSON.stringify({
        giornata: $("#giornate").val(),
        calciatore: $("#calciatori").val(),
        voto: parseFloat($("#voto").val()),
        goal: $("#goal").val(),
        assist: $("#assist").val(),
        ammonizioni: $("#ammonizioni").val(),
        espulsioni: $("#espulsioni").val(),
        autogoal: $("#autogoal").val(),
        rigore_sbagliato: $("#rigore_sbagliato").val(),
        clean_sheet: $("#clean_sheet").val(),
        goal_subiti: $("#goal_subiti").val(),
        fantavoto: parseFloat($("#fantavoto").val())
    }),
    success: valutazioneAggiunta,
    error: errore,
    beforeSend: before
});

const getCalciatori = (ruolo) => $.ajax({
    type: "GET",
    url: baseURL + "calciatore/calciatore.php",
    data: {
        pageSize: 100,
        ruolo: ruolo
    },
    success: appendCalciatori,
    error: errore,
    beforeSend: before
});

// FUNZIONI SUCCESS - ERROR -  BEFORE

const valutazioneAggiunta = (response) => {

    alert(response.message);
    window.close();

};

const appendCalciatori = (response) => {    
    response.forEach(elem => {
        $("#calciatori").append(Mustache.render(valutazione.calciatori, elem));
    });
};

const errore = (error) => {
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}