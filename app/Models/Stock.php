<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function members()
    {
        return $this->belongsToMany(Member::class,'lend');
    }

    public function lends()
    {
        return $this->hasMany(Lend::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class, 'ISBN_number', 'ISBN_number');
    }
}
