require('./bootstrap');

window.onload=function(){
    document.getElementById("loginbtn").addEventListener("submit", e => {
        e.preventDefault();
        const formData = new FormData(document.querySelector('form'));
        console.log(...formData);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if
        }

    })  
};