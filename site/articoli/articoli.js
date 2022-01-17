// VARIABILI DI UTILITY
const token = window.localStorage.getItem("token");
const baseURL = 'http://localhost:80/server/api/';
var url = new URL(window.location.href);
var id = url.searchParams.get("id");
var tipologia = parseInt(url.searchParams.get("tipologia"));

if(!token){
    alert("Utente non autorizzato!");
    window.location.href = "http://127.0.0.1:5500/site/login/login.html";
}

$(document).ready ( () => {
        if(id != null)
        {
            getArticolo();
        }
        else
        {
            switch (tipologia) {
                case 1:
                    getAllArticoli(1);
                    break;
                case 2:
                    getAllArticoli(2);
                    break;
                case 3:
                    getAllArticoli(3);
                    break;
                default:
                    getAllArticoli();
                    break;
            }
        }
    }
);

//  RICHIESTE AL SERVER

const getAllArticoli = (tipologia = null) => $.ajax({
    type: "GET",
    url: baseURL + "articolo/articolo.php",
    data: {
        tipologia: tipologia
    },
    success: appendArticoli,
    error: errore,
    beforeSend: before
});

const getArticolo = () => $.ajax({
    type: "GET",
    url: baseURL + "articolo/articolo.php/" + id,
    success: appendArticolo,
    error: errore,
    beforeSend: before
});

// FUNZIONI SUCCESS - ERROR - BEFORE

const appendArticoli = (response) => {
    console.log(response);
    response.forEach(elem => {
        elem.link = window.location.href.split("?")[0] + "?id=" + elem.id_articolo;
        $("#lista-articoli").append(Mustache.render(articoli.articoloTemplate, elem));
    });
}

const appendArticolo = (response) => {
    console.log(response);
    $("#lista-articoli").append(Mustache.render(articoli.articoloTemplate, response));
    document.querySelector("p").classList.remove("contenuto");
}

const errore = (error) => {
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}