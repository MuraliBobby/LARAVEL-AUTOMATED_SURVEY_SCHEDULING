<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'survey_link',
        'email',
    ];

    public function availability()
    {
        return $this->belongsTo(availability::class);
    }
}
