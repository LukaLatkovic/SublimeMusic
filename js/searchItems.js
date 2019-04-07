// AJAX ZA SEARCH

$(function () {

    var resContainer = $(".shop");

    // promeljiva resContainer, preko jquery-ja uzimamo element sa klasom shop.

    $('form').on('input change',function (e) {

        // gleda formu, odnosno gleda da li se nesto promenilo ( tipa neko kliknuo nesto na tastaturi, odnosno setovao nesto u selectu ili kako vec )
        // Kad se tako nesto desi pokrece funkciju. e je event koji se desio, e.preventDefault() ce spreciti formu da posalje podatke negde, odnosno default akciju.


        var value = $(this).serialize();   // Value promeljiva je serializovana vrednost inputa, odnosno pretvorene u string

        // Saljemo ajax
        $.ajax({

            url: "includes/search.inc.php", // url kom saljemo
            data: value,                    // podatke koje saljemo, odnosno string value
            method: "post",                 // metoda je post
            success: function(data){        // Ako je uspelo, vraca data, a mi pokrecmeo funkciju koja radi nesto sa tim data. Data ce u ovom slucaju biti sta god je u echo, ili var dump na urlu gde smo posalali

                if ( data == "" ) {                 // Ako ne vrati nista, znaci ne postoji ni jedan prozivod, pa u resContainer ( element sa klasom shop ) upisujemo tekst koji pise dole funkcijom .html

                    console.log(data);
                    resContainer.html("Nismo pronasli ni jedan proizvod!");

                } else {

                    resContainer.html(data);    // Ako je nasao nesto, upisuje to sto smo echo-vali u search.inc.php

                }
            }

        });

        e.preventDefault();         // napisao sam gore sta ovo radi

    });

});