<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $primaryKey = 'ISBN_number';
    // protected $fillable = ['ISBN_number', 'document_name', 'code', 'author', 'publisher', 'publisher_date'];

    public function stock()
    {
        return $this->hasMany(Stock::class, 'ISBN_number');
    }
}
