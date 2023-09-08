(function ($) {
  $(document).ready(function () {
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the link that opens the modal (by its href attribute)
    var contactLink = $("#menu-item-36").children().first();

    var btnContact = $(".btn-contact");

    var menu = $(".primary-menu-container");

    // Get the link contact mobile
    var contactLinkMobile = $("#menu-item-36");

    // Function to get the current photo ID from the <p> element
    function getCurrentPhotoId() {
      // Get all <p> elements on the page
      var paragraphs = $("p");

      // Iterate through the <p> elements
      for (var i = 0; i < paragraphs.length; i++) {
        var paragraph = $(paragraphs[i]);
        // Check if the paragraph contains the text "Référence :"
        if (paragraph.text().includes('Référence :')) {
          // Extract the reference part and trim any whitespace
          var reference = paragraph.text().replace('Référence :', '').trim();
          return reference;
        }
      }

      return "";
    }

    // When the user clicks the link, open the modal
    if (contactLink.length > 0) {
      contactLink.click(function (event) {
        event.preventDefault();
        modal.style.display = "block";
      });
    }

    // When the user clicks the btnContact, open the modal
    if (btnContact.length > 0) {
      btnContact.click(function (event) {
        event.preventDefault();

        var currentPhotoId = getCurrentPhotoId();
        var refPhotoInput = $("#refPhotoInput");

        if (refPhotoInput.length > 0 && currentPhotoId) {
          refPhotoInput.val(currentPhotoId);
        }
        modal.style.display = "block";
      });
    }

    // When the user clicks the mobile contact link, open the modal
    if (contactLinkMobile.length > 0) {
      contactLinkMobile.click(function (event) {
        event.preventDefault();
        modal.style.display = "block";
        menu.hide(); // Hide the menu
      });
    }

    // When the user clicks anywhere outside of the modal, close it
    $(window).click(function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
        menu.show(); // Show the menu
      }
    });
  });
})(jQuery);
