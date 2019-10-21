<?php

namespace App;

use App\State;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $guarded = [];

    public function state()
    {
        return $this->hasOne(State::class);
    }
}
