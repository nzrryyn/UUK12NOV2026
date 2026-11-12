<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowingDetail extends Model
{
    protected $fillable = [
        'borrowing_id',
        'tool_id',
        'quantity',
    ];

    public function borrowing(){
        return $this->belongsTo(Borrowing::class);
    }

    public function tool(){
        return $this->belongsTo(Tool::class);
    }
}
