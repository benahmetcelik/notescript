<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    public function getShortTitle(){
        return mb_strimwidth($this->title,0,20,'...');
    }

    public function getShortContent(){
        return mb_strimwidth($this->content,0,50,'...');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
