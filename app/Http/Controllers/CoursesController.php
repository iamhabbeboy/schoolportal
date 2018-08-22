<?php

namespace App\Http\Controllers;

use App\Courses;
use App\CoursesRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    public function __construct(Courses $course, Auth $auth, CoursesRegister $cr)
    {
        $this->course           = $course;
        $this->auth             = $auth;
        $this->course_register  = $cr;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->has('panel_user')) {
            $login = true;
         } else {
            $login = false;
         }

        if( array_get($_GET, 'year')
            && array_get($_GET, 'semester')
        ) {
            $year       = array_get($_GET, 'year');
            $semester   = array_get($_GET, 'semester');
            $courses = $this->course->allCourse($year, (int)$semester);
        } else {
            $courses = $this->course->allCourse('year-1', 1);
        }
        $courses = $courses->get();
        return view('course', ['courses' => $courses, 'login' => $login]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Courses $courses)
    {
        $this->validate($request, [
            'year'      => 'required|string',
            'semester'  => 'required|string',
            'code'      => 'required|string',
            'unit'      => 'required|string'
        ]);
        $callback = $courses->create($request);
        return redirect()->route('course', ['rel' => array_get($callback, 'status')]);
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
     * @param  \App\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function show(Courses $courses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function edit(Courses $courses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courses $courses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courses $courses)
    {
        //
    }

    public function courseRegister()
    {
        $year = 'year-1';
        $semester = 1;
        $courses = $this->course->allCourse($year, (int)$semester)
        ->get();
        #-----------
        $student_id     = $this->auth::user()->id;
        $orm = $this->course_register::registerCourse($student_id);

        return view('courses-register', [
            'courses' => $courses,
            'register' => $orm->get()->toArray(),
            'payment_status' => true
        ]);
    }

    public function studentCourseAdd(Request $request)
    {
        $courses        = $request->courses;
        if( count( $courses) > 0 ) {
            foreach($courses as $course ) {
                $year           = $request->year;
                $semester       = $request->semester;
                $student_id     = $this->auth::user()->id;
                $course_split   = explode('-', $course);
                $course_id      = $course_split[0];
                $this->course_register->addCourses($student_id, $year, $semester, $course_id);
            }
            return redirect()->route('course-register', ['rel' => 'save']);
        }
    }
}
