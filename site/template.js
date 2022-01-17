const home = {

    articolo :
    `
    <div class="articolo d-flex" style="position: relative;">
        <h3 class="titolo-articolo"><a href="http://127.0.0.1:5500/site/articoli/articoli.html?id={{id_articolo}}">{{titolo}}</a></h3>
        <div class="immagine"><img src="" style="width: 100%; height="100%"></div>
        <h4 style="position: absolute; bottom: 10px; left: 10px;"><a href="http://127.0.0.1:5500/site/articoli/articoli.html?tipologia={{tipologia}}">più {{descrizione}}</a></h4>
    </div>
    `,
    competizione:
    `
    <div class="competizione card mb-3">
        <div class="card-header"><h3><a href="http://127.0.0.1:5500/site/competizione/competizione.html?id={{competizione}}">{{nome_competizione}}</a></h3></div>
            <div class="card-body">
            <h5>{{nome_squadra}}</h5>
        </div>
    </div>
    `,
    scheda: 
    `
    <div class=" {{ruolo}} col card">
        <div class="card-header container">
            <div class="d-flex row">
                <div class="col align-self-center">{{nominativo}}</div>
                <div class="col" style="height: 50px"><img src="/images/scudetti/{{club}}.png" alt="{{club}}" style="object-fit: contain;"></div>
            </div>
        </div>
        <div  class="card-body">
            <div  class="row" style="margin-top: 20px;">
                <div id="{{calciatore}}" class="contenuto card-text col-8">                            
                    goal: {{goal}}<br>
                    assist: {{assist}}<br>
                </div>

                <div class="col-4"><img src="/images/calciatori/{{nominativo}}.png" alt="{{nominativo}}" style="object-fit: contain;"></div>
            </div>
        </div>
    </div>
    `,
    media:
    `
    media: {{media_voto}}<br>
    `,
    fantamedia:
    `
    fantamedia: {{media_fantavoto}}<br>
    `
}

const articoli = {
    articoloTemplate : 
    `<div class="row container-articolo mb-5">
        <h1><a href="http://127.0.0.1:5500/site/articoli/articoli.html?id={{id_articolo}}">{{titolo}}</a></h1>
        <p class="col-8 contenuto">{{contenuto}}</p>
        <img src="/images/articoli/articolo.jpg" alt="articolo-img" class="col-4" style="object-fit: contain;">
        <div id="info-articolo">
            <span class="tags">{{descrizione}}</span>
            <span class="tags" >{{data_creazione}}</span>
            <span class="tags" >{{admin_name}}</span>
        </div>
        <div id="{{id_articolo}}-ud-buttons" class="d-flex mt-3">
        
        </div>
    </div>
    `,
    articoloTemplateADMN : 
    `<div class="row container-articolo mb-5">
        <h1 style="color: chocolate;">{{titolo}}</h1>
        <p class="col-8 contenuto">{{contenuto}}</p>
        <img src="/images/articoli/articolo.jpg" alt="articolo-img" class="col-4" style="object-fit: contain;">
        <div id="info-articolo">
            <span class="tags">{{descrizione}}</span>
            <span class="tags" >{{data_creazione}}</span>
            <span class="tags" >{{admin_name}}</span>
        </div>
        <div id="{{id_articolo}}-ud-buttons" class="d-flex mt-3">
        
        </div>
    </div>
    `,
    updateButton :
    `
    <button id="aggiorna-articolo-{{id_articolo}}" class="btn btn-block btn-info mr-3">Aggiorna articolo</button>
    `,
    deleteButton : 
    `
    <button id="elimina-articolo-{{id_articolo}}" class="btn btn-block btn-danger ml-3">Elimina articolo</button>
    `
}

const schede = {
    schedaTemplate:
    `
    <div class="scheda m-2">
        <div class="scheda-header d-flex justify-content-between bg-dark">
            <h3 class="align-self-center">{{nominativo}}</h3>
            <img src="/images/scudetti/{{club}}.png" alt="{{club}}" style="object-fit: contain;">
        </div>
        <div class="scheda-body d-flex flex-row justify-content-between {{ruolo}}">
            <div id="{{calciatore}}" class="d-flex flex-column align-self-center">
                <span>goal: {{goal}}</span>
                <span>assist: {{assist}}</span>
                <span>ammonizioni: {{ammonizioni}}</span>
                <span>espulsioni: {{espulsioni}}</span>
                <span>porta inviolata: {{clean_sheet}}</span>
                <span>goal subiti: {{goal_subiti}}</span>
                <span>autogoal: {{autogoal}}</span>
            </div>
            <div class="align-self-center">
                <img src="/images/calciatori/{{nominativo}}.png" alt="{{nominativo}}"  style="object-fit: contain;" width="200" height="200">
            </div>
        </div>
    </div>
    `,
    club:
    `
    <option value="{{nome}}">{{nome}}</option>
    ` 
}

const competizioni = {
    competizioneTemp:
    `
    <div class="card card-scheda">
        <div class="card-header">
            <h3><a href="http://127.0.0.1:5500/site/competizione/competizione.html?id={{id_competizione}}">{{nome_competizione}}</a></h3>
        </div>
        <div id="{{id_competizione}}" class="card-body">
            <p class="card-text">
            prezzo iscrizione: {{prezzo_iscrizione}}<br>
            numero iscritti: {{numero_iscritti}}<br>
            massimo iscritti: {{max_iscritti}}<br>
            budget: {{budget}}<br>
            data creazione: {{data_creazione}}<br>
            data termine: {{data_termine}}<br>
            </p>
        </div>
    </div>
    `,
    competizioneAmm:
    `
    <div class="card card-scheda">
        <div class="card-header">
            <h3>{{nome_competizione}}</h3>
        </div>
        <div id="{{id_competizione}}" class="card-body">
            <p class="card-text">
            prezzo iscrizione: {{prezzo_iscrizione}}<br>
            numero iscritti: {{numero_iscritti}}<br>
            massimo iscritti: {{max_iscritti}}<br>
            budget: {{budget}}<br>
            data creazione: {{data_creazione}}<br>
            data termine: {{data_termine}}<br>
            </p>
        </div>
    </div>
    `,
    eliminaCompetizioneButton : 
    `
    <button id="elimina-competizione-{{id_competizione}}" class="btn btn-outline-light btn-danger">Elimina competizione</button>
    `
}

const competizione = {
    competizioneInfo:
    `
    <div class="info-comp">
        <h4>Info competizione</h4><br>
        partecipanti: {{numero_iscritti}}<br>
        budget: {{budget}}<br>
        inizio competizione: {{data_creazione}}<br>
        fine competizione: {{data_termine}}<br>
    </div>
    `,
    competizioneTemplate :
    `
    <div>
        <h3>{{nome_competizione}}</h3><br>
        <p class="contenuto">
        prezzo iscrizione: {{prezzo_iscrizione}}<br>
        numero iscritti: {{numero_iscritti}}<br>
        massimo iscritti: {{max_iscritti}}<br>
        budget: {{budget}}<br>
        data creazione: {{data_creazione}}<br>
        data termine: {{data_termine}}<br>
        </p>
    </div>
    `,
    mercato :
    `
    <button id="bottone-mercato" type="button" class="btn bottoni">Mercato</button>
    `,
    iscrizione :
    `
    <div id="box-iscrizione">
        <label for="nome">Inserisci il nome della tua squadra per iscriverti a questa competizione:</label><br><br>
        <input type="text" id="nome-squadra" name="nome">
        <button id="iscriviti" type="button">Iscriviti</button>
    </div>
    `,
    classificaLink :
    `
    <a href="http://127.0.0.1:5500/site/classifica/classifica.html?competizione={{id}}">Classifica</a>
    `,
    giornata :
    `giornata {{id_giornata}}`,
}

const formazione = {
    formazioneTemplate :
    `
    <div id="formazione-wrapper">
    <h3>Formazione Titolare</h3>
    <table id="titolari" class="table table-sm table-hover">
        <thead>
            <tr>
                <th>Nome</th>
                <th>voto</th>
                <th>goal</th>
                <th>assist</th>
                <th>ammonizioni</th>
                <th>espulsioni</th>
                <th>autogoal</th>
                <th>rigore sbagliato</th>
                <th>porta inviolata</th>
                <th>goal subiti</th>
                <th>fantavoto</th>
            </tr>
        </thead>
        <tbody id="portieri" class="table-warning"></tbody>
        <tbody id="difensori" class="table-success"></tbody>
        <tbody id="centrocampisti" class="table-primary"></tbody>
        <tbody id="attaccanti" class="table-danger"></tbody>
        <tfoot class="table-secondary">
                <td>Totale</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td id="totale"></td>
        </tfoot>

    </table>

    <h3>Panchina</h3>
    <table id="riserve" class="table table-sm table-hover">
        <thead>
            <tr>
                <th>Nome</th>
                <th>voto</th>
                <th>goal</th>
                <th>assist</th>
                <th>ammonizioni</th>
                <th>espulsioni</th>
                <th>autogoal</th>
                <th>rigore sbagliato</th>
                <th>porta inviolata</th>
                <th>goal subiti</th>
                <th>fantavoto</th>
            </tr>
        </thead>
        <tbody id="panchina" class="table-info"></tbody>
    </table>
    </div>
    `,
    giocatoreSchierato : 
    `
    <td>{{nominativo}}</td>
    <td>{{voto}}</td>
    <td>{{goal}}</td>
    <td>{{assist}}</td>
    <td>{{ammonizioni}}</td>
    <td>{{espulsioni}}</td>
    <td>{{autogoal}}</td>
    <td>{{rigore_sbagliato}}</td>
    <td>{{clean_sheet}}</td>
    <td>{{goal_subiti}}</td>
    <td class="{{descrizione}}">{{fantavoto}}</td>
    `
}

const mercato = {
    calciatoreTemplate :
    `
    <tr id="row-{{nominativo}}">
        <td>{{nominativo}}</td>
        <td>{{prezzo}}</td>
        <td>{{nome}}</td>
        <td id="acquista-{{nominativo}}"> <button class="acquista btn btn-success">acquista</button> </td>
    </tr>
    `,
    calciatoreAcquistatoTemplate :
    `
    <tr id="{{nominativo}}">
        <td>{{nominativo}}</td>
        <td>{{prezzo}}</td>
        <td>{{nome}}</td>
        <td><input type="checkbox" class="{{ruolo}}" name="{{id_calciatore}}" value="1" {{schierato}}></td>
        <td id="vendi-{{nominativo}}"> <button type="button" class="vendi btn btn-danger">vendi</button> </td>
    </tr>
    `,
    budgetCounter :
    `
    <h2 id="budget-display" class="mb-4">Budget: {{budget}}</h2>
    `
}

const classifica = {
    classificaGenerale : 
    `
    <td id="posizione-{{squadra}}"></td>
    <td>{{squadra}}</td>
    <td>{{punteggio}}</td>
    `
}

const calciatore = {
    calciatoreTemplate :
    `
    <div id="card-{{nominativo}}" class="card-calciatore">
    {{nominativo}}, {{nome}}, {{prezzo}} <button id="elimina{{nominativo}}">x</button> <button id="aggiorna{{nominativo}}">up</button>
    </div>
    `,
    calciatoreTemp:
    `
    <tr id="row-{{nominativo}}">
        <td>{{nominativo}}</td>
        <td>{{prezzo}}</td>
        <td>{{nome}}</td>
        <td><button id="elimina-{{nominativo}}" class="acquista btn btn-danger bottoni">elimina</button></td>
        <td><button id="aggiorna-{{nominativo}}" class="acquista btn btn-info bottoni">aggiorna</button></td>
    </tr>
    `,
    clubTemplate:
    ` 
    <option value="{{id_club}}">{{nome}}</option>
    `
}

const valutazione = {
    valutazioneTemp: 
    `
    <tr>
        <td>{{nominativo}}</td>
        <td>{{voto}}</td>
        <td>{{goal}}</td>
        <td>{{assist}}</td>
        <td>{{ammonizioni}}</td>
        <td>{{espulsioni}}</td>
        <td>{{autogoal}}</td>
        <td>{{rigore_sbagliato}}</td>
        <td>{{clean_sheet}}</td>
        <td>{{goal_subiti}}</td>
        <td>{{fantavoto}}</td>
        <td><button id="aggiorna-{{nominativo}}" class="btn btn-info">aggiorna</button></td>
        <td><button id="elimina-{{nominativo}}" class="btn btn-danger">elimina</button></td>
    </tr>
    `,
    updateForm:
    `
    <tr>
    <td>{{nominativo}}</td>
        <td><input id="voto" type="text" value="{{voto}}"></td>
        <td><input id="goal" type="text" value="{{goal}}"></td>
        <td><input id="assist" type="text" value="{{assist}}"></td>
        <td><input id="ammonizioni" type="text" value="{{ammonizioni}}"></td>
        <td><input id="espulsioni" type="text" value="{{espulsioni}}"></td>
        <td><input id="autogoal" type="text" value="{{autogoal}}"></td>
        <td><input id="rigore_sbagliato" type="text" value="{{rigore_sbagliato}}"></td>
        <td><input id="clean_sheet" type="text" value="{{clean_sheet}}"></td>
        <td><input id="goal_subiti" type="text" value="{{goal_subiti}}"></td>
        <td><input id="fantavoto" type="text" value="{{fantavoto}}"></td>
        <td><button id="update-{{nominativo}}" class="btn btn-info">aggiorna</button></td>
        <td></td>
    </tr>
    `,
    calciatori:
    `
    <option value="{{id_calciatore}}">{{nominativo}}</option>
    `
}

const giocatore = {
    giocatoreTemp : 
    `
    <td>{{id_giocatore}}</td>
    <td>{{nickname}}</td>
    <td><button id="squadre-{{id_giocatore}}" class="btn btn-outline-light btn-primary" value="{{id_giocatore}}">get squadre</button></td>
    <td><button id="elimina-{{id_giocatore}}" class="btn btn-outline-light btn-danger" value="{{id_giocatore}}">elimina</button></td>
    `,
    squadreGiocatore :
    `
    <td>{{id_squadra}}</td>
    <td>{{nome_squadra}}</td>
    <td>{{nome_competizione}}</td>
    <td><button id="elimina-{{id_squadra}}" class="btn btn-outline-light btn-danger" value="{{id_squadra}}">elimina</button></td>
    `
}


