<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Groups
 *
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Owners[] $owner
 * @property-read \App\Settings $settings
 */
class Groups extends Model
{

    protected $table = "groups";
    protected $fillable = ["chat_id","id"];
    public $timestamps = false;

    public function settings()
    {
        return $this->hasOne(Settings::class, "id");
    }


}
