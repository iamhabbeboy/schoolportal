<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolAttended extends Model
{
    protected $table = 'school_attended';

    public function addSchool(int $student_id, $data)
    {
        $row = $this->where('student_id');
        if( $row->count() > 2 ) {
            return ['status' => 'more than 2 sitting'];
        }
        $this->name          = $data->school_name;
        $this->duration_from = $data->school_from;
        $this->duration_to   = $data->school_to;
        $this->student_id    = $student_id;
        $this->save();
        return [];
    }
}
