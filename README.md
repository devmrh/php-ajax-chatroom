# php-ajax-chatroom

Features:


user can delete and update their own chats by open
right click context menu on chats ! <br>
some validation on user login !<br>
ajax emoji prediction !

//TODO user point to point file transfer.


i used mysql database to store and fetch our visitors chat .

you can change core.php file to connect to your own mysql db.

you should create 2 table with name "chat" and "users" : chat table include chat data ,and users table have users data that are joined our chat.

your db structure should be like this
note: * is column type!
chat table have this cloumns => message_id *int(11) , user_id *int(11)	 , message *(text) , timestamp *(datetime)
users table have this columns => user_id *int(11), username *varchar(25)	

set chat table "message_id" and users table "userid" : AUTO_INCREMENT	

goodluck 
havefun!
