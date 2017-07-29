<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>chat</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
<div id="result"></div>

<div id="show_case"></div>
<input type='hidden' value='' id='message_id'>
<div class="menu">
    <ul>
        <li>
            <button disabled class="disabled" id="delete">delete</button>
        </li>
        <li>
            <button disabled class="disabled" id="edit">edit</button>
        </li>
    </ul>
</div>
<div id="user_dash" style="visibility: visible">
    <img src="emoji/cat.gif" height="100">
    <br>
    <div id="error" style="display: none"></div>
    <textarea id="textaria" name="textaira" rows="15" cols="22"></textarea>
    <br>
    <div id="suggesstion-box"></div>

</div>

<div class="join" id="join">
    <h3>join chat</h3>
    <form method="post" id="user-form">
        <input type="text" name="username" id="username" placeholder="your name?"><br>
        <button class="btn" id="btn-submit">join</button>
    </form>

</div>
<div style="clear: both"></div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script src="js/chat.js"></script>
<script src="js/signup.js"></script>
<script src="js/contentmenu.js"></script>
<footer>

</footer>
</body>
<footer class="footer">
    <p>fork this project at <a href="https://github.com/ultra2mh/php-ajax-chatroom">https://github.com/ultra2mh/php-ajax-chatroom</a></p>
</footer>
</html>
