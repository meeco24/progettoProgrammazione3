//VARIABILI DI UTILITY
const baseURL = 'http://localhost:80/server/api/';
var url = new URL(window.location.href);
const token = localStorage.getItem("token");
const budget = localStorage.getItem("budget");
const squadra = localStorage.getItem("id_squadra");
var id_competizione = url.searchParams.get("id");
var giornata = localStorage.getItem("giornata");
var actualBudget = 0;


//se il token non è valido l'utente verrà reindirizzato alla pagina di login
if(!token){
    alert("Utente non autorizzato!");
    window.location.href = "http://127.0.0.1:5500/site/login/login.html";
}


//DOM
$(document).ready ( () => {

    $("#modifica-formazione").hide();

    checkIscrizione();
    getGiornata();

    $("#budget-display")[0].innerHTML = Mustache.render(mercato.budgetCounter, {budget : () => budget - actualBudget})

    getFormazione();

    getAllCalciatori({ruolo : 1, giornata: giornata, squadra: squadra});
    $("#toggle-portieri").click(() => {
        $("#mercato-portieri").toggle();    
        $("#mercato-difensori").hide();
        $("#mercato-centrocampisti").hide();
        $("#mercato-attaccanti").hide();
    });

    getAllCalciatori({ruolo : 2, giornata: giornata, squadra: squadra});
    $("#mercato-difensori").hide();
    $("#toggle-difensori").click(() => {
        $("#mercato-difensori").toggle();
        $("#mercato-portieri").hide();
        $("#mercato-centrocampisti").hide();
        $("#mercato-attaccanti").hide();
    });

    getAllCalciatori({ruolo : 3, giornata: giornata, squadra: squadra});
    $("#mercato-centrocampisti").hide();
    $("#toggle-centrocampisti").click(() => {
        $("#mercato-centrocampisti").toggle();
        $("#mercato-difensori").hide();
        $("#mercato-portieri").hide();
        $("#mercato-attaccanti").hide();
    });

    getAllCalciatori({ruolo : 4, giornata: giornata, squadra: squadra});
    $("#mercato-attaccanti").hide();
    $("#toggle-attaccanti").click(() => {
        $("#mercato-attaccanti").toggle();
        $("#mercato-centrocampisti").hide();
        $("#mercato-difensori").hide();
        $("#mercato-portieri").hide();
    });



    $("#schiera-formazione").click( () => {
        
        let schieramento = {};
        let formazione = {};

        $("input:checkbox").toArray().forEach(elem => {
            formazione[elem.name] = elem.checked ? 1 : 0;
            if(elem.checked) schieramento[elem.className] = (schieramento[elem.className] == undefined ? 1 : schieramento[elem.className]+1);
        });

        console.log(Object.keys(formazione));

        if(Object.keys(formazione).length != 15)
        {
            alert("Acquista 15 giocatori!");
            return;
        }

        if(schieramento["1"] != 1 || schieramento["2"] != 3 || schieramento["3"] != 4 || schieramento["4"] != 3)
        {
            alert("Schiera 1 portiere, 3 difensori, 4 centrocampisti, 3 attaccanti!");
            return;
        }
        console.log(formazione);

        schieraFormazione({squadra : squadra, formazione : formazione, giornata : giornata});

        $("#schiera-formazione").toggle();
        $("#modifica-formazione").toggle();

    });

    $("#modifica-formazione").click( () => {

        eliminaFormazione();
        
        location.reload();

        $("#modifica-formazione").toggle();
        $("#schiera-formazione").toggle();


    });
    

});

//RICHIESTE

//richiesta al server per recuperare tutti i calciatori, differenziandoli per ruolo. Aggiungendo anche nominativo e filtro possiamo fare un ricerca più mirata.
const getAllCalciatori = ({nominativo=null, filtro=null, ruolo, squadra=null,giornata=null}) => $.ajax({

    type: "GET",
    url: baseURL + "calciatore/calciatore.php",
    data: {
        pageSize : 12,
        nominativo : nominativo,
        filtro: filtro,
        ruolo : ruolo,
        squadra : squadra,
        giornata : giornata
    },
    success: appendCalciatori,
    error: errore,
    beforeSend: before

});

//richiesta al server per inserire la formazione di un giocatore
const schieraFormazione = ({squadra, formazione, giornata}) => { 
        
    $.ajax({

        type: "POST",
        crossDomain: true,
        url: baseURL + "formazione/formazione.php",
        data: JSON.stringify({
            squadra : squadra,
            formazione : formazione, 
            giornata : giornata
        }),
        contentType:"application/json",
        success: formazioneSchierata,
        error: errore,
        beforeSend: before

    });}

//recupero della formazione precedentemente inserita, se esiste
const getFormazione = () => $.ajax({

    type: "GET",
    url: baseURL + "formazione/formazione.php",
    data: {
        squadra : squadra,
        giornata : giornata
    },
    success: appendFormazione,
    error: errore,
    beforeSend: before

});

//richiesta al server per eliminare la formazione di un giocatore
const eliminaFormazione = () => $.ajax({

    type: "DELETE",
    url: baseURL + "formazione/formazione.php/" + squadra,
    contentType:"application/json",
    success: () => console.log("Formazione eliminata."),
    error: errore,
    beforeSend: before

});

//richiesta al server per controllare se esiste una squadra del giocatore iscritta a questa competizione
const checkIscrizione = () =>  $.ajax({

    type: "GET",
    url: baseURL + "competizione/iscrizione.php/" + id_competizione,
    success: verifyIscrizione,
    error: errore,
    beforeSend: before

});

const getGiornata = () => $.ajax({
    type: "GET",
    url: baseURL + "giornata/giornata.php",
    success: checkGiornataInCorso,
    error: errore,
    beforeSend: before
});


//FUNZIONI SUCCESS - ERROR - BEFORE

//funzione che inserisce nella tabella i calciatori in base al ruolo e se sono schierati in una formazione o meno
const appendCalciatori = (response) => {
    //response = array con tutti i calciatori presenti nella tabella calciatore
    response.forEach(elem => {
        //creazione della row relativa al calciatore e inserimento nella tabella 
        document.querySelector("#calciatori-"+elem.ruolo).insertRow().innerHTML = (Mustache.render(mercato.calciatoreTemplate, elem));
        //quando si clicca sul pulsante acquista
        $("#acquista-"+elem.nominativo).click(() => {
                //controllo sul numero di giocatori per ruolo
                switch (parseInt(elem.ruolo)) {
                    case 1:
                        if($("#acquistati-"+elem.ruolo).children().length > 1){ 
                            alert("Hai superato il numero di portieri acquistabili");
                            break;
                        } else {
                            if(!calculateBudget(parseInt(elem.prezzo))) break;
                            $("#acquistati-"+elem.ruolo).append(Mustache.render(mercato.calciatoreAcquistatoTemplate, elem));
                            document.querySelector("#acquista-"+elem.nominativo).parentElement.setAttribute("style", "display:none");
                            break;
                        }            
                    case 2:
                    if($("#acquistati-"+elem.ruolo).children().length > 3)
                    {
                        alert("Hai superato il numero di difensori acquistabili");
                        break;
                    } else {
                        if(!calculateBudget(parseInt(elem.prezzo))) break;
                            $("#acquistati-"+elem.ruolo).append(Mustache.render(mercato.calciatoreAcquistatoTemplate, elem));
                            document.querySelector("#acquista-"+elem.nominativo).parentElement.setAttribute("style", "display:none");
                            break;
                    }
                    case 3:
                        if($("#acquistati-"+elem.ruolo).children().length > 4){
                            alert("Hai superato il numero di centrocampisti acquistabili");
                            break;
                        } else {
                            if(!calculateBudget(parseInt(elem.prezzo))) break;
                            $("#acquistati-"+elem.ruolo).append(Mustache.render(mercato.calciatoreAcquistatoTemplate, elem));
                            document.querySelector("#acquista-"+elem.nominativo).parentElement.setAttribute("style", "display:none");
                            break;
                        }
                    case 4:
                        if($("#acquistati-"+elem.ruolo).children().length > 3){
                            alert("Hai superato il numero di attaccanti acquistabili");
                            break;
                        } else {
                            if(!calculateBudget(parseInt(elem.prezzo))) break;
                            $("#acquistati-"+elem.ruolo).append(Mustache.render(mercato.calciatoreAcquistatoTemplate, elem));
                            document.querySelector("#acquista-"+elem.nominativo).parentElement.setAttribute("style", "display:none");
                            break;
                        }
            
                    default:
                        break;
                }
                //quando si clicca sul pulsante vendi
                $("#vendi-"+elem.nominativo).click(() => {
                    //rimozione della riga relativa al calciatore e incremento del budget e ripristino della riga nella lista dei calciatori acquistabili
                    document.querySelector("#vendi-"+elem.nominativo).parentElement.remove();
                    document.querySelector("#acquista-"+elem.nominativo).parentElement.setAttribute("style", "display:table-row");
                    calculateBudget(-1*(elem.prezzo));
                });
        });
    });
}

//controllo sull'iscrizione del giocatore alla competizione
const verifyIscrizione = (response) => {

    if(!response.iscritto){
        alert("Utente non iscritto alla competizione");
        window.location.replace("http://127.0.0.1:5500/site/competizioni/competizioni.html");
    }

}

//funzione che inserisce nella tabella degli acquisti i calciatori acquistati e schierati
const appendFormazione = (response) => {
    //controllo sullo stato della formazione (schierata = 0 / 1)
    if(response.schierata == false) return;
    //toggle dei pulsanti
    $("#schiera-formazione").toggle();
    $("#modifica-formazione").toggle();
    //response = array con tutti i calciatori presenti nella tabella calciatore
    response.forEach(elem => {  

        elem.schierato = elem.schierato == 1 ? "checked" : "";
        calculateBudget(parseInt(elem.prezzo));

        //inserimento di una nuova riga nella tabella dei giocatori acquistabili con i dati del calciatore
        document.querySelector("#calciatori-"+elem.ruolo).insertRow().innerHTML = (Mustache.render(mercato.calciatoreTemplate, elem));

        //controllo sul numero di giocatori per ruolo
        switch (parseInt(elem.ruolo)) {

            case 1:
                $("#acquistati-"+elem.ruolo).append(Mustache.render(mercato.calciatoreAcquistatoTemplate, elem));
                document.querySelector("#acquista-"+elem.nominativo).parentElement.setAttribute("style", "display:none");
                break;

            case 2:
                $("#acquistati-"+elem.ruolo).append(Mustache.render(mercato.calciatoreAcquistatoTemplate, elem));
                document.querySelector("#acquista-"+elem.nominativo).parentElement.setAttribute("style", "display:none");
                break;

            case 3:

                $("#acquistati-"+elem.ruolo).append(Mustache.render(mercato.calciatoreAcquistatoTemplate, elem));
                document.querySelector("#acquista-"+elem.nominativo).parentElement.setAttribute("style", "display:none");
                break;

            case 4:

                $("#acquistati-"+elem.ruolo).append(Mustache.render(mercato.calciatoreAcquistatoTemplate, elem));
                document.querySelector("#acquista-"+elem.nominativo).parentElement.setAttribute("style", "display:none");
                break;

            default:
                break;

        }

        //cosa succede quando si preme il pulsante vendi
        $("#vendi-"+elem.nominativo).click(() => {

            alert("Per poter modificare la formazione, clicca sul pulsante \"Modifica Formazione\" sotto la tabella.")
            alert("Attenzione! La formazione attuale verrà eliminata e sarà necessaio acquistare nuovamente i calciatori desiderati.")

        });
    })
}

//funzione che comunica il successo dell'inserimento della formazione e reindirizza l'utente alla pagine della competizione relativa
const formazioneSchierata = () => {

    alert("Formazione schierata con successo!");
    window.location.href = "http://127.0.0.1:5500/site/competizione/competizione.html?id="+id_competizione;

}

// funzione che controlla se l'utente sta tentaqndo di effettuare l'accesso al mercato con la giornata di campionato in corso
const checkGiornataInCorso =  (response) => {

    localStorage.setItem("giornata", response.id_giornata)

    let inizio = moment(response.inizio_giornata).format("YYYY-MM-DD HH:mm:ss");
    let fine = moment(response.termine_giornata).format("YYYY-MM-DD HH:mm:ss");
    let adesso =  moment().format("YYYY-MM-DD HH:mm:ss");

    if(inizio < adesso && adesso < fine)
    {
        alert("La giornta è già iniziata, non è più possibile accedere al mercato!");
        window.location.href = "http://127.0.0.1:5500/site/competizione/competizione.html?id=" + id_competizione;
    }
}

const errore = (error) => {
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}

//FUNZIONI DI UTILITY

// funzione per controllare che il budget non superi il limite
const calculateBudget = (prezzo) => {
    
    if (actualBudget+prezzo <= budget) 
    {
        console.log(prezzo);
        actualBudget+=prezzo
        $("#budget-display")[0].innerHTML = Mustache.render(mercato.budgetCounter, {budget : () => budget - actualBudget})
        return true;

    } else {
        alert("Budget insufficente!");
        return false;

    }

}