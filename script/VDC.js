/////////////////////
//bare de recherche
/////////////////////
$(function () {
    var gameStore = [
        /*"Citadelles",
         "Coloretto",
         "Dobble",
         "Hanabi",
         "Loups-Garou",
         "Love letter",
         "Minivilles",
         "Seigneur des Anneaux",
         "Skull & Roses",
         "Smash up",
         "Aberration",
         "Alvanttid",
         "Apokryph",
         "ARMMME",
         "Barjoland",
         "Chroniques de la Lune Noire",
         "Continuum Time Shadows",
         "Garde-robe, the monstering",
         "Hoshikaze",
         "Inclusion",
         "Jaafir",
         "knight and Wizard",
         "La Saousi: recherches occultes",
         "Palimpseste",
         "7 Wonders",
         "Agricola",
         "Augustus",
         "Andor",
         "Battlestar Galactica",
         "Blake and Mortimer",
         "Carcassonne",
         "Caylus",
         "Cats",
         "Complots",
         "Confusion",
         "Fallout RPG",
         "Ghost Stories",
         "Huit minutes pour une empire",
         "Horreur a Arkham",
         "L'île interdite",
         "King of Tokyo",
         "Koryo",
         "Les Bâtisseurs",
         "Les Chevaliers de la Table Ronde",
         "Mice and Mystics",
         "Ohne Furcht und Adel",
         "Pandémie",
         "Puerto Rico",
         "Robinson Crusoé",
         "Sherlock Holmes",
         "Small World",
         "Splendor",
         "Zombicide"*/
    ];
    $("#autocomplete").autocomplete({
        source: function (request, resolve) {
            $.ajax({
                url: "/backVDC/API.php/Home/getAutocomplete",
                data: {str: request.term},
                success: function (data) {
                    data = JSON.parse(data);
                    gameStore = [];
                    for (var i = 0; i < data.length; i++) {
                        gameStore.push({label: data[i].jeu_nom, realValue: data[i]});
                    }
                    resolve(gameStore);
                }
            });
        },
        // envoie sur la bonne page lors de la saisie du jeu
        select: function (event, ui) {
            console.log(ui);
            switch (ui.item.realValue.jeu_cat) {
                case "jeu de cartes":
                    location.href = "/backVDC/index.php/Jdc#heading" + ui.item.realValue.jeu_id;
                    break;
                case "jeu de societe":
                    location.href = "/backVDC/index.php/Jds#heading" + ui.item.realValue.jeu_id;
                    break;
                case "jeu de role":
                    location.href = "/backVDC/index.php/Jdr#heading" + ui.item.realValue.jeu_id;
                    break;
            }
        }
    });
});

///////////////////////
//remonte ta page
///////////////////////
$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
        $('#back-to-top').tooltip('hide');
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    $('#back-to-top').tooltip('show');

});


$(function () {
    $('#datetimepicker1').datetimepicker({
        language: 'fr-FR'
    });
});

//////////////////////////
//récupérer le mail de souscription à la newsletter
/////////////////////////////
$('#newsSend').click(function () {
    $.ajax({
        type: "POST",
        url: "/backVDC/API.php/Home/createNewsletter",
        dataType: 'text',
        data: {
            news: $('#newsletter').val()
        },
        success: function (data) {
            if (data === "success") {
                formSuccess();
            }
        }
    });
});
//////////////////////////
//envoyé une reservation event
//////////////////////////////
var currentEvent = -1;

$('#eventSend').click(function () {
    var name = $("#eventNom").val().trim();
    if (name.length == 0)
    {
        text = "Es-tu sur de toi ?";
        return;
    }
    var nbr = $('#eventNbr').val().trim();
    if (nbr === 0 || nbr > 10)
    {
        text = "Ton nombre ne passe pas";
        return;
    }
    $.ajax({
        type: "POST",
        url: "/backVDC/API.php/BaJ/createNewResa",
        dataType: 'text',
        data: {
            name: $('#eventNom').val(),
            id: currentEvent,
            nbr: $('#eventNbr').val()
        },
        success: function (data) {
            if (data === "success") {
                formSuccess();
            }
        }
    }).fail(function (xhr, textStatus, errorThrown) {
        alert(errorThrown);
    });
});

/////////////////////
//JDR
/////////////////////
//css pour les jdr
    function displayFeatureData(data) {
        var content = "";
        for (i = 0; i < data.length; i++) {
            content += "<h3>" + data[i].jeu_nom + "</h3>";
        }
        $('#featured').html(content);

    }
    ////////////////////////////////
    // récupère la liste des jeux d'un certain genre
    ///////////////////////////
    $('#SciF').click(function () {
        $.ajax({
            url: "/backVDC/API.php/Jdr/getByGenr",
            data: {genr: "science fiction"},
            success: function (data) {
                data = JSON.parse(data);
                displayFeatureData(data);

            }
        });
    });
    $('#Med').click(function () {
        $.ajax({
            url: "/backVDC/API.php/Jdr/getByGenr",
            data: {genr: "medieval fantastique"},
            success: function (data) {
                data = JSON.parse(data);
                displayFeatureData(data);

            }
        });
    });
    $('#Cont').click(function () {
        $.ajax({
            url: "/backVDC/API.php/Jdr/getByGenr",
            data: {genr: "contemporain"},
            success: function (data) {
                data = JSON.parse(data);
                displayFeatureData(data);

            }
        });
    });
    $('#Aut').click(function () {
        $.ajax({
            url: "/backVDC/API.php/Jdr/getByGenr",
            data: {genr: "autres"},
            success: function (data) {
                data = JSON.parse(data);
                displayFeatureData(data);

            }
        });
    });
////////////////////////////////////////
//vérifie si la plage horaire est dispo
////////////////////////////////////////
    $('#resaDate').change(function () {
        $.ajax({
            url: "/backVDC/API.php/Jdr/getFreeSched",
            data: {date: new Date(this.value).toLocaleDateString("fr-FR")},
            success: function (data) {
                data = JSON.parse(data);

                for (i = 0; i < 10; i++) {
                    $('#resaTime').children().eq(i).prop('disabled', data[i]);
                }
            }
        });
    });
    // envoyé la resa to bdd
    $('#resaSend').click(function () {
        var name = $("#nomJdr").val().trim();
        if (name.length == 0)
        {
            text = "Es-tu sur de toi ?";
            return;
        }
        var tel = $("#telJdr").val();
        if (!tel.match(/^\d{10}$/))
        {
            text = "On ne pourra pas te joindre!";
            return;
        }
        var date = new Date($("#resaDate").val());
        if (date < Date.now())
        {
            text = "As-tu choisi ?";
            return;
        }
        var time = parseInt($("#resaTime").val());
        if (isNaN(time))
        {
            text = "Mauvais choix!";
            return;
        }
        var dure = parseInt($("#resaDure").val());
        if (isNaN(dure) || (dure != 1 && dure != 2))
        {
            text = "Gourmand!";
            return;
        }
        $.ajax({
            type: "POST",
            url: "/backVDC/API.php/Jdr/createNewResa",
            dataType: 'text',
            data: {
                name: $('#nomJdr').val(),
                tel: $('#telJdr').val(),
                day: $('#resaDate').val(),
                hour: $('#resaTime').val(),
                nbr: $('#resaDure').val()
            },
            success: function (data) {
                if (data === "success") {
                    formSuccess();
                }

            }
        }).fail(function (xhr, textStatus, errorThrown) {
            alert(errorThrown);
        });
    });

///////////////////////////////
//CONTACT
///////////////////////////////

$('#submit').click(function () {
    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($('#email').val()))
    {
        text = "Es-tu sur de ton adresse ?";
        return;
    }
    var comment = $('#comment').val().trim();
    if (comment.length < 20 || comment.length > 500)
    {
        text = "Ton texte de passe pas";
        return;
    }

    $.ajax({
        type: "POST",
        url: "/backVDC/API.php/Contact/insertMessage",
        dataType: 'text',
        data: {
            mail: $('#email').val(),
            comment: comment
        },
        success: function (data) {
            if (data == "success") {
                formSuccess();
            }
        }
    });
});
function formSuccess() {
    $("#contactForm")[0].reset();
    submitMSG(true, "C'est envoyé!");
}

// js de mon cv
function submitMSG(valid, msg) {
    if (valid) {
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit, #resaSend, #eventSend, #newsSend").removeClass().addClass(msgClasses).text(msg);
}