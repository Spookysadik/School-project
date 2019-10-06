var currentMail = "";
//sidebar
$(document).ready(function () {
    var trigger = $('.hamburger'),
            overlay = $('.overlay'),
            isClosed = false;

    trigger.click(function () {
        hamburger_cross();
    });

    function hamburger_cross() {

        if (isClosed == true) {
            overlay.hide();
            trigger.removeClass('is-open');
            trigger.addClass('is-closed');
            isClosed = false;
        } else {
            overlay.show();
            trigger.removeClass('is-closed');
            trigger.addClass('is-open');
            isClosed = true;
        }
    }

    $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
    });
});



//répondre au mess
$('#respond').click(function () {
    var subject = $("#subject").val().trim();
    if (subject.length == 0)
    {
        var text = "Cette casse est vide!";        
        var msgClasses = "h3 text-center text-danger";

        $("#subjectError").removeClass().addClass(msgClasses).text(text);
        
        return;
    }
    var mess = $('#respmess').val().trim();
    if (mess.length < 20 || mess.length > 500)
    {
        text = "Ton texte ne passe pas";
        return;
    }
    $.ajax({
        type: "POST",
        url: "/backVDC/Admin/API.php/Home/respond",
        dataType: 'text',
        data: {
            mail: currentMail,
            subject: $('#subject').val(),
            mess: $('#respmess').val()
        },
        success: function (data) {
            if (data === "success") {
                $("#subjectError").removeClass().text("");
                
                $("#respondSuccess").removeClass().addClass("h3 text-center tada animated text-success").text("ok");
                formSuccess();
            }
        }
    });
});
function formSuccess() {
    $("#contactForm")[0].reset();
    submitMSG(true, "C'est envoyé!");
}
///////////////////
////se connecté
////////////////////////
$('#login2').click(function () {
    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($('#inputEmail').val()))
    {
        text = "Es-tu sur de ton adresse ?";
        return;
    }
    var password = $("#inputPassword").val().trim();
    if (password.length == 0)
    {
        text = "Cette casse est vide!";
        return;
    }
    $.ajax({
        type: "POST",
        url: "/backVDC/Admin/API.php/Authen/login",
        dataType: 'text',
        data: {
            email: $('#inputEmail').val(),
            password: $('#inputPassword').val()
        },
        success: function (data) {
            location.href = "/backVDC/Admin/index.php";
        }
    }).fail(function () {
        alert("fail");
    });
});
///////////////////////////
//se deco
//////////////////////
$('#deco').click(function () {
    $.ajax({
        type: "POST",
        url: "/backVDC/Admin/API.php/Authen/disconnect",
        dataType: 'text',
        success: function (data) {
            location.href = "/backVDC/Admin/index.php";
        }
    }).fail(function () {
        alert("fail");
    });
});

/////////////////////////
//creer un nouvel event
////////////////////////
$('#addEvent').click(function () {
        var name = $("#Nevent").val().trim();
        if (name.length == 0)
        {
            text = "Remplir cette case!";
            return;
        }
        var day = new Date($("#Devent").val());
        if (day < Date.now())
        {
            text = "Ceci ne va pas!";
            return;
        }
    $.ajax({
        type: "POST",
        url: "/backVDC/Admin/API.php/Event/createNewEvent",
        dataType: 'text',
        data: {
            name: $('#Nevent').val(),
            day: new Date($('#Devent').val()).toLocaleDateString("fr-FR")
        },
        success: function (data) {
            window.location.reload(true);
        }
    });
});

//répondre aux news
$('#Sendletter').click(function () {
    var title = $("#title").val().trim();
    if (title.length == 0)
    {
        text = "Cette casse est vide!";
        return;
    }
    var lettre = $('#lettre').val().trim();
    if (lettre.length < 20 || lettre.length > 500)
    {
        text = "Ton texte ne passe pas";
        return;
    }
    $.ajax({
        type: "POST",
        url: "/backVDC/Admin/API.php/News/Sendletter",
        dataType: 'text',
        data: {
            title: $('#title').val(),
            lettre: $('#lettre').val()
        },
        success: function (data) {
            if (data === "success") {
                formSuccess();
            }
        }
    });
});

//selection jeu du moment
$(document).ready(function () {
    var select = null;
    $('#gameSelect').change(function (event) {
        if ($(this).val().length > 5) {
            $(this).val(select);
        } else {
            select = $(this).val();
        }
    });
});

$('#Change').click(function () {
    $.ajax({
        type: "POST",
        url: "/backVDC/Admin/API.php/Gerer/setJdm",
        dataType: 'text',
        data: {
            jdm: $('#gameSelect').val()
        },
        success: function (data) {
            data = JSON.parse(data);
            var content = "";
            for (i = 0; i < data.length; i++) {
                content += `<div class="shadow padding m-2 p-5">
            <div class="row"> 
                <div class="">                        
                    <div class="jdc" style="background-image: url('../` + data[i].jeu_img + `');"></div>                     
                </div>
                    <div class="">                        
                        <h3>` + data[i].jeu_nom + `</h3>
                        <p class="font-italic">` + data[i].jeu_des + `</p>                        
                    </div>
                </div>
            </div>`;
            }
            $('#content').html(content);

        }
    });
});
//ajouter un jeu
$('#add').click(function () {
        var name = $("#name").val().trim();
        if (name.length == 0)
        {
            text = "Cette case est vide!";
            return;
        }
    $.ajax({
        type: "POST",
        url: "/backVDC/Admin/API.php/Gerer/createNewGame",
        dataType: 'text',
        data: {
            name: $('#name').val(),
            cat: $('#cat').val(),
            age: $('#age').val(),
            nbr_min: $('#Nbrmin').val(),
            nbr_max: $('#Nbrmax').val(),
            tps: $('#tps').val(),
            genr: $('#genr').val(),
            des: $('#comment').val(),
        },
        success: function (data) {
            if (data === "success") {
                formSuccess();
            }

        }
    });
});


function submitMSG(valid, msg) {
    if (valid) {
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#addEvent, #add, #respond, #Sendletter").removeClass().addClass(msgClasses).text(msg);
}

//supprimer un évenement
function deletEvent(id) {
    $.ajax({
        type: "POST",
        url: "/backVDC/Admin/API.php/Event/deletEvent",
        dataType: 'text',
        data: {
            id: id
        },
        success: function (data) {
            window.location.reload(true);

        }
    });
}
//supprimer une réservation jdr
function deletResa(id) {
    $.ajax({
        type: "POST",
        url: "/backVDC/Admin/API.php/Resa/deletResa",
        dataType: 'text',
        data: {
            id: id
        },
        success: function (data) {
            window.location.reload(true);

        }
    });
}
//supprimer les mails dans la newsletter
function delmail(id) {
    $.ajax({
        type: "POST",
        url: "/backVDC/Admin/API.php/News/delMail",
        dataType: 'text',
        data: {
            id: id
        },
        success: function (data) {
            window.location.reload(true);

        }
    });
}

//supprimer les messages de la messagerie
function delmess(id) {
    $.ajax({
        type: "POST",
        url: "/backVDC/Admin/API.php/Home/delMess",
        dataType: 'text',
        data: {
            id: id
        },
        success: function (data) {
            window.location.reload(true);

        }
    });
}

