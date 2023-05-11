function showContainer() {
  document.getElementById("response-container").style.display = "block";
  document.getElementById("textarea").style.display = "none";
}

function hideContainer() {
  document.getElementById("response-container").style.display = "none";
  document.getElementById("textarea").style.display = "block";
}

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

function handleFiles(files) {
  document.getElementById('fileName').textContent = files[0].name;

  if (files[0].type.startsWith('image/')) {
      const img = document.createElement('img');
      img.src = URL.createObjectURL(files[0]);
      img.onload = function() {
          URL.revokeObjectURL(this.src);
          img.style.maxWidth = '200px';
          img.style.maxHeight = '200px';
          document.getElementById('text').appendChild(img);
      }
      const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.removedNodes.length > 0 && mutation.removedNodes[0] === img) {
                document.getElementById('fileName').textContent = '';
            }
        });
      });
      observer.observe(document.getElementById('textArea'), { childList: true });
  }
}