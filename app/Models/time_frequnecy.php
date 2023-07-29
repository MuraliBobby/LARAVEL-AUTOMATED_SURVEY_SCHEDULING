<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class time_frequnecy extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'frequent_login_time',
        'frequent_logout_time',
        'email',
    ];

    public function user(){
        return $this->belongTo(User::class);
    }

}
