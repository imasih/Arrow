<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Settings
 *
 * @mixin \Eloquent
 * @property-read \App\Groups $groups
 */
class Settings extends Model
{
    public $timestamps = false;
    protected $table = "settings";
    protected $fillable = [
        "link",
        "photo",
        "voice",
        "username",
        "text",
        "document",
        "sticker",
        "audio",
        "video",
        "contact",
        "id"
    ];

    public function groups()
    {
        return $this->belongsTo(Groups::class, "id");
    }
}
