<?php

namespace App\Http\Controllers;

use App\Panel;
use App\Student;
use App\Payment;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Payment $payment, Student $student, Auth $auth, State $state)
    {
        $this->payment  = $payment;
        $this->student  = $student;
        $this->auth     = $auth;
        $this->state    = $state;
    }

    public function index(Request $request)
    {
        if($request->session()->has('panel_user')) {
           $login = true;
        } else {
           $login = false;
        }
        return view('panel', ['login' => $login]);
    }

    public function students(Request $request)
    {
        $students   = $this->student->fullInfo();
        $students   = $students->get()->toArray();
        $student    = [];

        if( array_get($_GET, 'rel') == 'more') {
            $student_id = array_get($_GET, 'student_id');
            $find_user   = $this->student->fullInfo($student_id)->with('studentResult');
            $student    = $find_user->first()->toArray();
        }

        if($request->session()->has('panel_user')) {
            $login = true;
         } else {
            $login = false;
         }

        return view('students', [
            'students' => $students,
            'student'   => $student,
            'login'     => $login
        ]);
    }

    public function transaction(Request $request)
    {
        if($request->session()->has('panel_user')) {
            $login = true;
         } else {
            $login = false;
         }
        $query = $this->payment->paymentHistory();
        return view('transaction', [
            'data'  => $query->get()->toArray(),
            'login' => $login
        ]);
    }

    public function auth(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required',
            'password'  => 'required'
        ]);

        $email      = $request->email;
        $password   = $request->password;
        $panel      = (new Panel)->auth($email, $password);

        if( empty( $panel ) ) {
            return redirect()->route('panel', ['rel' => 'failed']);
        }

        $session = $request->session()->put('panel_user', $panel);

        return redirect()->route('panel');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('panel_user');
        return redirect()->route('panel');
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
     * @param  \App\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function show(Panel $panel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function edit(Panel $panel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Panel $panel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Panel $panel)
    {
        //
    }

    public function admission(Request $request)
    {
        $student_id = $this->auth::user()->id;
        $status = $request->status;
        $this->student->admission($student_id, $status);
        if($request->session()->has('panel_user')) {
            $login = true;
         } else {
            $login = false;
         }
        return redirect()->route('students', ['rel' => 'status', 'login' => $login]);
    }

    public function csv()
    {
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=students.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $query = $this->student->fullInfo();

        $html = '';
        if ( $query->count() > 0 ) {
            $to_array = $query->get()->toArray();
            $html .= '<table class="table table-bordered">';
            $columns = ['Student No','Full Name', 'Email Address', 'Phone No', 'State','Admission Status', 'Obtain Form'];
            $file = fopen('students.csv', 'w');
            fputcsv($file, $columns);
            foreach( $to_array as $key => $student) {
                $payment_status = $student['payment_info'][count($student['payment_info'])-1];
                $state_info = array_get($student, 'state' ) == null ? 0 : array_get($student, 'state');
                $state = $this->state->findById( $state_info );
                fputcsv($file, [
                    array_get($student, 'student_no'),
                    array_get($student, 'student_info.name'),
                    array_get($student, 'student_info.email'),
                    array_get($student, 'phone'),
                    $state,
                    (( array_get($student, 'admission_status') == '') ? 'Not Admitted' : 'Admitted' ),
                    ( array_get($payment_status, 'status') ? 'Yes' : 'No' )
                ]);
            }
            fclose($file);
        }
        return response()->download("students.csv", 'students.csv', array(
            'content-type' => 'text/csv'
        ));

    }

}
