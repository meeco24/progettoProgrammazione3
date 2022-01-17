const token = window.localStorage.getItem("token");
const baseURL = 'http://localhost:80/server/api/';

if(!token) window.location.href = "http://127.0.0.1:5500/site/login.html";

//DOM
$(document).ready ( () => {
    getGiocatore();
    getSquadre();

        $("#aggiorna-giocatore").validate(
            {
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        minlength: 5
                    }
                },
                message: {
                    email : {
                        required: "Inserire un'email",
                        email: "Inserire un'email valida"
                    },
                    password: {
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

                    console.log(nickname, email, $("#nickname").val(), $("#email").val());

                    updateGiocatore( nickname == $("#nickname").val() ? "" : $("#nickname").val(),
                                    email == $("#email").val()  ? "" : $("#email").val(),
                                    $("#password").val(),
                                    $("#email_paypal").val());
                }
            }
        )
});

//RICHIESTE AL SERVER

const getSquadre = () => $.ajax({
    type: "GET",
    url: baseURL + "competizione/iscrizione.php",
    success : appendSquadre,
    error: errore,
    beforeSend: before
});

const getGiocatore = () => $.ajax({
    type: "GET",
    url: baseURL + "giocatore/giocatore.php",
    success : appendGiocatore,
    error: errore,
    beforeSend: before
});

const updateGiocatore = (nickname=null, email=null, password=null, email_paypal=null) => $.ajax({
    type: "PUT",
    url: baseURL + "giocatore/giocatore.php",
    data: JSON.stringify({
        nickname: nickname,
        email: email,
        passwd: password,
        email_paypal: email_paypal
    }),
    success: updateSuccess,
    error: errore,
    beforeSend: before
});


//FUNZIONI SUCCESS - ERROR - BEFORE

const appendSquadre = (response) => {
    response.forEach(elem => {
        $("#lista-squadre").append(Mustache.render(home.competizione, elem));
    });
}

const appendGiocatore = (response) => {
    document.getElementById("nick-presidente").innerText += " "+response.nickname;
    document.getElementById("nickname").value = response.nickname;
    nickname = response.nickname;
    document.getElementById("email").value = response.email;
    email = response.email;
    document.getElementById("email_paypal").value = response.email_paypal;
}

const updateSuccess = (response) => {
    alert(response.message);
    location.reload();
}


const errore = (error) => {
    if (error.responseJSON) alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}