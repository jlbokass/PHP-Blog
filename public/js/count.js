$(document).ready(function(e) {

    $('#message').keyup(function() {

        var nombreCaractere = $(this).val().length;

        var nombreMots = jQuery.trim($(this).val()).split(' ').length;
        if($(this).val() === '') {
            nombreMots = 0;
        }

        var msg = ' ' + nombreMots + ' mot(s) | ' + nombreCaractere + ' Caractere(s) / 200';
        $('#compteur').text(msg);
        if (nombreCaractere > 200) { $('#compteur').addClass("mauvais"); } else { $('#compteur').removeClass("mauvais"); }

    })



    $('#message2').keyup(function() {

        var nombreCaractere2 = $(this).val().length;
        var nombreCaractere2 = 200 - nombreCaractere2;

        var nombreMots2 = jQuery.trim($(this).val()).split(' ').length;
        if($(this).val() === '') {
            nombreMots2 = 0;
        }

        var msg2 = ' ' + nombreMots2 + ' mot(s) | ' + nombreCaractere2 + ' Caractere(s) restant';
        $('#compteur2').text(msg2);
        if (nombreCaractere2 < 1) { $('#compteur2').addClass("mauvais"); } else { $('#compteur2').removeClass("mauvais"); }

    })



});