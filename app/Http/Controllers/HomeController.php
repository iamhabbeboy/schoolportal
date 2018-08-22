<?php

namespace App\Http\Controllers;

use DB;
use App\Student;
use App\State;
use App\Local;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(State $state, Local $local)
    {
        $this->state    = $state;
        $this->local    = $local;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $state_listing  = $this->state->all();
        $local_listing  = $this->local->all();
        $student        = $this->userInfo()->first();
        $params         =  array_get($_GET, 'rel', '');

        return view('home', [
            'student'           => $student->toArray(),
            'params'            => $params,
            'states'            => $state_listing,
            'locals'            => $local_listing,
            'payment_status'    => true
        ]);
    }

    public function userInfo()
    {
        if( ! Auth::check() ) {
            return false;
        }

        $student_id = Auth::user()->id;
        $student_full = (new Student)->fullInfo($student_id);
        return $student_full;
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function userProfile(Request $request)
    {
        // $this->validate($request, [
        //     'dob'           => 'required|string',
        //     'phone_number'  => 'required|string',
        //     'country'       =>  'required|string',
        //     'state'         =>  'required|string',
        //     'lga'           =>  'required|string',
        //     'city'          =>  'required|string',
        //     'address'       =>  'required|string'
        // ]);

        return $this->userData($request);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function userData(Object $request)
    {

        if( ! Auth::check() ) {
            return false;
        }

        $auth    = Auth::user();
        $student = (new Student)->updateStudent($auth, $request);
        return redirect()->route('home', ['rel' => 'success']);
    }

    public function ajaxPhoto(Request $request)
    {
        $id       = Auth::user()->id;
        $file      = $request->file('photo');
        $filename  = $file->getClientOriginalName();
        $rename   = rand(5, 100000).'_';
        $rename  .= str_replace(' ', '_', strtolower($filename));

        $destination = (!is_dir("uploads/") )
                      ? mkdir('uploads/') : 'uploads/';

        $picture = ( $destination != '' )
        ? 'uploads/'.$rename : $destination.$rename;

        $file->move("uploads/", $rename);

        $student = DB::table('students')->where('student_id', $id)
        ->update(['picture' => $picture]);

        echo '<img src="uploads/'.$rename.'" border="0" width="200" height="190">';
    }

}
