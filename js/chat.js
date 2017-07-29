var chat = {}

chat.fetchMessages = function () {

    var data = {method: "fetch"}
    $.ajax({
        url: 'ajax/chat.php',
        type: 'POST',
        data: data,

        success: function (data) {
            $('#show_case').html(data);
            if ($.cookie('userName')) {
                $("#join").fadeOut(1000,function () {
                    $("#user_dash").css("float","none");

                })
            }
        }

    });
}

chat.throwMessage = function (message) {
    if ($.trim(message).length != 0) {
        if ($.cookie('userName')){
            var data = {method: "throw", message: message}
            $.ajax({
                url: 'ajax/chat.php',
                type: 'POST',
                data: data,
                success: function (data) {
                    chat.fetchMessages();
                    chat.entry.val('');
                }

            });
        }else {
            $("#error").show(200,function () {
                $("#error").html("you must join chat first!")

            });
        }

    }
}


chat.entry = $('#textaria');
chat.entry.bind('keydown', function (e) {
    if (e.keyCode === 13 && e.shiftKey === false) {
        chat.throwMessage($(this).val())
        e.preventDefault()
    }
})


/****** CHECK MEEEEE*****/

$('#delete').click(function (e) {

    var message_id = elm.textId;
    e.preventDefault();

    $.ajax({
        url: 'ajax/chat.php',
        type: 'POST',
        data: {
            method: "delete",
            id: message_id,
        },
        success: function (data) {
            chat.fetchMessages();

        }
    });

});


$('#edit').bind('click dbclick', function (e) {
    clearInterval(chat.interval);
    var fName = $("<input type=\"text\" class=\"fieldname\" value='" + elm.text + "'/>");
    $(elm.textElm).replaceWith(fName)
    var message_id = elm.textId;
    e.preventDefault();
    fName.bind('keydown', function (e) {
        elm.text = fName.val();
        if (e.keyCode === 13) {
            var msg = fName.val();
            $.ajax({
                url: 'ajax/chat.php',
                type: 'POST',
                data: {
                    method: "edit",
                    id: message_id,
                    msg
                },
                success: function (data) {
                    fName.replaceWith(msg)

                }
            });

        }
    })
})

$("#textaria").keyup(function () {

    if ($("#textaria").val() !== ' ') {
        $.ajax({


            type: "POST",
            url: "ajax/chat.php",
            data: 'word=' + $(this).val() + '&method=bigshow',
            beforeSend: function () {
                $("#textaria").css({
                    background: "url (emoji/LoaderIcon.gif)",
                    backgroundPosition: "center"

                });
            },
            success: function (data) {
                $("#suggesstion-box").hide();
                $("#suggesstion-box").html(data).slideDown(1000);
                //  $("#textaria").css("background","#FFF");

            }

        });
    } else {
        $("#suggesstion-box").hide();

    }

});

function showsuggest(val) {
    $("#textaria").val(val);
    $("#suggesstion-box").hide();
}


$("#show_case").html('<img class="ajaxpic" src="emoji/loading.webp">');

chat.interval = setInterval(chat.fetchMessages, 5000);