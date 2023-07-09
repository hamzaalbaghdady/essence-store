// for select cover image
function handleImageSelection(radioButton) {
  var imageDiv = radioButton.parentNode;

  // Remove the 'selected' class from all image divs
  var allImageDivs = document.querySelectorAll(".radio-image");
  for (var i = 0; i < allImageDivs.length; i++) {
    allImageDivs[i].classList.remove("selected");
  }

  // Add the 'selected' class to the image div containing the selected radio button
  imageDiv.classList.add("selected");
}

// ********************
// for get selected categories
function handleItemSelection() {
  var selectElement = document.getElementById("item-select");
  var selectedOptions = selectElement.selectedOptions;

  var badgeContainer = document.getElementById("badge-container");

  // Clear previous badges
  badgeContainer.innerHTML = "";

  for (var i = 0; i < selectedOptions.length; i++) {
    var selectedOption = selectedOptions[i];
    var selectedValue = selectedOption.title;

    var badge = createBadge(selectedValue);

    badgeContainer.appendChild(badge);
  }
}
// create badge for selected categories
function createBadge(value) {
  var badge = document.createElement("span");
  badge.className = "badge badge-primary";

  var badgeText = document.createElement("span");
  badgeText.textContent = value;
  badge.appendChild(badgeText);

  var badgeClose = document.createElement("span");
  badgeClose.className = "badge-close";
  badgeClose.innerHTML = "&times;";
  badge.appendChild(badgeClose);

  badgeClose.addEventListener("click", function () {
    var selectElement = document.getElementById("item-select");
    var optionToRemove = selectElement.querySelector(
      'option[value="' + value + '"]'
    );

    badge.remove();

    if (optionToRemove) {
      optionToRemove.selected = false;
    }
  });

  return badge;
}

// for get selected colors
function handleColorsSelection() {
  var selectElement = document.getElementById("colors");
  var selectedOptions = selectElement.selectedOptions;

  var badgeContainer = document.getElementById("colors-container");

  // Clear previous badges
  badgeContainer.innerHTML = "";

  for (var i = 0; i < selectedOptions.length; i++) {
    var selectedOption = selectedOptions[i];
    var selectedValue = selectedOption.value;

    var color = createColor(selectedValue);

    badgeContainer.appendChild(color);
  }
}
// create badges for selected colors
function createColor(value) {
  var badge = document.createElement("span");
  badge.className = "color badge badge-primary";
  badge.style.backgroundColor = value;

  var badgeText = document.createElement("span");
  badgeText.textContent = "";
  badge.appendChild(badgeText);

  return badge;
}

// handle the file input
function handleFileSelect(event) {
  var fileInput = event.target;
  var files = fileInput.files;

  var imageContainer = document.getElementById("image-container");
  //
  var label = document.createElement("label");
  label.textContent = "Choose the cover image";
  imageContainer.appendChild(label);
  imageContainer.appendChild(document.createElement("br"));
  //

  for (let i = 0; i < files.length; i++) {
    var file = files[i];

    var reader = new FileReader();
    reader.onload = (function (file) {
      return function (e) {
        var imageUrl = e.target.result;

        var radioImageDiv = document.createElement("div");
        radioImageDiv.className = "radio-image";

        var imageElement = document.createElement("img");
        imageElement.src = imageUrl;
        imageElement.alt = file.name; // Access the image name file.name

        var radioButton = document.createElement("input");
        radioButton.type = "radio";
        radioButton.name = "cover";
        radioButton.value = file.name;
        radioButton.onchange = function () {
          handleImageSelection(this);
        };

        radioImageDiv.appendChild(imageElement);
        radioImageDiv.appendChild(radioButton);

        imageContainer.appendChild(radioImageDiv);
      };
    })(file);

    reader.readAsDataURL(file);
  }
}

var fileInput = document.getElementById("file-input");
fileInput.addEventListener("change", handleFileSelect);
