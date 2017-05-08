<?php


namespace App;


class OnMessage
{

    public function __construct($updates)
    {
        $bot = new Bot();

        if($updates['chat']['type'] != "private"){
            Commands::check($updates);
        }else{
            $bot->apiRequest("sendMessage",[
                "chat_id"=>$updates['chat']['id'],
                "text"=>"<b>Admin</b> : @negative\n<b>Support Group</b> : https://t.me/joinchat/AAAAAESEC_cBgp1VtYErHA",
                "parse_mode"=>"html"
            ]);
        }
    }
}