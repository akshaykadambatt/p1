window.onload = ()=>{
    loading();
    xhttp = new XMLHttpRequest;
    xhttp.open("POST",`/getPosts`);
    // xhttp.open("POST",`/getPosts?id=${param}`);
    
    xhttp.setRequestHeader('X-CSRF-TOKEN', document.getElementById('_token').value);
    xhttp.setRequestHeader('Accept', 'application/json');
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('num=5');
    xhttp.onload = (data) => {
        populate(data.target.response);
    };
    stoploading();
    document.querySelector('#createPost').addEventListener('submit',(e)=>{
        e.preventDefault();
        postSubmit(e.target);
    });
    setInterval(() => {
        checkForNewPosts();
    }, 1117000);
};
function displaySpinner(el){
     document.querySelector(el+' .spinLoader').classList.add('spinLoader-visible');
     document.querySelector(el).classList.add('button-with-spinLoader');
}
function hideSpinner(el){
    document.querySelector(el).classList.remove('button-with-spinLoader');
    setTimeout(() => {
        document.querySelector(el+' .spinLoader').classList.remove('spinLoader-visible');
    }, 10);
}
function populate(res){
    document.querySelector('.one').insertAdjacentHTML('beforeend',res);
    // document.querySelector('.one').prepend(res);
    var last = document.querySelectorAll('.one .post');
    last[last.length-1].style.marginBottom ='70px';
}
function populateAtTop(res){
    document.querySelector('.user-wall-head').insertAdjacentHTML('afterend',res);
    // document.querySelector('.one').prepend(res);
    var last = document.querySelectorAll('.one .post');
    last[last.length-1].style.marginBottom ='70px';
}
var loadLock = 0;
function loading(){
    loadLock = 1;
    document.querySelector('#navfooter-backdrop').classList.add('navfooter-backdrop');
    setTimeout(() => {
        loadLock = 0
    }, 3000);
}
function stoploading(){
    var interval = setInterval(() => {
        if (loadLock == 0) {
            document.querySelector('#navfooter-backdrop').classList.remove('navfooter-backdrop');
            clearInterval(interval);
        }
    }, 1000);
    
}
function checkForNewPosts(){
    xhttp = new XMLHttpRequest;
    xhttp.open("POST",`/getNewPosts`);
    // xhttp.open("POST",`/getPosts?id=${param}`);
    
    xhttp.setRequestHeader('X-CSRF-TOKEN', document.getElementById('_token').value);
    xhttp.setRequestHeader('Accept', 'application/json');
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('num=1');
    xhttp.onload = (data) => {
        console.log(data.target.response);
        populateAtTop(data.target.response);
    };
}

window.showThis = (next, e) => {
    // history.pushState( { 
    //     plate_id: 1, 
    //     plate: "Burger" 
    //   }, null, "/"+e.target.dataset.name);
    var curr = parseInt(document.querySelector('.navfooter .active').dataset.order);
    var currName = '.container.'+document.querySelector('.navfooter .active').dataset.name;
    var currNavName = '.navfooter .'+document.querySelector('.navfooter .active').dataset.name;
    var nextName = '.container.'+e.target.dataset.name;
    var nextNavName = '.navfooter .'+e.target.dataset.name;
    var tabcurr = document.querySelector(currName);
    var tabnex = document.querySelector(nextName);
    // console.log((-curr+next)*100);
    tabcurr.style.transform = `translatex(${((curr-next)*100)}px)`;
    tabcurr.style.transition = `all .1s`;
    tabcurr.style.height = `0`;
    tabnex.style.height = `auto`;
    tabnex.style.transition = `all .741s`;
    tabnex.style.transform = `translatex(0px)`;
    document.querySelector(currNavName).classList.remove('active');
    tabcurr.classList.remove('active');
    document.querySelector(nextNavName).classList.add('active');
    tabnex.classList.add('active');
}
window.postSubmit = (fdata)=>{
    loading();
    const formData = new FormData(fdata);
    displaySpinner('.create-post .post-submit');
    console.log(...formData);
    xhttp = new XMLHttpRequest;
    xhttp.open("POST","/storeTextPost");
    xhttp.setRequestHeader('X-CSRF-TOKEN', document.getElementById('_token').value);
    xhttp.setRequestHeader('Accept','application/json');
    xhttp.send(formData);
    xhttp.onload = (data) => {
        hideSpinner('.create-post .post-submit');
        console.log(data.target); 
        setTimeout(() => {
            document.querySelector('.navfooter .one').click();
            checkForNewPosts();
            stoploading();
        }, 1000);
    }
    
}

window.action = (action,e) => {
    elToUpdate = e.currentTarget;
    fetch("/postAction", {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.getElementById('_token').value
        },
        body: JSON.stringify({post:e.currentTarget.parentNode.dataset.id,action:action})
    }).then(response => response.json())
    .then(data => {
        console.log(data);
        elToUpdate.parentNode.querySelector('.like-count').innerText = data.like;
        elToUpdate.parentNode.querySelector('.dislike-count').innerText = data.dislike;
        if(data.liked==true){
            elToUpdate.classList.add("activated");
            console.log(elToUpdate.parentNode.querySelector('.dislike-count').parentNode.classList.remove('activated'));
        }else if(data.liked==false){
            console.log(elToUpdate.parentNode.querySelector('.like-count').parentNode.classList.remove('activated'));
        }
        if(data.disliked==true){
            console.log(elToUpdate.parentNode.querySelector('.like-count').parentNode.classList.remove('activated'));
            elToUpdate.classList.add("activated");
        }else if(data.disliked==false){
            console.log(elToUpdate.parentNode.querySelector('.dislike-count').parentNode.classList.remove('activated'));
        }
        if(data.plussed==1){
            elToUpdate.classList.add("activated");
            console.log(elToUpdate.classList);
        }else if(data.plussed==0) {
            elToUpdate.classList.remove("activated");
        }
    });
}

window.openPost = (action,e) => {
    console.log(action);
    console.log(e.currentTarget.parentNode);
    document.querySelector('.open-inner').classList.add('visible');
    document.querySelector('.open-inner').style.zIndex= 1;

}