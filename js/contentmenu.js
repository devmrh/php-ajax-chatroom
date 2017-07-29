var elm = {}

$('document').ready(function () {
    //.messege element should have context menu //we get it when it is ready
    $("body").on("contextmenu", '.message', function (e) {

        // stop browser default behavior
        e.preventDefault();

        var id = $(this).attr('id');
        var text = $(this).find('.text').text();
        //alert(text);
        //get currect clicked element and save it in elem to use it in chat.js file
        elm.textElm = $(this).find('.text');
        elm.textUsr = $(this).find('.username').text();
        elm.textId = id;
        elm.text = text;
        elm.user = $('#username').val();
        elm.cookieuser = $.cookie('userName')

        var menu = $(".menu");

        if (elm.cookieuser === elm.textUsr) {

            menu.find('#delete').prop("disabled", false);
            menu.find('#delete').removeClass("disabled");
            menu.find('#edit').prop("disabled", false);
            menu.find('#edit').removeClass("disabled");

        }else {
            menu.find('#delete').prop("disabled", true);
            menu.find('#delete').addClass("disabled");
            menu.find('#edit').prop("disabled", true);
            menu.find('#edit').addClass("disabled");
        }

        //this menu should be hide to start showing again if user clicked many times
        menu.hide();
        //let get positions;
        var xpos = e.pageX;
        var ypos = e.pageY;

        menu.css({
            top: ypos,
            left: xpos
        });

        var menuwidth = menu.width();
        var menuheight = menu.height();
        var screenWidth = $(window).width();
        var screenHeight = $(window).height();
        var scrolled = $(window).scrollTop();


        // if menu opened edge of screen
        if (xpos + menuwidth > screenWidth) {
            menu.css({
                left: xpos - menuwidth
            })
        }

        if (ypos + menuheight > screenHeight + scrolled) {
            menu.css({
                top: ypos - menuheight
            })
        }

        menu.show();

    })
    // default behavior = hide the context menu if user click out of target element
    $('html').on('click', function () {
        $(".menu").hide(200)
    })


})

