<?php

namespace App\Http\Controllers;
use App\State;
use App\Local;
use App\Forms;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Local $local)
    {
        $this->local = $local;
    }
    public function index()
    {
        $callback = array_get($_GET, 'rel', '');
        return view('form', [
            'payment_callback' => $callback
        ]);
    }

    public function redirect(Request $request)
    {
        dd($request);
    }

    public function redirectToGateway(Paystack $paystack)
    {
        return $paystack::getAuthorizationUrl()->redirectNow();
    }

    public function handleGatewayCallback(Paystack $paystack)
    {
        $paymentDetails = $paystack::getPaymentData();

        // dd($paymentDetails);
    }

    public function ajaxLocalGovernment(Request $request)
    {
        $state_id   = $request->state_id;
        $local      = $this->local->where('state_id', $state_id);
        if( $local->count() < 1  ) {
            $response = ['status' => 'empty'];
            return response()->json($response);
        }
        $response = ['status' => 'success',
        'data' => $local->get()->toArray()];
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Forms  $forms
     * @return \Illuminate\Http\Response
     */
    public function show(Forms $forms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Forms  $forms
     * @return \Illuminate\Http\Response
     */
    public function edit(Forms $forms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Forms  $forms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forms $forms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Forms  $forms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forms $forms)
    {
        //
    }
}
