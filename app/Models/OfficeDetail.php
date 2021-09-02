<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeDetail extends Model
{
    use HasFactory;

    protected $table = 'office_details';
    protected $fillable = [
        'office_id', 'board_of_directors', 'organizational_structure', 'summary_of_manpower',
        'important_feature_of_entity', 'mission', 'vision', 'financial_statements', 'revenue_expenditure',
        'capital_expenditure', 'created_by', 'created_at', 'updated_by', 'updated_at', 'is_active'
        ];

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }
}
