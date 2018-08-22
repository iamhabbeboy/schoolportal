<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Payment $payment, Auth $auth, Student $student)
    {
        $this->payment  = $payment;
        $this->student  = $student;
        $this->auth     = $auth;
    }

    public function processing(Request $request)
    {
        if( ! $this->auth::check() ) {
           return [];
        }

        $orderRef   = $request->reference;
        $status     = $request->status;
        $user_id    = $this->auth::user()->id;
        $amount     = array_get($_GET, 'amt', '');
        $type       = array_get($_GET, 'type', '');


        $this->payment->student_id      = $user_id;
        $this->payment->payment_type    = $type;
        $this->payment->amount          = $amount;
        $this->payment->status          = $status;
        $this->payment->currency        = 'NGN';
        $this->payment->ref_num         = $orderRef;
        $this->payment->save();
        return [
            'status' => 'success'
        ];

    }

    public function history()
    {
        $user_id    = $this->auth::user()->id;
        $query      = $this->payment->paymentHistory($user_id);
        $to_array   = $query->get()->toArray();
        return view('payment-history', [
            'payment_status' => true,
            'history' => $to_array
        ]);
    }

    public function print()
    {
        $user_id    = $this->auth::user()->id;
        $student    = $this->student->fullInfo($user_id);
        return view('print', ['student' => $student->first()->toArray()]);
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
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
