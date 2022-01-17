const baseURL = 'http://localhost:80/server/api/';

$(document).ready( () => {

    $("#signinForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            },

            password_confirm: {
                required: true,
                minlength: 5,
                equalTo: "[name = password]"
            },

            nickname: {
                required: true,
                minlength: 5
            },

            email_paypal: {
                required: true,
                email: true
            }
        },

        message: {
            email : {
                required: "Please provide an email",
                email: "Please provide a valid email"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password should be at least 5 characters long"
            },
            password_confirm : {
                required: "Please provide a password",
                minlength: "Your password should be at least 5 characters long",
                equalTo: "Passwords doesn't match"
            },
            nickname : {
                required: "Please provide a nickname",
                minlength: "Your nickname should be at least 5 characters long"
            },
            email_paypal : {
                required: "Please provide an email",
                email: "Please provide a valid email"
            }
        },

        wrapper: "div",

        errorClass: "errors",

        errorPlacement: (error,element)=>{
            error.insertAfter(element);
        },

        submitHandler: (form, event) => {

            event.preventDefault();

            email_value = $('[name = email]').val();    
            password_value = $('[name = password]').val();    
            nickname_value = $('[name = nickname]').val();    
            email_paypal_value = $('[name = email_paypal]').val();
            
            let data = {

                email : email_value,
                passwd : password_value,
                nickname : nickname_value,
                email_paypal : email_paypal_value

            }

            $.ajax({ 
                type:'POST',
                crossDomain: true,
                data:JSON.stringify(data),
                url:baseURL + "giocatore/giocatore.php",
                contentType:"application/json",
                success: (response)=>{
                    // console.log(response)
                    window.localStorage.setItem("token", response.jwt); //conservare il token
                    alert("Iscrizione avvenuta con successo! Verrai reindirizzato alla pagina di Login");
                    window.location.href = "http://127.0.0.1:5500/site/login/login.html"; //reindirizzamento a una nuova pagina
                },
                error: (error) =>{
                    alert(error.responseJSON.message);
                }
            })
        }
    })


});