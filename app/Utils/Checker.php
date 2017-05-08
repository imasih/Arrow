<?php

namespace App;


class Checker
{

    public static function check($message)
    {
        $bot = new Bot();

        $settings = Groups::with("settings")->where("chat_id", $message['chat']['id']);
        if($settings->count() == 1){
            $settings = $settings->get()[0]->settings;
            if(isset($message['text'])){
                if($settings->text == 0){
                    $bot->apiRequest("DeleteMessage",[
                        "chat_id"=>$message['chat']['id'],
                        "message_id"=>$message['message_id']
                    ]);
                }else{
                    if($settings->link == 0){
                        if(preg_match('/([Tt]\.me|[Tt]elegram\.me)(.*)/s',$message['text'])){
                            $bot->apiRequest("DeleteMessage",[
                                "chat_id"=>$message['chat']['id'],
                                "message_id"=>$message['message_id']
                            ]);
                        }
                    }
                    if($settings->username == 0){
                        if(preg_match('/(@)(.*)/',$message['text'])){
                            $bot->apiRequest("DeleteMessage",[
                                "chat_id"=>$message['chat']['id'],
                                "message_id"=>$message['message_id']
                            ]);
                        }
                    }
                }
            }elseif(isset($message['photo'])){
                if($settings->photo == 0){
                    $bot->apiRequest("DeleteMessage",[
                        "chat_id"=>$message['chat']['id'],
                        "message_id"=>$message['message_id']
                    ]);
                }
            }elseif(isset($message['voice'])){
                if($settings->voice == 0){
                    $bot->apiRequest("DeleteMessage",[
                        "chat_id"=>$message['chat']['id'],
                        "message_id"=>$message['message_id']
                    ]);
                }
            }elseif(isset($message['document'])){
                if($settings->document == 0){
                    $bot->apiRequest("DeleteMessage",[
                        "chat_id"=>$message['chat']['id'],
                        "message_id"=>$message['message_id']
                    ]);
                }
            }elseif(isset($message['sticker'])){
                if($settings->sticker == 0){
                    $bot->apiRequest("DeleteMessage",[
                        "chat_id"=>$message['chat']['id'],
                        "message_id"=>$message['message_id']
                    ]);
                }
            }elseif(isset($message['audio'])){
                if($settings->audio == 0){
                    $bot->apiRequest("DeleteMessage",[
                        "chat_id"=>$message['chat']['id'],
                        "message_id"=>$message['message_id']
                    ]);
                }
            }elseif(isset($message['video'])){
                if($settings->video == 0){
                    $bot->apiRequest("DeleteMessage",[
                        "chat_id"=>$message['chat']['id'],
                        "message_id"=>$message['message_id']
                    ]);
                }
            }elseif(isset($message['contact'])){
                if($settings->contact == 0){
                    $bot->apiRequest("DeleteMessage",[
                        "chat_id"=>$message['chat']['id'],
                        "message_id"=>$message['message_id']
                    ]);
                }
            }
        }
    }

}