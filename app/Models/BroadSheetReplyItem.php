<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BroadSheetReplyItem extends Model
{
    use HasFactory;

    /*public function getMemoSendDateAttribute($value): string
    {
        return Carbon::parse($value)->format('d/m/Y');
    }*/

    public function apotti(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ApottiItem::class, 'apotti_item_id', 'apotti_item_id');
    }

}
