<?php

namespace App\Models;
use App\Models\ProjectsDonarAgencies;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    public function project_doner(){
        return $this->hasMany(ProjectsDonarAgencies::class,'project_id','id');
    }
}
