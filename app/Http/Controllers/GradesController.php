<?php

namespace App\Http\Controllers;

use App\Grades;
use Illuminate\Http\Request;

class GradesController extends Controller
{

    public function __construct(Grades $grades)
    {
        $this->grades = $grades;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Grades  $grades
     * @return \Illuminate\Http\Response
     */
    public function show(Grades $grades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grades  $grades
     * @return \Illuminate\Http\Response
     */
    public function edit(Grades $grades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grades  $grades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grades $grades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grades  $grades
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = $this->grades->find($id)->delete();
        return $query;
    }

    public function addResult(Request $request)
    {
        $this->validate($request, [
            'subject'   => 'required|string'
        ]);

        $name = $request->subject;
        $id   = $request->subject_id;

        if( $id != '0' ) {
            $this->grades->find($id);
            $this->grades->name = $name;
            $this->grades->save();
            return redirect()->route('olevel', ['rel' => '3']);
        } else {

            $sql = $this->grades->where('name', $name);

            if( $sql->count() > 1) {
                return redirect()->route('olevel', ['rel' => '0']);
            }
            $this->grades->name = $name;
            $this->grades->save();
            return redirect()->route('olevel', ['rel' => '1']);
        }
    }

    public function result()
    {
        $edit_title = '';
        $edit_id    = 0;
        $login      = true;

        if( array_get($_GET, 'rel') == 'delete') {
            $subject_id = array_get($_GET, 'subject_id');
            $this->destroy($subject_id);
            return redirect()->route('olevel');
        }

        if( array_get($_GET, 'rel') == 'edit') {
            $title = array_get($_GET, 'subject_title');
            $id = array_get($_GET, 'subject_id');
            $edit_title = $title;
            $edit_id    = $id;
        }

        $olevel = $this->grades->allSubject()->get();
        return view('olevel', [
            'olevel' => $olevel,
            'title' => $edit_title,
            'id'    => $edit_id,
            'login'  => $login,
        ]);
    }
}
