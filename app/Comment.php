<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function users () {
        $this->belongsTo("\App\User", "user_id");
    }
}
