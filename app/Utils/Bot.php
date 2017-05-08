<?php

namespace App;


class Bot
{
    protected $token;

    public function __construct()
    {
        $this->token = env("BOT_TOKEN");
    }

    public function apiRequest($method, $parameters)
    {
        $form = null;

        foreach ($parameters as $key => $parameter){
            if($key === "reply_markup" && is_array($parameter)){
                $form[$key] = json_encode($parameter);
            }else{
                $form[$key] = $parameter;
            }
        }

        $ch = curl_init("https://api.telegram.org/bot" . $this->token . "/" . $method);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER=>TRUE,
            CURLOPT_POSTFIELDS=>$form,
            CURLOPT_SSL_VERIFYPEER=>FALSE
        ]);

        $result = json_decode(curl_exec($ch),true);
        return @$result['result'];
    }


    public function kernel($updates)
    {
        if(isset($updates['message'])){
            new OnMessage($updates['message']);
        }elseif(isset($updates['callback_query'])){
            new OnCallback($updates['callback_query']);
        }
    }

}