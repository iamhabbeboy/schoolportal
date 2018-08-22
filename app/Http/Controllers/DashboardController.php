<?php

namespace App\Http\Controllers;

use App\Dashboard;
use App\Student;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Payment $payment, Student $student)
    {
        $this->payment = $payment;
        $this->student = $student;
    }

    public function index()
    {
        if( ! Auth::check()) {
            return redirect()->route('homepage');
        }
        $student_id = Auth::user()->id;
        $student = $this->student->fullInfo($student_id)
        ->get()->toArray();
        $payment_status = $this->payment
        ->where('student_id', $student_id)
        ->where('status', 'success');
        $status = ( $payment_status->count() > 0 )
        ? $payment_status->first() : [];

        return view('dashboard', [
            'students'          => $student[0],
            'payment_status'    => $status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admission()
    {
        $student_id = Auth::user()->id;
        $student = $this->student->fullInfo($student_id)
        ->first()->toArray();
        return view('admission', ['student' => $student, 'payment_status' => true]);
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
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }

    public function admissionLetter()
    {
        $student_id = Auth::user()->id;
        $student = $this->student->fullInfo($student_id)
        ->first()->toArray();
        return view('admission_letter', ['student' => $student]);
    }
}
