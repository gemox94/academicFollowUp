<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherStudentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('TeacherStudents.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('TeacherStudents.create');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function find(Request $request){
        $response = [];
        $status_code = 200;
        try{

            $student = User::where('key', $request->input('matricula'))->where('role_id',3)->first();
            $subjects = User::where('teacher_id', Auth::user()->id)->get();
            if ($student){
                $response['student'] = $student;
                $response['subjects'] = $subjects;
                $response['status_code'] = $status_code;
            }else{
                $status_code = 404;
                $response['status_code'] = $status_code;
                $response['message'] = 'Estudiante no encontrado';
            }

        }catch (\Exception $e){
            $status_code = 500;
            $response['status_code'] = $status_code;
            $response['error'] = $e;
        }

        return response()->json($response);
    }
}
