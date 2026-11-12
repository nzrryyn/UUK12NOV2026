<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
        'user_id',
        'approved_by',
        'borrow_date',
        'due_date',
        'status',
        'notes',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function approver()
{
    return $this->belongsTo(User::class, 'approved_by');
}
}
