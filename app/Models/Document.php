<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table ='documents';

    protected $fillable = ['document_type', 'relational_id', 'is_main', 'attachment_type',
        'attachment_description', 'file_custom_name', 'file_name', 'user_file_name', 'file_dir',
        'file_size_in_kb', 'content_cover', 'content_body', 'meta_data', 'created_by', 'modified_by',
    ];
}
