<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $fillable = [
        'student_id', 'payment_type', 'amount', 'status', 'currency', 'ref_num',
    ];

    public function getStudent()
    {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }

    public function getStudentInfo()
    {
        return $this->belongsTo('App\User', 'student_id', 'id');
    }

    public function paymentHistory(int $student_id = 0 )
    {
        if( $student_id == 0 ){
            return $this->whereNotNull('student_id')->with('getStudent')
            ->with('getStudentInfo');
        }
        return $this->whereNotNull('student_id')->where('student_id', $student_id);
    }

}
