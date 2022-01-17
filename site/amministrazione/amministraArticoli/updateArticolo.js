// VARIABILI DI UTILITY
const token = localStorage.getItem("token");
const baseURL = 'http://localhost:80/server/api/';
var url = new URL(window.location.href);
var id = url.searchParams.get("id");

// DOM

$(document).ready(() => {
    getArticolo();
    $("#aggiorna-articolo").click(updateArticolo);
});

// RICHIESTE AL SERVER

const getArticolo = () => $.ajax({
    type: "GET",
    url: baseURL + "articolo/articolo.php/" + id,
    success: appendArticolo,
    error: errore,
    beforeSend: before
});

const updateArticolo = () => $.ajax({

    type: "PUT",
    // crossDomain: true,
    url: baseURL + "articolo/articolo.php/" + id,
    data: JSON.stringify({

        titolo: $("#titolo").val(),
        contenuto: $("#contenuto").val(),
        tipologia: $("#tipologia").val()

    }),
    success: aggiornaArticolo,
    error: errore,
    beforeSend: before

});

//FUNZIONI SUCCESS - ERROR - BEFORE

const appendArticolo = (response) => {

    console.log(response);

    document.getElementById("titolo").value = response.titolo;
    document.getElementById("contenuto").value = response.contenuto;
    document.getElementById("tipologia").value = response.tipologia;

}

const aggiornaArticolo = (response) => {
    alert(response.message);
    window.close();
}

const errore = (error) => {
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}