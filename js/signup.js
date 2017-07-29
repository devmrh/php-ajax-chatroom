$('document').ready(function () {
    /* validation */
    $("#user-form").validate({
        rules:
            {
                username: {
                    required: true,
                    minlength: 3
                }
            },
        messages:
            {
                username: "<p class='erorr'>user name must have al least 3 char</p>",

            },
        submitHandler: submitForm
    });

    function submitForm() {
        $.ajax({

            type: 'POST',
            url: 'ajax/chat.php',
            data: $("#user-form").serialize() + '&method=signup',
            beforeSend: function () {
                $("#error").fadeOut();
                $("#btn-submit").html('در حال اتصال');
            },
            success: function (data) {

                $("#btn-submit").html('ورود کردید');
                if (data === "registered") {

                    $("#error").hide();
                    $("#join").delay(2000).fadeOut(1000);
                    $.cookie('userName', $('#username').val());

                }
                if (data === "error") {
                    $("#error").hide();
                    $("#join").delay(2000).fadeOut(1000);
                    $.cookie('userName', $('#username').val());


                }

            }
        });

        return false;
    }

});