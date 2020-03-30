<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
class Note extends Model
{
    use HasApiTokens;
    protected $fillable = ['user_id', 'text', 'status'];

    public function user()
    {
        return $this->belongTo(User::class);
    }
}
