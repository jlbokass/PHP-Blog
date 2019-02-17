$(document).ready(function(e) {

    $('#message').keyup(function() {

        var nombreCaractere = $(this).val().length;

        var nombreMots = jQuery.trim($(this).val()).split(' ').length;
        if($(this).val() === '') {
            nombreMots = 0;
        }

        var msg = ' ' + nombreMots + ' mot(s) | ' + nombreCaractere + ' Caractere(s) / 255';
        $('#compteur').text(msg);
        if (nombreCaractere > 255) { $('#compteur').addClass("tooMuchCharacters"); } else { $('#compteur').removeClass("tooMuchCharacters"); }

    })

});