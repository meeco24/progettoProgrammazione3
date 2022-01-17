//VARIABILI DI UTILITY
const baseURL = 'http://localhost:80/server/api/';
const token = window.localStorage.getItem("token");
var url = new URL(window.location.href);
var id_competizione = url.searchParams.get("id");
var id_squadra = localStorage.getItem("id_squadra"); //agiorato da checkIscrizione()
var giornata = localStorage.getItem("giornata"); //aggiornato da getGiornata()

//se il token non è valido il giocatore verrà reindirizzato alla pagina di login
if(!token){
    alert("Utente non autorizzato!");
    window.location.href = "http://127.0.0.1:5500/site/login/login.html";
}

//DOM

$(document).ready ( () => {

    checkIscrizione();
    getGiornata();
    getCompetizione();
    getFormazione()

});

// RICHIESTE AL SERVER

//richiesta per recuperare una specifica competizione utilizzando l'id
const getCompetizione = () => $.ajax({
    type: "GET",
    url: baseURL + "competizione/competizione.php/" + id_competizione,
    success: appendCompetizione,
    error: errore,
    beforeSend: before
});

//richiesta per verificare che un utente sia iscritto o meno alla competizione
const checkIscrizione = () => $.ajax({
    type: "GET",
    url: baseURL + "competizione/iscrizione.php/" + id_competizione,
    success: appendMercato,
    error: appendIscrizione,
    beforeSend: before
});

//richiesta per creare una nuova squadra per l'utente nella competizione specificata
const nuovaIscrizione = () => $.ajax({
    type: "POST",
    url: baseURL + "competizione/iscrizione.php",
    data: JSON.stringify({
        nome : $("#nome-squadra").val(),
        competizione: id_competizione
    }),
    contentType:"application/json",
    success: squadraIscritta,
    error: errore,
    beforeSend: before
});

//richiesta per recuperare la giornata attuale
const getGiornata = () => $.ajax({
    type: "GET",
    url: baseURL + "giornata/giornata.php",
    success: setGiornata,
    error: errore,
    beforeSend: before
});

//richiesta per recuperare la formazione schierata per le giornata attuale
const getFormazione = (success) => $.ajax({
    type: "GET",
    url: baseURL + "formazione/formazione.php",
    data: {
        squadra : id_squadra,
        giornata : giornata
    },
    success: success,
    error: errore,
    beforeSend: before
});

// FUNZIONI SUCCESS - ERROR - BEFORE

const appendCompetizione = (response) => {

    $("#nome-competizione")[0].innerHTML = response.nome_competizione;
    $("#info-competizione").append(Mustache.render(competizione.competizioneInfo, response));
    $("#classifica").append(Mustache.render(competizione.classificaLink, response));
    localStorage.setItem("budget", response.budget);

}

//funzione che fa visualizzare un form di registrazione per la nuova squadra o il link al mercato a seconda se il giocatore è registrato o meno alla competizione
const appendMercato = (response) => {

    console.log(response)

        $("#mercato").append(Mustache.render(competizione.mercato, response.squadra));
        localStorage.setItem("id_squadra", response.squadra.id_squadra);
        $("#bottone-mercato").click(() => window.location.href = "http://127.0.0.1:5500/site/mercato/mercato.html?id="+id_competizione);
        $("#bottone-classifica").click(() => location.href = "http://127.0.0.1:5500/site/classifica/classifica.html?id="+id_competizione);
        getFormazione(appendFormazione);

}

const appendIscrizione = () => {

    $("#mercato").append(competizione.iscrizione);
    $("#right").remove();
    $("#bottone-classifica").remove();

    $("#iscriviti").click(nuovaIscrizione);

}

const squadraIscritta = (response) => {

    alert(response.message);
    location.reload();
}

const appendFormazione = (response) => {

    console.log(response);

    if(response.hasOwnProperty('schierata')){
        document.getElementById("right").textContent = response.message;
        return
    }

    let sum = 0;

    $("#right").append(Mustache.render(formazione.formazioneTemplate));

    response.forEach(elem => {

        switch (parseInt(elem.ruolo)) {

            case 1:
                if (elem.schierato == 0)
                {
                    document.getElementById("panchina").insertRow().innerHTML = (Mustache.render(formazione.giocatoreSchierato, elem));
                } else {
                    document.getElementById("portieri").insertRow().innerHTML = (Mustache.render(formazione.giocatoreSchierato, elem));
                }

                break;            
                
            case 2 :
                if (elem.schierato == 0)
                {
                    document.getElementById("panchina").insertRow().innerHTML = (Mustache.render(formazione.giocatoreSchierato, elem));
                } else {
                    document.getElementById("difensori").insertRow().innerHTML = (Mustache.render(formazione.giocatoreSchierato, elem));
                }

                break;            
                
            case 3 :
                if (elem.schierato == 0)
                {
                    document.getElementById("panchina").insertRow().innerHTML = (Mustache.render(formazione.giocatoreSchierato, elem));
                } else {
                    document.getElementById("centrocampisti").insertRow().innerHTML = (Mustache.render(formazione.giocatoreSchierato, elem));
                }
                
                break;            
                
            case 4 :
                if (elem.schierato == 0) 
                {
                    document.getElementById("panchina").insertRow().innerHTML = (Mustache.render(formazione.giocatoreSchierato, elem));
                } else {
                    document.getElementById("attaccanti").insertRow().innerHTML = (Mustache.render(formazione.giocatoreSchierato, elem));
                }
                
                break;
        
            default:
                break;

        }

    });

    calcoloPunteggio(response);
}

const calcoloPunteggio = (formazione) => {

    if(formazione.schierata != undefined) return;

    let sum = 0;

    for (let prop in formazione) {
        if(formazione[prop].schierato == 1 && formazione[prop].fantavoto == null) {
            document.querySelector("#panchina ."+formazione[prop].descrizione).style = "color: coral";
            sum += parseFloat(document.querySelector("#panchina ."+formazione[prop].descrizione).textContent == '' ? 0 : document.querySelector("#panchina ."+formazione[prop].descrizione).textContent);
        } else if (formazione[prop].schierato == 1 && formazione[prop].fantavoto != null) {
            sum += parseFloat(formazione[prop].fantavoto);
        }
    }

    document.querySelector("#totale").innerHTML = sum;
    document.querySelector("#totale").style = "color: green";

}

const setGiornata = (response) => {
    localStorage.setItem("giornata", response.id_giornata);
    console.log(response);

    document.querySelector("#giornata-display").append(Mustache.render(competizione.giornata, response));
}

const errore = (error) => {
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}