<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';

    public function addResult(int $student_id, $data, $grade)
    {
        $check_row = $this->where('student_id', $student_id);

        if ( $check_row->count() > 2 ) {
            return ['status' => 'more than 2 sitting'];
        }

        $this->exam_type    = $data->exam_type;
        $this->exam_center  = $data->exam_center;
        $this->exam_no      = $data->exam_no;
        $this->exam_date    = $data->exam_date;
        $this->grade        = $grade;
        $this->student_id   = $student_id;
        $this->save();
        return [];
    }
}
