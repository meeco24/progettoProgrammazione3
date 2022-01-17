//VARIABILI DI UTILITY
const token = window.localStorage.getItem("token");
const baseURL = 'http://localhost:80/server/api/';


//se il token non è valido il giocatore verrà reindirizzato alla pagina di login
// if(!token) window.location.href = "http://127.0.0.1:5500/site/login.html";

//DOM

$(document).ready ( () => {

    getValutazioni(1);
    $("#giornate").change( () => {
        $("#valutazioni").empty();
        getValutazioni($("#giornate").val());
    });

    $("#crea-articolo").click( () => window.open("http://127.0.0.1:5500/site/amministrazione/amministraVoti/addValutazione.html", "aggiungi valutazione", "width=1500, height=1000"))

});

// RICHIESTE AL SERVER

const getValutazioni = (giornata) => $.ajax({
    type: "GET",
    url: baseURL + "valutazione/valutazione.php",
    data: {
        giornata: giornata
    },
    success: appendValutazioni,
    error: errore,
    beforeSend: before
});

const getValutazione = (giornata, calciatore) => $.ajax({
    type: "GET",
    url: baseURL + "valutazione/valutazione.php",
    data: {
        calciatore: calciatore,
        giornata: giornata
    },
    success: () => console.log("ok"),
    error: errore,
    beforeSend: before
});

const updateValutazione = (giornata, calciatore) => $.ajax({
    type: "PUT",
    url: baseURL + "valutazione/valutazione.php",
    data: JSON.stringify({
        giornata: $("#giornate").val(),
        calciatore: calciatore,
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
    success: valutazioneAggiornata,
    error: errore,
    beforeSend: before
});

const deleteValutazione = (giornata, calciatore) => $.ajax({
    type: "DELETE",
    url: baseURL + "valutazione/valutazione.php",
    data: JSON.stringify({
        giornata: giornata,
        calciatore: calciatore
    }),
    success: valutazioneEliminata,
    error: errore,
    beforeSend: before
});


// FUNZIONI SUCCESS - ERROR - BEFORE

const appendValutazioni = (response) => {

    console.log(response);

    response.forEach(elem => {
        document.querySelector("#valutazioni").insertRow().innerHTML = (Mustache.render(valutazione.valutazioneTemp, elem));

        $("#aggiorna-"+elem.nominativo).click( () => {

            document.querySelector("#aggiorna-"+elem.nominativo).parentElement.parentElement.innerHTML = (Mustache.render(valutazione.updateForm, elem));

            $("#update-"+elem.nominativo).click( () => {
                updateValutazione(elem.giornata, elem.calciatore);
            });

        });

        $("#elimina-"+elem.nominativo).click( () => {
            deleteValutazione(elem.giornata, elem.calciatore);
        });
    });



}

const valutazioneAggiornata = () => {

    console.log(JSON.stringify({
        giornata: 1,
        calciatore: 40,
        voto: $("#voto").val(),
        goal: $("#goal").val(),
        assist: $("#assist").val(),
        ammonizioni: $("#ammonizioni").val(),
        espulsioni: $("#espulsioni").val(),
        autogoal: $("#autogoal").val(),
        rigore_sbagliato: $("#rigore_sbagliato").val(),
        porta_inviolata: $("#porta_inviolata").val(),
        goal_subiti: $("#goal_subiti").val(),
        fantavoto: $("#fantavoto").val()
    }))

    alert("Valutazione aggiornata!");
    location.reload();

}

const valutazioneEliminata = (response) => {
    alert(response.message);
    location.reload();

}

const errore = (error) => {
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}