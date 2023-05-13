const fileInput = document.getElementById("fileInput");
const fileName = document.getElementById("fileName");
const text = document.getElementById("text");
const body = document.getElementById("body");
const photo = document.getElementById("photo");

document.getElementById("text").addEventListener("keydown", function(event) {
  if (event.key.length === 1 && !event.ctrlKey && !event.metaKey) {
      var fontSize = document.getElementById("fontSize").value;
      var fontFamily = document.getElementById("fontFamily").value;
      var text = document.getElementById("text");
      var selection = window.getSelection();
      if (selection.rangeCount) {
          var range = selection.getRangeAt(0);
          var span = document.createElement("span");
          span.style.fontSize = fontSize + "px";
          span.style.fontFamily = fontFamily;
          span.textContent = event.key;
          range.insertNode(span);
          range.setStartAfter(span);
          selection.removeAllRanges();
          selection.addRange(range);
          event.preventDefault();
      }
  }
});

function alignText(alignment) {
  document.getElementById("text").style.textAlign = alignment;
}

function formatText(command) {
  document.execCommand(command, false, null);
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
        var temp = document.createElement("div");
        temp.innerHTML = text.innerHTML;
        // var images = temp.querySelectorAll("img");
        // images.forEach(function(image) {
        //   image.parentNode.removeChild(image);
        // });
        body.value = temp.innerHTML;
      }

      // function getFilename() {
      //   var input = document.getElementById("fileInput");
      //   var img = input.files[0];
      //   var imageName = img.name;
      //   photo.value = imageName;
      // }
