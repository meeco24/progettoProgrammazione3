# FantaRoyale

Questa repository contiene i file che costituiscono l'applicazione suddivisi in directory:
- site: directory contenente i file relativi al front-end divise per "pagine", ciscuna contenente i relativi file HTML, CSS, e JavaScript
- server: directory contenente i file relativi al back-end suddivisa a sua volta in 3 directory:
    * models: contente i "modelli" delle risorse REST
    * config: contenete file di configurazione come la classe che gestisce la connessione al database
    * api: organizzate in directory contenenti la rootAPI e le crudAPI disponibili
- libs: contenente le librerie di supporto
- images: contenente varie immagini utilizzate per lo styling dell'app
- docs: contente il dump del database e una documentazione più approfondita sul prcesso di sviluppo dell'app

Inoltre per far funzionare il server in locale è necessario sostituire la stringa che è assegnata alla variabile "$baseProjectURL" nel file "documentRoot.php", con la path della documentRoot di Apache (che deve coincidere con la path della directory del progetto).

## Dati per utilizzare l'app
Account giocatore: 
- email -> giuseppe@hotmail.com password -> giuseppe
- email -> giacomo@gmail.com password -> giacomo
- email -> giovanna22@gmail.com -> giovanna

Account amministratore:
- username -> Domenico password -> 12345
