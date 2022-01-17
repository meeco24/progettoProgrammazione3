
const baseURL = 'http://localhost:80/server/api/';

$(document).ready ( () => {

    $('#loginForm').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        message: {
            email : {
                required: "Inserire un'email",
                email: "Inserire un'email valida"
            },
            password: {
                required: "Inserire una password",
                minlength: "La password inserita deve contenere minimo 5 caratteri"
            }
        },
        wrapper: "div",
        errorClass: "errors",
        errorPlacement: (error,element)=>{
            error.insertAfter(element);
        },
        submitHandler: (form, event) => {

            event.preventDefault();

            //metto i valori degli input field nelle variabili 
            email_value = $('[name = email]').val();
            pass_value = $('[name = password]').val();

            //costruisco l'oggetto data contenente i valori recuperati dagli input field
            let data = {
                email:email_value,
                passwd:pass_value
            }

            //faccio la richiesta asincorna al server inviando i dati precedentemente recuperati e impacchettati nell'oggetto data
            $.ajax({ 
                    type:'POST',
                    url:baseURL + "login.php",                    
                    crossDomain: true,
                    data:JSON.stringify(data),
                    contentType:"application/json",
                    success: (response) => {
                        localStorage.setItem("token", response.jwt); //conservare il token
                        window.location = "http://127.0.0.1:5500/site/home/home.html"; //reindirizzamento a una nuova pagina
                    },
                    error: (error) =>{
                        alert(error.responseJSON.message); //gestione dell'errore
                    }
                })
        }
    });
})

