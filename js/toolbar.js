const fileInput = document.getElementById("fileInput");
const fileName = document.getElementById("fileName");
const text = document.getElementById("text");
const body = document.getElementById("body");
const photo = document.getElementById("photo");

function makeBold() {
  document.execCommand('bold', false, null);
}

function changeFontSize() {
  let fontSize = document.querySelector('#font-size').value;
  document.execCommand('fontSize', false, fontSize);
}

function changeFontFamily() {
  let fontFamily = document.querySelector('#font-family').value;
  document.execCommand('fontName', false, fontFamily);
}

let boldButton = document.querySelector('#bold-button');
boldButton.addEventListener('click', makeBold);

let fontSizeSelect = document.querySelector('#font-size');
fontSizeSelect.addEventListener('change', changeFontSize);

let fontFamilySelect = document.querySelector('#font-family');
fontFamilySelect.addEventListener('change', changeFontFamily);

function alignText(alignment) {
  text.style.textAlign = alignment;
}

        fileInput.addEventListener('change', () => {
            fileName.textContent = fileInput.files[0].name;

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.createElement('img');
                    // img.style.maxHeight = "65%";
                    // img.style.maxWidth = "65%";
                    img.src = e.target.result;
                    text.appendChild(img);
                }
                reader.readAsDataURL(fileInput.files[0]);
            }
        });

        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.removedNodes.length > 0 && mutation.removedNodes[0].nodeName === 'IMG') {
                    fileName.textContent = '';
                }
            });
        });

        observer.observe(text, { childList: true });

      function getContent() {
        // var images = temp.querySelectorAll("img");
        // images.forEach(function(image) {
        //   image.parentNode.removeChild(image);
        // });
        body.value = text.innerHTML;
      }
