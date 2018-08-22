<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoursesRegister extends Model
{
    protected $table = 'course_registration';

    public function addCourses(int $student_id, String $year, int $semester, int $course_id)
    {

        $sql = $this->where('student_id', $student_id)
        ->where('course_id', $course_id)->where('semester', $semester);
        if( $sql->count() > 0 ) {
            echo 'exist';
        } else {
            $orm = new CoursesRegister;
            $orm->student_id   = $student_id;
            $orm->year         = $year;
            $orm->semester     = $semester;
            $orm->course_id    = $course_id;
            $orm->save();
        }
    }

    public function getCourse()
    {
        return $this->belongsTo('App\Courses', 'course_id', 'id');
    }

    static function registerCourse(int $student_id)
    {
        return CoursesRegister::where('student_id', $student_id)->with('getCourse');
    }
}
