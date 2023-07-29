<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class optimalTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'optimal_time'
    ];

    public function user(){
        return $this->belongTo(User::class);
    }
}
