<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'id',
        'student_id',
        'student_no',
        'dob',
        'phone',
        'address',
        'state',
        'lga',
        'country'
    ];

    public function studentInfo()
    {
        return $this->hasOne('App\User', 'id', 'student_id');
    }

    public function studentResult()
    {
        return $this->hasMany('App\Result', 'student_id', 'id');
    }

    public function paymentInfo()
    {
        return $this->hasMany('App\Payment', 'student_id', 'id');
    }

    public function fullInfo(int $student_id = 0) : Object
    {
        if ( $student_id == 0) {
            return Student::with('studentInfo')->with('paymentInfo');
        }

        $student    = Student::where('student_id', $student_id)
                    ->with('studentInfo')->with('paymentInfo');
        return $student;
    }

    /**
     * Undocumented function
     *
     * @param Array $auth
     * @param Array $request
     * @return void
     */
    public function updateStudent(Object $auth, Object $request)
    {
        $user_id        = $auth->id;
        $dob            = $request->dob;
        $lga            = $request->lga;
        $city           = $request->city;
        $state          = $request->state;
        $country        = $request->country;
        $address        = $request->address;
        $student_no     = $request->student_no;
        $phone_no       = $request->phone_number;
        $studentid      = $request->studentID;
        $programme      = $request->programme;

        $student                = Student::find($studentid);
        $student->dob           = $dob;
        $student->phone         = $phone_no;
        $student->address       = $address;
        $student->state         = $state;
        $student->lga           = $lga;
        $student->country       = $country;
        $student->programme     = $programme;
        $student->save();
    }

    public function admission(int $student_id, String $status)
    {
        return $this->where('student_id', $student_id)
        ->update(['admission_status' => $status]);
    }
}
