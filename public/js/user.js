/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/user.js ***!
  \******************************/
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

window.onload = function () {
  xhttp = new XMLHttpRequest();
  xhttp.open("POST", "/getPosts"); // xhttp.open("POST",`/getPosts?id=${param}`);

  xhttp.setRequestHeader('X-CSRF-TOKEN', document.getElementById('_token').value);
  xhttp.setRequestHeader('Accept', 'application/json');
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send('num=5');

  xhttp.onload = function (data) {
    populate(data.target.response);
  };

  document.querySelector('#createPost').addEventListener('submit', function (e) {
    e.preventDefault();
    postSubmit(e.target);
  });
  setInterval(function () {
    checkForNewPosts();
  }, 7000);
};

function displaySpinner(el) {
  document.querySelector(el + ' .spinLoader').classList.add('spinLoader-visible');
  document.querySelector(el).classList.add('button-with-spinLoader');
}

function hideSpinner(el) {
  document.querySelector(el).classList.remove('button-with-spinLoader');
  setTimeout(function () {
    document.querySelector(el + ' .spinLoader').classList.remove('spinLoader-visible');
  }, 10);
}

function populate(res) {
  document.querySelector('.one').insertAdjacentHTML('afterbegin', res); // document.querySelector('.one').prepend(res);

  var last = document.querySelectorAll('.one .post');
  last[last.length - 1].style.marginBottom = '70px';
}

function checkForNewPosts() {
  xhttp = new XMLHttpRequest();
  xhttp.open("POST", "/getNewPosts"); // xhttp.open("POST",`/getPosts?id=${param}`);

  xhttp.setRequestHeader('X-CSRF-TOKEN', document.getElementById('_token').value);
  xhttp.setRequestHeader('Accept', 'application/json');
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send('num=1');

  xhttp.onload = function (data) {
    console.log(data.target.response);
    populate(data.target.response);
  };
}

window.showThis = function (next, e) {
  var curr = parseInt(document.querySelector('.navfooter .active').dataset.order);
  var currName = '.container.' + document.querySelector('.navfooter .active').dataset.name;
  var currNavName = '.navfooter .' + document.querySelector('.navfooter .active').dataset.name;
  var nextName = '.container.' + e.target.dataset.name;
  var nextNavName = '.navfooter .' + e.target.dataset.name;
  var tabcurr = document.querySelector(currName);
  var tabnex = document.querySelector(nextName); // console.log((-curr+next)*100);

  tabcurr.style.transform = "translatex(".concat((curr - next) * 100, "px)");
  tabcurr.style.transition = "all .1s";
  tabcurr.style.height = "0";
  tabnex.style.height = "auto";
  tabnex.style.transition = "all .741s";
  tabnex.style.transform = "translatex(0px)";
  document.querySelector(currNavName).classList.remove('active');
  tabcurr.classList.remove('active');
  document.querySelector(nextNavName).classList.add('active');
  tabnex.classList.add('active');
};

window.postSubmit = function (fdata) {
  var _console;

  var formData = new FormData(fdata);
  displaySpinner('.create-post .post-submit');

  (_console = console).log.apply(_console, _toConsumableArray(formData));

  xhttp = new XMLHttpRequest();
  xhttp.open("POST", "/storeTextPost");
  xhttp.setRequestHeader('X-CSRF-TOKEN', document.getElementById('_token').value);
  xhttp.setRequestHeader('Accept', 'application/json');
  xhttp.send(formData);

  xhttp.onload = function (data) {
    hideSpinner('.create-post .post-submit');
    console.log(data.target);
    setTimeout(function () {
      document.querySelector('.navfooter .one').click();
      checkForNewPosts();
    }, 1000);
  };
};
/******/ })()
;