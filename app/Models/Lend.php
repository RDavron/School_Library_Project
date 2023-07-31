<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lend extends Model
{
    use HasFactory;
    
    // protected $fillable = ['user_id','document_id','due_date','remark'];

    public function member() {
        return $this->belongsTo(Member::class);
    }

  
    public function stock() {
        return $this->belongsTo(Stock::class);
    }
}
