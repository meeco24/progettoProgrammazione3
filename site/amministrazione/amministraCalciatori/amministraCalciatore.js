//VARIABILI DI UTILITY
const token = window.localStorage.getItem("token");
const baseURL = 'http://localhost:80/server/api/';

if(!token){
    alert("Utente non autorizzato!");
    window.location.href = "http://127.0.0.1:5500/site/login/login.html";
}


//DOM
$(document).ready ( () => {

        getAllClubs();

        //richiesta per recuperare tutti i portieri
        getAllCalciatori({ruolo : 1});
        $("#toggle-portieri").click(() => {
            $("#tabella-portieri").toggle();
        })
    
        //richiesta per recuperare tutti i difensori
        getAllCalciatori({ruolo : 2});
        $("#tabella-difensori").hide();
        $("#toggle-difensori").click(() => {
            $("#tabella-difensori").toggle();
        })
    
        //richiesta per recuperare tutti i centrocampisti
        getAllCalciatori({ruolo : 3});
        $("#tabella-centrocampisti").hide();
        $("#toggle-centrocampisti").click(() => {
            $("#tabella-centrocampisti").toggle();
        })
    
        //richiesta per recuperare tutti gli attaccanti
        getAllCalciatori({ruolo : 4});
        $("#tabella-attaccanti").hide();
        $("#toggle-attaccanti").click(() => {
            $("#tabella-attaccanti").toggle();
        })

        $("#create-calciatore").click(() => {

            if($("#nominativo").val() == "" || $("#prezzo").val() == "" || $("#ruolo").val() == "" || $("#club").val() == "")
            {
                alert("Compilare ogni campo del form prima di poter aggiungere un nuovo calciatore!");
            } else {
                addCalciatore();
            }
        })

});

//RICHIESTE AL SERVER
const getAllCalciatori = ({nominativo=null, filtro=null, ruolo}) => $.ajax({

    type: "GET",
    url: baseURL + "calciatore/calciatore.php",
    data: {
        pageSize : 10,
        nominativo : nominativo,
        filtro: filtro,
        ruolo : ruolo
    },
    success: appendCalciatori,
    error: errore,
    beforeSend: before

});

const addCalciatore = () => $.ajax({

    type: "POST",
    crossDomain: true,
    url: baseURL + "calciatore/calciatore.php",
    data: JSON.stringify({
        nominativo: $("#nominativo").val(),
        prezzo: $("#prezzo").val(),
        ruolo: $("#ruolo").val(),
        club: $("#club").val()
    }),
    success: calciatoreCreato,
    error: errore,
    beforeSend: before

});

const deleteCalciatore = (id_calciatore) => $.ajax({

    type:"DELETE",
    crossDomain: true,
    url: baseURL + "calciatore/calciatore.php/" + id_calciatore,
    success: calciatoreEliminato,
    error: errore,
    beforeSend: before

});

const getAllClubs = () => $.ajax({

    type: "GET",
    crossDomain: true,
    url: baseURL + "club/club.php",
    success: appendClub,
    error: errore,
    beforeSend: before

});


//FUNZIONI SUCCESS - ERROR - BEFORE
const appendCalciatori = (response) => {

    console.log(response);

    //response = array con tutti i calciatori presenti nella tabella calciatore
    response.forEach(elem => {  

        //creazione della row del calciatore e inserimento nel body della tabella corrispondente al suo ruolo
        document.querySelector("#calciatori-"+elem.ruolo).insertRow().innerHTML = (Mustache.render(calciatore.calciatoreTemp, elem))
        
        // quando si clicca sul pulsante elimina di un calciatore
        $("#elimina-"+elem.nominativo).click(() => {

            //eliminazione del record dal db
            deleteCalciatore(elem.id_calciatore);
            //eliminazione della riga dalla tabella
            $("#row-"+elem.nominativo).remove();

        });

        $("#aggiorna-"+elem.nominativo).click(() => {

            window.open("http://127.0.0.1:5500/site/amministrazione/amministraCalciatori/updateCalciatore.html?id="+elem.id_calciatore, "update calciatore", "width=700, height=600");

        });

    });
}

const appendClub = (response) => {

    response.forEach(elem => {
        $("#club").append(Mustache.render(calciatore.clubTemplate, elem));   
    });

}

const calciatoreCreato = () => {

    alert("Calciatore aggiunto al database con successo!");
    location.reload();
}

const calciatoreEliminato = () => {

    alert("Calciatore eliminato");
    location.reload();

}

const errore = (error) => {
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}