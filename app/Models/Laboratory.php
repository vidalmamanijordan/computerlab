<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    protected $guarded = ['id'];
    
    use HasFactory;

    /* Relación uno a muchos */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
