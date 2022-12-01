<?php

namespace App\Models;
use App\Models\ProjectsDonarAgencies;
use Illuminate\Database\Eloquent\Model;

class UnitMasterInfo extends Model
{
    protected $table = 'unit_master_info';

    // protected $with = ['auditAreas'];

    /**
     * Get all of the project's areas.
     */
    public function auditAreas()
    {
        return $this->morphMany(AuditArea::class, 'sector');
    }
}
