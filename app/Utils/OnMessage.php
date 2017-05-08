<?php


namespace App;


class OnMessage
{

    public function __construct($updates)
    {
        if($updates['chat']['type'] != "private"){
            Commands::check($updates);
        }
    }
}