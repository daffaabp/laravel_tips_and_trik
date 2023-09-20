<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{
    public function index(){
        $teacher = Teacher::all();
        return view('teacher', ['teacherList' => $teacher]);
    }

    public function show($id){
        $teacher = Teacher::with('class.students')
        ->findOrFail($id);
        return view('teacher-detail', ['teacher' => $teacher]);
    }

    public function create(){
        $teacher = Teacher::select('id', 'name')->get();
        return view('teacher-add', ['teacher' => $teacher]);
    }

    public function store(Request $request){
        $class = Teacher::create($request->all());

        if($class){
            Session::flash('status', 'success');
            Session::flash('message', 'add new Class success!');
        }

        return redirect('/teacher');
    }

    public function edit(Request $request, $id){
        $teacher = Teacher::findOrFail($id);

        return view('/teacher-edit', ['teacher' => $teacher]);
    }

    public function update(Request $request, $id){
        $teacher = Teacher::findOrFail($id);

        $teacher->update($request->all());
        return redirect('/teacher');
    }

    public function delete($id){
        $teacher = Teacher::findOrFail($id);
        return view('teacher-delete', ['teacher' => $teacher]);
    }

    public function destroy($id){
        $deletedTeacher = Teacher::findOrFail($id);
        $deletedTeacher->delete();

        if($deletedTeacher){
            Teacher::flash('status', 'success');
            Teacher::flash('message', 'delete teacher success!');
        }

        return redirect('/teacher');
    }
}
