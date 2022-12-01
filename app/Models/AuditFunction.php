<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuditFunction extends Model
{
    protected $table = 'functions';

    // protected $with = ['auditAreas'];

    /**
     * Get all of the project's areas.
     */
    public function auditAreas()
    {
        return $this->morphMany(AuditArea::class, 'sector');
    }
}
