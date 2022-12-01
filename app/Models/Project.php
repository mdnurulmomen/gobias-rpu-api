<?php

namespace App\Models;
use App\Models\ProjectsDonarAgencies;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $guarded = ['id'];

    // protected $with = ['auditAreas'];

    public function project_doner(){

        return $this->hasMany(ProjectsDonarAgencies::class,'project_id','id');

    }

    /**
     * Get all of the project's areas.
     */
    public function auditAreas()
    {
        return $this->morphMany(AuditArea::class, 'sector');
    }
}
