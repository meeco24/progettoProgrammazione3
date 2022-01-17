//VARIABILI DI UTILITY
const baseURL = 'http://localhost:80/server/api/';

//DOM

$(document).ready(() => {

    $("#login-button").click(() => loginAdmin());

});

//RICHIESTE AL SERVER
const loginAdmin = () => $.ajax({
    type: "POST",
    url: baseURL + "login_admin.php",
    data: JSON.stringify({
        admin_name: $("#admin").val(),
        password: $("#password").val()
    }),
    success: loginEffettuato,
    error: errore
});

//FUNZIONI SUCCESS - ERROR

const loginEffettuato = (response) => {
    alert(response.message);
    localStorage.setItem("token", response.jwt);
    window.location = "http://127.0.0.1:5500/site/amministrazione/amministraHome.html"; //reindirizzamento alla home
}


const errore = (error) => {
    alert(error.responseJSON.message);
}

const before = (xhr) => {
    xhr.setRequestHeader("Authorization", token); //inserimento del token tra gli header
}
