/* PAGINATION INFINIE */

jQuery(function($){
    $('#load-more-photos').on('click', function() {
        var button = $(this);
        var page = button.data('page');
        var ajaxurl = button.data('ajaxurl');

        console.log('Page actuelle : ' + page);

        $.ajax({
            url : ajaxurl,
            type : 'post',
            data : {
                page : page,
                action : 'load_more_photos'
            },
            error : function(response){
                console.log('Erreur AJAX :', response);
            },
            success: function (response) {
                console.log('Réponse AJAX :', response);
                if (response) {
                    // Ajoutez le contenu de la réponse à la fin de votre conteneur d'images
                    $('#load-more-container').append(response);
                    // Incrémente le numéro de page pour la prochaine requête
                    var newPage = page + 1; // Incrémentation de la page
                    button.data('page', newPage); // Met à jour la valeur de data-page
                } else {
                    // Masquez le bouton si vous avez chargé toutes les images
                    button.hide();
                    console.log('Toutes les images ont été chargées.');
                }
            }
        });
    });
});


/* FILTRES AJAX */

jQuery(document).ready(function($) {
    $('#cat-select').on('change', function () {
      console.log("Catégorie sélectionnée : " + $('#cat-select').val()); // Déboguer la catégorie sélectionnée
      $.ajax({
        type: 'POST',
        url: 'wp-admin/admin-ajax.php',
        dataType: 'html',
        data: {
          action: 'filtre',
          category: $('#cat-select').val(),
          post_format: $('#form-select').val(),
          post_ordre: $('#tri-select').val(),
        },
        success: function (res) {
          console.log("Réponse AJAX : ", res); // Déboguer la réponse AJAX
          $('#photosapp').html(res); // Mettez à jour la section .photoblock
        }
      });
    });
  
    $('#form-select').on('change', function () {
      console.log("Format sélectionné : " + $('#form-select').val()); // Déboguer le format sélectionné
      $.ajax({
        type: 'POST',
        url: 'wp-admin/admin-ajax.php',
        dataType: 'html',
        data: {
          action: 'filtre',
          post_format: $('#form-select').val(),
          category: $('#cat-select').val(),
          post_ordre: $('#tri-select').val(),
        },
        success: function (res) {
          console.log("Réponse AJAX : ", res); // Déboguer la réponse AJAX
          $('#photosapp').html(res); // Mettez à jour la section .photoblock
        }
      });
    });
  
    $('#tri-select').on('change', function () {
      console.log("Tri sélectionné : " + $('#tri-select').val()); // Déboguer le tri sélectionné
      $.ajax({
        type: 'POST',
        url: 'wp-admin/admin-ajax.php',
        dataType: 'html',
        data: {
          action: 'filtre',
          post_ordre: $('#tri-select').val(),
          category: $('#cat-select').val(),
          post_format: $('#form-select').val(),
        },
        success: function (res) {
          console.log("Réponse AJAX : ", res); // Déboguer la réponse AJAX
          $('#photosapp').html(res); // Mettez à jour la section .photoblock
        }
      });
    });
  });
  