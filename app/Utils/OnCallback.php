<?php
namespace App;


class OnCallback
{
    public function __construct($callback)
    {
        $bot = new Bot();

        $chat_id = $callback['message']['chat']['id'];
        $from = $callback['from']['id'];

        $data = $callback['data'];

        $member = $bot->apiRequest("getChatMember",[
            "chat_id"=>$chat_id,
            "user_id"=>$from
        ]);
        if($member['status'] == "creator" || $member['status'] == "administrator"){
            $group = Groups::with("settings")->where("chat_id", "$chat_id")->get();
            $group = Groups::find($group[0]->id);

            $message = null;
            switch ($data){
                case "l_link":
                    $group->settings()->update(["link"=>0]);
                    $group->save();
                    $message = "Link Locked";
                    break;
                case "u_link":
                    $group->settings()->update([
                        "link"=>1
                    ]);
                    $group->save();
                    $message = "Link Unlocked";
                    break;
                case "l_photo":
                    $group->settings()->update([
                        "photo"=>0
                    ]);
                    $group->save();
                    $message = "Photo Locked";
                    break;
                case "u_photo":
                    $group->settings()->update([
                        "photo"=>1
                    ]);
                    $group->save();
                    $message = "Photo Unlocked";
                    break;
                case "l_voice":
                    $group->settings()->update([
                        "voice"=>0
                    ]);
                    $group->save();
                    $message = "Voice Locked";
                    break;
                case "u_voice":
                    $group->settings()->update([
                        "voice"=>1
                    ]);
                    $group->save();
                    $message = "Voice Unlocked";
                    break;
                case "l_username":
                    $group->settings()->update([
                        "username"=>0
                    ]);
                    $group->save();
                    $message = "Username Locked";
                    break;
                case "u_username":
                    $group->settings()->update([
                        "username"=>1
                    ]);
                    $group->save();
                    $message = "Username Unlocked";
                    break;
                case "l_text":
                    $group->settings()->update([
                        "text"=>0
                    ]);
                    $group->save();
                    $message = "Text Locked";
                    break;
                case "u_text":
                    $group->settings()->update([
                        "text"=>1
                    ]);
                    $group->save();
                    $message = "Text Unlocked";
                    break;
                case "l_document":
                    $group->settings()->update([
                        "document"=>0
                    ]);
                    $group->save();
                    $message = "Document Locked";
                    break;
                case "u_document":
                    $group->settings()->update([
                        "document"=>1
                    ]);
                    $group->save();
                    $message = "Document Unlocked";
                    break;
                case "l_sticker":
                    $group->settings()->update([
                        "sticker"=>0
                    ]);
                    $group->save();
                    $message = "Sticker Locked";
                    break;
                case "u_sticker":
                    $group->settings()->update([
                        "sticker"=>1
                    ]);
                    $group->save();
                    $message = "Sticker Unlocked";
                    break;
                case "l_audio":
                    $group->settings()->update([
                        "audio"=>0
                    ]);
                    $group->save();
                    $message = "Audio Locked";
                    break;
                case "u_audio":
                    $group->settings()->update([
                        "audio"=>1
                    ]);
                    $group->save();
                    $message = "Audio Unlocked";
                    break;
                case "l_contact":
                    $group->settings()->update([
                        "contact"=>0
                    ]);
                    $group->save();
                    $message = "Contact Locked";
                    break;
                case "u_contact":
                    $group->settings()->update([
                        "contact"=>1
                    ]);
                    $group->save();
                    $message = "Contact Unlocked";
                    break;
                case "l_video":
                    $group->settings()->update([
                        "video"=>0
                    ]);
                    $group->save();
                    $message = "Sticker Unlocked";
                    break;
                case "u_video":
                    $group->settings()->update([
                        "video"=>1
                    ]);
                    $group->save();
                    $message = "Sticker Unlocked";
                    break;
            }
            $bot->apiRequest("answerCallbackQuery",[
                "callback_query_id"=>$callback['id'],
                "text"=>$message
            ]);
        }else{
            $bot->apiRequest("answerCallbackQuery",[
                "callback_query_id"=>$callback['id'],
                "text"=>"Only Admin :D"
            ]);
        }
    }
}