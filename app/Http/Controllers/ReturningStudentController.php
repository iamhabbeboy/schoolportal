<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReturningStudentController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
    	return view('old-student');
    }

    public function create()
    {

    }
}
