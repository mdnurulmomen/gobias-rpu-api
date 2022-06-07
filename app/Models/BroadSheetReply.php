<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BroadSheetReply extends Model
{
    use HasFactory;

    public function broadsheet_reply_items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BroadSheetReplyItem::class,'broad_sheet_reply_id','id');
    }

}
