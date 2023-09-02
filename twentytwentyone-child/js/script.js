// Get the modal
var modal = document.getElementById("myModal");

// Get the link that opens the modal (by its href attribute)
var contactLink = document.querySelector("#menu-item-36").firstChild;

var btnContact = document.querySelector(".btn-contact");

var menu = document.querySelector(".primary-menu-container");


// Get the link contact mobile
var contactLinkMobile = document.getElementById("menu-item-36");

// Function to get the current photo ID from the <p> element
function getCurrentPhotoId() {
  // Get all <p> elements on the page
  var paragraphs = document.querySelectorAll('p');

  // Iterate through the <p> elements
  for (var i = 0; i < paragraphs.length; i++) {
    var paragraph = paragraphs[i];
    // Check if the paragraph contains the text "Référence :"
    if (paragraph.textContent.includes('Référence :')) {
      // Extract the reference part and trim any whitespace
      var reference = paragraph.textContent.replace('Référence :', '').trim();
      return reference;
    }
  }

  return "";
}
// When the user clicks the link, open the modal
if (contactLink) {
  contactLink.onclick = function (event) {
    event.preventDefault();
    modal.style.display = "block";
  };
}

// When the user clicks the btnContact, open the modal
if (btnContact) {
  btnContact.onclick = function (event) {
    event.preventDefault();

    var currentPhotoId = getCurrentPhotoId();
    var refPhotoInput = document.getElementById("refPhotoInput");

    if (refPhotoInput && currentPhotoId) {
      refPhotoInput.value = currentPhotoId;
    }
    modal.style.display = "block";
  };
}

// When the user clicks the mobile contact link, open the modal
if (contactLinkMobile) {
  contactLinkMobile.onclick = function (event) {
    event.preventDefault();
    modal.style.display = "block";
    menu.style.display = "none"; // Hide the menu
  };
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
    menu.style.display = "block"; // Show the menu
  }
};
