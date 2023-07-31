<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','address','tel','birthday','deleted_at'];
    public function lends() {
        return $this->hasMany(Lend::class);
    }
    public function stocks() {
        return $this->belongsToMany(Stock::class, 'Lend');
    }
}
