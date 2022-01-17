//VARIABILI DI UTILITY
const token = window.localStorage.getItem("token");
const baseURL = 'http://localhost:80/server/api/';
var url = new URL(window.location.href);
var id = url.searchParams.get("id");
var giornata = 1;
var id_competizione = url.searchParams.get("competizione");

if(!token){
    alert("Utente non autorizzato!");
    window.location.href = "http://127.0.0.1:5500/site/login/login.html";
}

//DOM
$(document).ready ( () => {

    getClassificaGiornata();
    getClassificaGenerale();

    $("#lookup-giornate").change(() => {
        $("#giornaliera").empty();
        giornata = $("#lookup-giornate :selected").val()
        getClassificaGiornata();
    });

});

//RICHIESTE AL SERVER

const getClassificaGiornata = () => $.ajax({

    type : 'GET',
    url : baseURL + 'competizione/classifica.php',
    data : {
        competizione : id,
        giornata : giornata
    },
    success : appendClassificaGiornaliera,
    error : errore,
    beforeSend : before

});

const getClassificaGenerale = () => $.ajax({

    type : 'GET',
    url : baseURL + 'competizione/classifica.php',
    data : {
        competizione : id
    },
    success : appendClassificaGenerale,
    error : errore,
    beforeSend : before

});


//SUCCESS - ERROR - BEFORE

const appendClassificaGenerale = (response) => {
    console.log(response);
        let i = 1;
    response.forEach(elem => {
        document.querySelector("#generale").insertRow().innerHTML = (Mustache.render(classifica.classificaGenerale, elem));
        document.querySelector("#generale #posizione-"+elem.squadra).innerHTML = i;
        i++;
    });
}

const appendClassificaGiornaliera = (response) => {
    console.log(response);
    let i = 1;
    response.forEach(elem => {
        document.querySelector("#giornaliera").insertRow().innerHTML = (Mustache.render(classifica.classificaGenerale, elem));
        document.querySelector("#giornaliera #posizione-"+elem.squadra).innerHTML = i;
        i++;
    });
} 

const errore = (error) => {
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}