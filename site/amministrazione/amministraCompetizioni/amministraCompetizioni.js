//VARIABILI DI UTILITY
const token = window.localStorage.getItem("token");
const baseURL = 'http://localhost:80/server/api/';

//se il token non è valido il giocatore verrà reindirizzato alla schermata di login
if(!token) window.location.href = "http://127.0.0.1:5500/site/login/admin_login.html";

//DOM

$(document).ready ( () => {

        $("#crea-competizione-form").hide();

        $("#competizione-form-toggle").click( () =>  $("#crea-competizione-form").toggle());

        $("#crea-competizione-button").click( () => {

            if($("#nome_competizione").val() == "" || $("#prezzo_iscrizione").val() == "" || $("#max_iscritti").val() == "" || $("#budget").val() == "" || $("#data_termine").val() == ""){
                alert("Attenzione, tutti i campi sono necessari alla creazione di una nuova competizione, controlla di non averne lasciato nessuno vuoto!");
            } else {
                creaCompetizione($("#nome_competizione").val(), $("#prezzo_iscrizione").val(), $("#max_iscritti").val(), $("#budget").val(), moment($("#data_termine").val()).format("YYYY-MM-DD HH:mm:ss"));
            }
        });

        getAllCompetizioni({nome_competizione : null, filtro : null});

        $("#search-button").click(() => {

            $("#lista-competizioni").empty();
            getAllCompetizioni({nome_competizione: $("#search-bar").val()});

        });

        $("#filtri").change(() => {

            $("#lista-competizioni").empty();
            getAllCompetizioni({filtro: $("#filtri").val(),});

        });

});

//RICHIESTE

//richiesta per recuperare tutte le competizioni
const getAllCompetizioni = ({nome_competizione=null, filtro=null}) => $.ajax({

    type: "GET",
    url: baseURL + "competizione/competizione.php",
    data: {
        pageSize : 5,
        nome_competizione : nome_competizione,
        filtro: filtro
    },
    success: appendCompetizioni,
    error: errore,
    beforeSend: before

});

const creaCompetizione = (nome_competizione, prezzo_iscrizione, max_iscritti, budget, data_termine) => $.ajax({

    type: "POST",
    url: baseURL + "competizione/competizione.php",
    data: JSON.stringify({
        nome_competizione: nome_competizione,
        prezzo_iscrizione: prezzo_iscrizione,
        max_iscritti: max_iscritti,
        budget: budget,
        data_termine: data_termine
        }),
        success: competizioneSuccess,
        errore: errore,
        beforeSend: before

});

const eliminaCompetizione = (id_competizione) => $.ajax({

    type: "DELETE",
    url: baseURL + "competizione/competizione.php/" + id_competizione,
    success: competizioneSuccess,
    error: errore,
    beforeSend: before

});

//FUNZIONI SUCCESS

//funzione che inserisce le competizioni recuperate con getAllCompetizioni() nella pagina 
const appendCompetizioni = (response) => {
    // console.log(response);
    response.forEach(elem => {
        $("#lista-competizioni").append(Mustache.render(competizioni.competizioneAmm, elem));
        $("#"+elem.id_competizione).append(Mustache.render(competizioni.eliminaCompetizioneButton, elem));
        $("#elimina-competizione-"+elem.id_competizione).click(() => eliminaCompetizione(elem.id_competizione));        
    });
}

const competizioneSuccess = (response) => {
    alert(response.message);
    location.reload();
}

const errore = (error) => {
    console.log(error);
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}