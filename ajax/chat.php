<?php
session_start();
require "../core/classes/core.php";
require "../core/classes/chat.php";

$chat = new Chat();
define('ROOT', dirname(__DIR__));

const EMOJI = [
    ":lol" => "emoji/0046.gif",
    ":d" => "emoji/0055.gif",
    ":|" => "emoji/poker.png",
    ":(" => "emoji/0005.gif",
    ":cool" => "emoji/0038.gif",
    ":shy" => "emoji/0001.gif",
    ":)" => "emoji/0003.gif",
    ":p" => "emoji/0008.gif",
    ":h" => "emoji/0031.gif",
    ":search" => "emoji/0042.gif",
    ":'(" => "emoji/0057.gif",
    ":cry" => "emoji/0048.gif",
    ":think" => "emoji/0052.gif",
    ":y" => "emoji/0053.gif",
    ":@" => "emoji/0052.gif",
    ":xd" => "emoji/0056.gif",
    ":punch" => "emoji/0063.gif",
    ":*" => "emoji/0064.gif",
    ":angle" => "emoji/0065.gif",
    ":sick" => "emoji/0013.gif",
    ":flower" => "emoji/0067.gif"
];


if ($_POST['method'] === 'fetch') {
    $messages = $chat->fetchMessage();

    if (!empty($messages)) {
        foreach ($messages as $key => $value) { ?>

            <div class="message" id="<?php echo $value['message_id'] ?>">
                <p class="username"><?php echo $value['username']; ?></p><span style="font-size: 12px">say:</span>
                <?php

                $keys = array_keys(EMOJI);
                foreach ($keys as &$k) {
                    $k = str_replace(['|', '(', ')', '*'], ['\|', '\(', '\)', '\*'], $k);
                }

                $str = strtolower($value['message']);

                $pattern = '~(' . implode(')|(', $keys) . ')~';

                $r = preg_replace_callback(
                    $pattern,
                    function ($matched) {
                        return "<img width='20' height='20' src=" . EMOJI[$matched[0]] . ">";

                    },
                    $str
                );

            echo "<p class='text'>" . $r . "</p></div>";
        }
    } else {
        echo "empety message";
    }

}

if ($_POST['method'] === 'throw' && isset($_SESSION['username'])) {
    $message = $chat->escape($_POST['message']);
    $id = $chat->getId($_SESSION['username']);
    $chat->throwMessage((int)$id[0]['user_id'], $message);

}


if (isset($_POST['username']) && $_POST['method'] === 'signup') {
    $username = $_POST['username'];
    if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
        return false;
    } else {
        $chat->username = $username;
        $_SESSION['username'] = $username;
        setcookie('username', $username);
        $user = $chat->getUser($username);
        if ($user) {
            echo "error";
            return false;
        } else {
            $chat->signUp($chat->escape($username));
            echo "registered";

        }
    }
}

function showEmoji($code)
{
    echo "<img src='" . EMOJI[$code] . "' width='20' height='20'>";
}

if ($_POST['method'] === "bigshow") {

    if (preg_match("/:/", $_POST['word'])) {
        $requested = strtolower($_POST['word']);

        foreach (EMOJI as $key => $value) {

            $data = $key . ' ';

            if (preg_match_all("~" . preg_quote($requested, "~") . "\S*~", $data, $matches)) { ?>
                <p class="emoji"
                   onClick="showsuggest('<?php echo $matches[0][0] ?>');"><?php showEmoji($matches[0][0]); ?></p>

            <?php }


        }
    }

}

if ($_POST['method'] === 'delete' && isset($_SESSION['username'])) {
    $chat->delete($_POST['id']);
}

if ($_POST['method'] === 'edit' && isset($_SESSION['username'])) {
    $chat->edit($_POST['msg'], $_POST['id']);
}
