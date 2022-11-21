<?php

namespace App\Models;
use App\Models\ProjectsDonarAgencies;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $guarded = ['id'];

    public function project_doner(){
        return $this->hasMany(ProjectsDonarAgencies::class,'project_id','id');
    }
}
