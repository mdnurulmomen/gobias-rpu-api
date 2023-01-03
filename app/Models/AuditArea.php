<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditArea extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $with = ['sector'];

    /**
     * Get the parent commentable model (project or function or unit).
     */
    public function sector()
    {
        return $this->morphTo();
    }

    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
}
