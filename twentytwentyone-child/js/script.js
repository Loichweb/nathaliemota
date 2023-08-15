// Get the modal
var modal = document.getElementById("myModal");

// Get the link that opens the modal (by its href attribute)
// var contactLink = document.querySelector('a[href="http://localhost:10029/contact/"]');
var contactLink = document.querySelector("#menu-item-36").firstChild ;

var menu = document.querySelector(".primary-menu-container"); 

// Get the link contact mobile
var contactLinkMobile = document.getElementById("menu-item-36"); 

// When the user clicks the link, open the modal
if (contactLink) {
  contactLink.onclick = function(event) {
    event.preventDefault(); // Prevent the default link behavior
    modal.style.display = "block";
  };
}

// When the user clicks the mobile contact link, open the modal
if (contactLinkMobile) {
  contactLinkMobile.onclick = function(event) {
    event.preventDefault();
    modal.style.display = "block";
    menu.style.display = "none"; // Hide the menu
  };
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    menu.style.display = "block"; // Show the menu

  }
}
