<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolReturn extends Model
{
    protected $fillable = [
        'borrowing_id',
        'returned_at',
        'notes',
        'received_by',
    ];
    public function borrowing(){
        return $this->belongsTo(borrowing::class);
    }
    public function receiver(){
        return $this->belongsTo(User::class, 'receive_by');
    }
}
