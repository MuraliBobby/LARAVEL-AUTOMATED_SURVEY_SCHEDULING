<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from_time',
        'to_time',
    ];

    public function user(){
        return $this->belongTo(User::class);
    }
}
