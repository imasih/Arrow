<?php

namespace App\Http\Controllers;

use App\Groups;
use Illuminate\Http\Request;

class Bot extends Controller
{
    public function hook(Request $request)
    {
        if($request->isJson()){
            $content = json_decode($request->getContent(), true);
            $bot = new \App\Bot();
            $bot->kernel($content);
        }
    }

    public function db()
    {
        return Groups::with("settings")->get();
    }
}
