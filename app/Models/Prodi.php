<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';

    protected $fillable = [
        'name',
        'kaprodi_id',
    ];

    public function kaprodi()
    {
        return $this->belongsTo(User::class, 'kaprodi_id');
    }
}
