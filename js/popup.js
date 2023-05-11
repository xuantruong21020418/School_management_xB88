var wrapper = document.querySelector('.wrapper');
var btnPopup = document.querySelector('.btnLogin-popup');
var btnClose = document.querySelector('.icon-close');

var openForm = () => {
  wrapper.style.transform = 'scale(1)';
}
btnPopup.addEventListener('click', openForm);

var closeFormBtnClose = () => {
  wrapper.style.transform = 'scale(0)';
}
btnClose.addEventListener('click', closeFormBtnClose);