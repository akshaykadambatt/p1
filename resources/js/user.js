window.onload = ()=>{
    param = 3;
    xhttp = new XMLHttpRequest;
    xhttp.open("POST",`/getPosts?id=${param}`);
    xhttp.setRequestHeader('X-CSRF-TOKEN', document.getElementById('_token').value);
    xhttp.setRequestHeader('Accept', 'application/json');
    xhttp.send('"id": 3');
    xhttp.onload = (data) => {
        populate(data.target.response);
    };
    document.querySelector('#createPost').addEventListener('submit',(e)=>{
        e.preventDefault();
        const formData = new FormData(e.target);
        displaySpinner('.create-post .post-submit');
        console.log(...formData);
        xhttp = new XMLHttpRequest;
        xhttp.open("POST","/storeTextPost");
        xhttp.setRequestHeader('X-CSRF-TOKEN', document.getElementById('_token').value);
        xhttp.setRequestHeader('Accept','application/json');
        xhttp.send();
        xhttp.onload = (data) => {
            console.log(data.target); 
        }

    });
    
};

function displaySpinner(el){
     document.querySelector(el+' .spinLoader').classList.add('spinLoader-visible');
     document.querySelector(el).classList.add('button-with-spinLoader');
     
}

function populate(res){
    document.querySelector('.one').innerHTML+=JSON.parse(res);
    document.querySelector('.one').innerHTML+=JSON.parse(res);
    document.querySelector('.one').innerHTML+=JSON.parse(res);
    document.querySelector('.one').innerHTML+=JSON.parse(res);
    document.querySelector('.one').innerHTML+=JSON.parse(res);
    document.querySelector('.one').innerHTML+=JSON.parse(res);
    document.querySelector('.one').innerHTML+=JSON.parse(res);
    document.querySelector('.one').innerHTML+=JSON.parse(res);
    document.querySelector('.one').innerHTML+=JSON.parse(res);
}

window.showThis = (next, e) => {
    var curr = parseInt(document.querySelector('.navfooter .active').dataset.order);
    var currName = '.container.'+document.querySelector('.navfooter .active').dataset.name;
    var currNavName = '.navfooter .'+document.querySelector('.navfooter .active').dataset.name;
    var nextName = '.container.'+e.target.dataset.name;
    var nextNavName = '.navfooter .'+e.target.dataset.name;
    var tabcurr = document.querySelector(currName);
    var tabnex = document.querySelector(nextName);
    
    console.log((-curr+next)*100);
    console.log(tabnex.style.transform);
    tabcurr.style.transform = `translatex(${((curr-next)*100)}px)`;
    tabcurr.style.transition = `all .1s`;
    tabcurr.style.height = `0`;
    tabnex.style.height = `auto`;
    tabnex.style.transition = `all .41s`;
    tabnex.style.transform = `translatex(0px)`;
    document.querySelector(currNavName).classList.remove('active');
    tabcurr.classList.remove('active');
    document.querySelector(nextNavName).classList.add('active');
    tabnex.classList.add('active');
}

window.postSubmit = ()=>{
    console.log(this);
}