window.onload = ()=>{
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
    document.querySelector('#createPost').addEventListener('submit',(e)=>{
        e.preventDefault();
        postSubmit(e.target);
    });
    setInterval(() => {
        checkForNewPosts();
    }, 7000);
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
    document.querySelector('.one').insertAdjacentHTML('afterbegin',res);
    // document.querySelector('.one').prepend(res);
    var last = document.querySelectorAll('.one .post');
    last[last.length-1].style.marginBottom ='70px';
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
        populate(data.target.response);
    };
}
window.showThis = (next, e) => {
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
        }, 1000);
    }
}
