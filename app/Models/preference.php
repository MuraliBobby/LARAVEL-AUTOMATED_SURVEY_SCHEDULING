<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class preference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'preferences',     
    ];

    public function user(){
        return $this->belongTo(User::class);
    }
}
