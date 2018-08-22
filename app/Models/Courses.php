<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = 'courses';

    public function create(Object $data)
    {
        $sql = $this->where('title', $data->title);
        if( $sql->count() > 0 ) {
            return ['status' => 'exist'];
        }
        $this->year = $data->year;
        $this->semester = $data->semester;
        $this->title    = $data->title;
        $this->code     = $data->code;
        $this->unit     = $data->unit;
        $this->save();
        return ['status' => 'save'];

    }

    public function allCourse(String $year, int $semester)
    {
        return $this->whereNotNull('title')
        ->where('year', $year)->where('semester', $semester);
    }

}
