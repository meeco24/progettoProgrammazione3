// VARIABILI DI UTILITY
const token = window.localStorage.getItem("token");
const baseURL = 'http://localhost:80/server/api/';

if(!token){
    alert("Accesso non autorizzato");
    window.location.href = "http://127.0.0.1:5500/site/login.html";
}

// DOM 
$(document).ready ( () => {

        $("#crea-articolo").click(() => {
            if($("#titolo").val() == "" || $("#contenuto").val() == "" || $("#tipologia").val() == "")
            {
                alert("Compilare ogni campo del form per aggiungere un nuovo articolo!");
            }else{
                addArticolo($("#titolo").val(), $("#contenuto").val(), $("#tipologia").val());
            }
        });
});


// RICHIESTE AL SERVER
const addArticolo = (titolo, contenuto, tipologia) => $.ajax({

    type: "POST",
    crossDomain: true,
    url: baseURL + "articolo/articolo.php",
    data: JSON.stringify({
        titolo:titolo,
        contenuto: contenuto,
        tipologia: tipologia
    }),
    success: articoloCreato,
    error: errore,
    beforeSend: before

});

// FUNZIONI SUCCESS - ERROR - BEFORE

const articoloCreato = () => {

    alert("Articolo aggiunto con successo al database!");
    window.close();

}

const errore = (error) => {
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}