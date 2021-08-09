<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLanguageProficiency extends Model
{
    use HasFactory;

    public $table = 'employee_language_proficiencies';

    protected $fillable =[
        'employee_record_id',
        'language_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

}
