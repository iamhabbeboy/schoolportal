<?php

namespace App\Http\Controllers;

use App\Result;
use App\Grades;
use App\Student;
use App\SchoolAttended;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function __construct(
        Grades $grade, Result $result,
        Auth $auth, SchoolAttended $sa,
        Student $student
    )
    {
        $this->grade    = $grade;
        $this->result   = $result;
        $this->auth     = $auth;
        $this->sa       = $sa;
        $this->student  = $student;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grade = ['A1', 'B2', 'B3', 'C4', 'C5', 'C6', 'D7', 'E8', 'F9'];
        $subject = $this->grade->allSubject()->get();

        $student_id  = $this->auth::User()->id;
        $student = $this->student->fullInfo($student_id);
        $student = $student->first()->toArray();
     
        return view('result', [
            'grade'      => $grade,
            'subjects'   => $subject,
            'payment_status'    => true,
            'student'       => $student
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'school_name'   => 'required|string',
            'school_from'   => 'required|string',
            'school_to'     => 'required|string'
        ]);

        $school_name    = $request->school_name;
        $school_from    = $request->school_from;
        $school_to      = $request->school_to;

        $subjects       = $request->subject;
        $grade          = $request->grade;
        $concat         = "";

        if( count( $subjects ) > 0 ) {
            foreach( $subjects as $key => $subject) {
                $concat .= $subject.":". $grade[$key].",";
            }
        }
        $concat = substr( $concat, 0, strlen($concat) -1);

        $student_id = $this->auth::user()->id;
        $this->result->addResult($student_id, $request, $concat);
        $this->sa->addSchool($student_id, $request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }
}
