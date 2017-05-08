<?php

namespace App;


class Commands
{

    public static function check($message)
    {
        $chat_id = "" . $message['chat']['id'];
        @$text = $message['text'];

        $bot = new Bot();

        if (preg_match('/^\/([Aa]dd)$/', $text) && $message['from']['id'] == env("BOT_ADMIN")) {
            if (Groups::where("chat_id", $chat_id)->count() == 0) {
                $id = Groups::create(["chat_id" => $chat_id])->id;
                $group = Groups::find($id);
                $group->settings()->save(new Settings([
                    "link" => 1,
                    "photo" => 1,
                    "voice" => 1,
                    "username" => 1,
                    "text" => 1,
                    "document" => 1,
                    "sticker" => 1,
                    "audio" => 1,
                    "video" => 1,
                    "contact" => 1
                ]));

                $bot->apiRequest("sendMessage",[
                    "chat_id"=>$chat_id,
                    "text"=>"<b>Group</b> " . $chat_id . " <b>Added</b>",
                    "parse_mode" =>"html"
                ]);
            }else{
                $bot->apiRequest("sendMessage",[
                    "chat_id"=>$chat_id,
                    "text"=>"<b>Group Already Added</b>",
                    "parse_mode"=>"html"
                ]);
            }
        }elseif(preg_match('/^\/([Ii][Dd])$/',$text)){
            if(isset($message['reply_to_message'])){
                $reply_message = $message['reply_to_message'];
                $bot->apiRequest("sendMessage",[
                    "chat_id"=>$chat_id,
                    "text"=>"<b>Name : </b>".$reply_message['from']['first_name']."\n<b>ID : </b><code>".$reply_message['from']['id']."</code>",
                    "parse_mode"=>"html"
                ]);
            }

        }else{
            $member = $bot->apiRequest("getChatMember",[
                "chat_id"=>$chat_id,
                "user_id"=>$message['from']['id']
            ]);
            if($member['status'] == "creator" || $member['status'] == "administrator"){
                if(preg_match('/^\/([Bb]an)$/',$text) && isset($message['reply_to_message'])){
                    $reply_message = $message['reply_to_message'];
                    $bot->apiRequest("kickChatMember",[
                        "chat_id"=>$chat_id,
                        "user_id"=>$reply_message['from']['id']
                    ]);
                    $bot->apiRequest("sendMessage",[
                        "chat_id"=>$chat_id,
                        "text"=>"<b>".$reply_message['from']['id']."</b> kicked ! :D",
                        "parse_mode"=>"html"
                    ]);
                }elseif(preg_match('/^\/([Ss]ettings)$/',$text)){
                    $group = Groups::with("settings")->where("chat_id", $chat_id)->get();
                    $setting = null;
                    $settings = $group[0]->settings;
                    if($settings->link){
                        $setting .= "\nLink: Unlock";
                    }else{
                        $setting .= "\nLink: <b>Locked</b>";
                    }

                    if($settings->photo){
                        $setting .= "\nPhoto: UnLock";
                    }else{
                        $setting .= "\nPhoto: <b>Locked</b>";
                    }

                    if($settings->voice){
                        $setting .= "\nVoice: Unlock";
                    }else{
                        $setting .= "\nVoice: <b>Locked</b>";
                    }

                    if($settings->username){
                        $setting .= "\nUsername: Unlock";
                    }else{
                        $setting .= "\nUsername: <b>Locked</b>";
                    }

                    if($settings->text){
                        $setting .= "\nText: Unlock";
                    }else{
                        $setting .= "\nText: <b>Locked</b>";
                    }

                    if($settings->document){
                        $setting .= "\nDocument: Unlock";
                    }else{
                        $setting .= "\nDocument: <b>Locked</b>";
                    }

                    if($settings->sticker){
                        $setting .= "\nSticker: Unlock";
                    }else{
                        $setting .= "\nSticker: <b>Locked</b>";
                    }

                    if($settings->audio){
                        $setting .= "\nAudio: Unlock";
                    }else{
                        $setting .= "\nAudio: <b>Locked</b>";
                    }

                    if($settings->contact){
                        $setting .= "\nContact: Unlock";
                    }else{
                        $setting .= "\nContact: <b>Locked</b>";
                    }

                    if($settings->video){
                        $setting .= "\nVideo: Unlock";
                    }else{
                        $setting .= "\nVideo: <b>Locked</b>";
                    }

                    $bot->apiRequest("sendMessage",[
                        "chat_id"=>$chat_id,
                        "text"=>$setting,
                        "parse_mode"=>"html",
                        "reply_markup"=>[
                            "inline_keyboard"=>[
                                [
                                    ["text"=>"Lock Link", "callback_data"=>"l_link"],
                                    ["text"=>"Unlock Link", "callback_data"=>"u_link"]
                                ],
                                [
                                    ["text"=>"Lock Photo", "callback_data"=>"l_photo"],
                                    ["text"=>"Unlock Photo", "callback_data"=>"u_photo"],

                                ],
                                [
                                    ["text"=>"Lock Voice", "callback_data"=>"l_voice"],
                                    ["text"=>"Unlock Voice", "callback_data"=>"u_voice"]
                                ],
                                [
                                    ["text"=>"Lock Username", "callback_data"=>"l_username"],
                                    ["text"=>"Unlock Username", "callback_data"=>"u_username"]
                                ],
                                [
                                    ["text"=>"Lock Text", "callback_data"=>"l_text"],
                                    ["text"=>"Unlock Text", "callback_data"=>"u_text"]
                                ],
                                [
                                    ["text"=>"Lock Document", "callback_data"=>"l_document"],
                                    ["text"=>"Unlock Document", "callback_data"=>"u_document"]
                                ],
                                [
                                    ["text"=>"Lock Sticker", "callback_data"=>"l_sticker"],
                                    ["text"=>"Unlock Sticker", "callback_data"=>"u_sticker"]
                                ],
                                [
                                    ["text"=>"Lock Audio", "callback_data"=>"l_audio"],
                                    ["text"=>"Unlock audio", "callback_data"=>"u_audio"]
                                ],
                                [
                                    ["text"=>"Lock Contact", "callback_data"=>"l_contact"],
                                    ["text"=>"Unlock Contact", "callback_data"=>"u_contact"]
                                ],
                                [
                                    ["text"=>"Lock Video", "callback_data"=>"l_video"],
                                    ["text"=>"Unlock Video", "callback_data"=>"u_video"]
                                ]
                            ]
                        ]
                    ]);

                }else{
                    Checker::check($message);
                }
            }else{
                Checker::check($message);
            }
        }
    }
}