const wrapper = document.querySelector('.wrapper');
const btnPopup = document.querySelector('.btnLogin-popup');
const btnClose = document.querySelector('.icon-close');

const openForm = () => {
  wrapper.style.transform = 'scale(1)';
}
btnPopup.addEventListener('click', openForm);

const closeFormBtnClose = () => {
  wrapper.style.transform = 'scale(0)';
}
btnClose.addEventListener('click', closeFormBtnClose);