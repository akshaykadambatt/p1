require('./bootstrap');

window.onload=function(){
    document.getElementById("loginbtn").addEventListener("submit", e => {
        e.preventDefault();
        const formData = new FormData(document.querySelector('#loginbtn'));
        console.log(...formData);
        var _token = document.getElementById('_token').value;
        formData.append("_token", _token);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            console.log(this.responseText);
        }
        xhttp.open("POST", "/login");
        xhttp.send(formData);

    });  
    document.getElementById("registerbtn").addEventListener("submit", e => {
        e.preventDefault();
        const formData = new FormData(document.querySelector('#registerbtn'));
        console.log(...formData);
        var _token = document.getElementById('_token').value;
        formData.append("_token", _token);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            console.log(this.responseText);
        }
        xhttp.open("POST", "/register");
        xhttp.send(formData);

    });
};