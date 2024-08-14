<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'form_name', 'file_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
