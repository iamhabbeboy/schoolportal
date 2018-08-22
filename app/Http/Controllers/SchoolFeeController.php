<?php

namespace App\Http\Controllers;

use App\Student;
use App\SchoolFee;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Student $student, State $state)
    {
        $this->student      = $student;
        $this->state        = $state;
        $this->tuition      = [
            'nursing'       => '62000',
            'midwifery'     => '55000',
            'remedial'      => '14000'
        ];
    }

    public function index()
    {
        $payment_callback = '2';
        $payment_status = true;
        if( ! Auth::check() ) {
            return false;
        }

        $student_id = Auth::user()->id;
        $student_full = $this->student->fullInfo($student_id);
        $state_info     = $student_full->first()->toArray();
        $state_name     = $this->state->findById( array_get($state_info, 'state' ) );
        $tuition        = $this->tuitionFee($state_name, $student_full->first()->toArray());
        $response       = $this->tuitionStatus($state_info);

        return view('school-fee', [
            'payment_callback'  => $payment_callback,
            'payment_status'    => $payment_status,
            'student'           => $student_full->first()->toArray(),
            'tuition'           => $tuition,
            'tuition_status'    => $response
        ]);
    }

    private function tuitionStatus(Array $payment_info) : bool
    {
        if( count($payment_info) > 0 ) {

            $status = array_column(array_get($payment_info, 'payment_info'), 'status');
            $type   = array_column(array_get($payment_info, 'payment_info'), 'payment_type');

            if( in_array('tuition', $type) and in_array('success', $status)) {
                return true;
            }
        }
    }

    private function tuitionFee(String $state_name, Array $student) : Int
    {
        $amount = 0;

        if( $state_name != 'Kebbi State' ) {
            if( array_get($student, 'programme') == 'nursing' ) {
                $amount =  $this->tuition[ array_get($student, 'programme')] + 70000;
            } else if( array_get($student, 'programme') == 'midwifery' ) {
                $amount = $this->tuition[ array_get($student, 'programme')] + 70000;
            } else {
                $amount = $this->tuition[ array_get($student, 'programme')] + 10000;
            }
        } else {
            $amount     = $this->tuition[ array_get($student, 'programme')];
        }
        return $amount;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SchoolFee  $schoolFee
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolFee $schoolFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SchoolFee  $schoolFee
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolFee $schoolFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SchoolFee  $schoolFee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolFee $schoolFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SchoolFee  $schoolFee
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolFee $schoolFee)
    {
        //
    }
}
