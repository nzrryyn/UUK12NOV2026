<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolReturnDetail extends Model
{
    protected $fillable = [
        'tool_return_id',
        'borrowing_detail_id',
        'quantity_returned',
        'condition',
        'fine_amount',
    ];

    public function toolReturn()
    {
        return $this->belongsTo(ToolReturn::class, 'tool_return_id');
    }

    public function borrowingDetail()
    {
        return $this->belongsTo(BorrowingDetail::class, 'borrowing_detail_id');
    }
}