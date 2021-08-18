<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRecord extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table = 'employee_records';
    protected $fillable = [
        'name_eng',
        'name_bng',
        'father_name_bng',
        'father_name_eng',
        'mother_name_bng',
        'mother_name_eng',
        'date_of_birth',
        'nid',
        'bcn',
        'ppn',
        'gender',
        'religion',
        'blood_group',
        'marital_status',
        'personal_mobile',
        'alternative_mobile',
        'is_cadre',
        'employee_grade',
        'personal_email',
        'employee_batch_id',
        'employee_cadre_id',
        'appointment_memo_no',
        'identity_no',
        'joining_date',
        'status',
        'image_file_name',
        'd_sign',
        'created_by',
        'modified_by',
        'tin_number',
        'official_email',
        'official_mobile',
        'mode_of_recruitment',
        'handicapped_category',
        'district_id',
        'permanent_address',
        'correspondence_address',
        'mother_tongue_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'employee_record_id', 'id');
    }

    public function educational_qualifications(){
        return $this->hasMany(EmployeeEducationalDetail::class, 'employee_record_id','id');
    }

    public function training_experiences(){
        return $this->hasMany(EmployeeTrainingDetail::class, 'employee_record_id','id');
    }

    public function language_proficiencies(){
        return $this->hasMany(EmployeeLanguageProficiency::class, 'employee_record_id','id');
    }

    function profile_picture($is_thumbnail = false, $should_encoded = false): string
    {
        $pro_pic = $this->image_file_name ? asset($this->image_file_name) : asset('images/no.png');
        if ($is_thumbnail) {
            return $pro_pic;
        } elseif ($should_encoded) {
            $photo = file_get_contents($pro_pic);
            return "data:image/jpg;base64, " . base64_encode($photo);
        } else {
            return $pro_pic;
        }
    }
}
