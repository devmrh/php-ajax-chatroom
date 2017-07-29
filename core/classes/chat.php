<?php

class Chat extends Core
{

    public function escape($e){
       // $var = htmlentities($e);
        return htmlspecialchars($e,ENT_QUOTES);
    }

    public function fetchMessage()
    {
        $this->query("
            SELECT  `chat`.`message`,
                    `chat`.`message_id`,
                     `users`.`username`,
                     `users`.`user_id`
            FROM      `chat`
            JOIN      `users`
            ON          `chat`.`user_id` = `users`.`user_id`
            ORDER BY    `chat`.`timestamp`
            DESC 
        ");

        return $this->rows();
    }

    public function throwMessage($user_id, $message)
    {

        $this->query("
        INSERT INTO `chat` (`user_id`,`message`,`timestamp`)
        VALUES ('$user_id','$message',NOW())
        ");
    }

    public function signUp($username)
    {
        $this->query("
        insert into users SET 
        username = '$username';
        ");
    }

    public function getId($username)
    {
        $this->query("
      SELECT * FROM `users` WHERE username = '$username'
        ");

        return $this->rows();
    }


    public function delete($messageId)
    {
        $this->query("
        DELETE FROM `chat` WHERE `message_id` = $messageId
        ");

    }

    public function edit($msg, $messageId)
    {
        $this->query("
        UPDATE `chat` SET `message` = '$msg' WHERE `message_id` = $messageId;

        ");
    }

    public function getUser($user){
        $this->query("
        select * from users where username = '$user'
        ");
        return $this->rows();
    }

}
