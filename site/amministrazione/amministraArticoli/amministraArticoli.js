// VARIABILI DI UTILITY
const token = window.localStorage.getItem("token");
const baseURL = 'http://localhost:80/server/api/';
var url = new URL(window.location.href);
var id_articolo = url.searchParams.get("id");
var tipologia = url.searchParams.get("tipologia");

if(!token) window.location.href = "http://127.0.0.1:5500/site/login.html";


// DOM 
$(document).ready ( () => {

        getArticoli();

        $("#crea-articolo").click(() => {
            window.open("http://127.0.0.1:5500/site/amministrazione/amministraArticoli/addArticolo.html", "aggiungi articolo", "width=1000, height=1500");
        });
        

});


// RICHIESTE AL SERVER
const getArticoli = () => $.ajax({
    type: "GET",
    url: baseURL + "articolo/articolo.php",
    data: {
        pageSize : 5
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

const deleteArticolo = (id) => $.ajax({

    type: "DELETE",
    url: baseURL + "articolo/articolo.php/" + id,
    success: eliminaArticolo,
    error: errore,
    beforeSend: before

});


// FUNZIONI SUCCESS - ERROR - BEFORE

const appendArticoli = (response) => {
    console.log(response);
    response.forEach(elem => {
        // elem.link = window.location.href.split("?")[0] + "?id=" + elem.id_articolo;
        $("#lista-articoli").append(Mustache.render(articoli.articoloTemplateADMN, elem));
        $("#"+elem.id_articolo+"-ud-buttons").append(Mustache.render(articoli.updateButton, elem));
        $("#"+elem.id_articolo+"-ud-buttons").append(Mustache.render(articoli.deleteButton, elem));

        $("#aggiorna-articolo-"+elem.id_articolo).click( () =>{
            window.open("http://127.0.0.1:5500/site/amministrazione/amministraArticoli/updateArticolo.html?id="+elem.id_articolo, "update articolo", "width=1000, height=1500");
        });

        $("#elimina-articolo-"+elem.id_articolo).click( () => deleteArticolo(elem.id_articolo));

    });

}

const eliminaArticolo = () => {

    alert("Articolo eliminato!");
    location.reload();

}

const errore = (error) => {
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}