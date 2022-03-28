<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApottiCommunication extends Model
{
    use HasFactory;

    protected $fillable = [
        'apotti_communication_top_sheet_id',
        'memorandum_no',
        'memorandum_date',
        'apotti_id',
        'apotti_item_id',
        'status',
        'comment',
        'message',
        'sender_office_id',
        'sender_user_id',
        'sender_designation_id',
        'sender_type',
        'receiver_office_id',
        'receiver_user_id',
        'receiver_designation_id',
        'receiver_type'
    ];


    public function apotti_item(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ApottiItem::class, 'apotti_item_id','apotti_item_id');
    }

    public function sender_office_name(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Office::class, 'sender_office_id','id');
    }
}
