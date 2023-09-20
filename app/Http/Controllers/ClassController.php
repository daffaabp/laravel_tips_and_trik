<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Teacher;
use Illuminate\Http\Request;
use PhpParser\Builder\Class_;

class ClassController extends Controller
{
    public function index()
    {
        // Lazy Load --> cara request data --> ketika dibutuhkan ambil data
        // $class = ClassRoom::all();
        // select * from table class
        // select * from student where class = 1A
        // select * from student where class = 1B
        // select * from student where class = 1C
        // select * from student where class = 1D

        // Eager Load --> cara request data --> lebih cepat
        $class = ClassRoom::get();
        // select * from table class
        // select * from student where class in (1A, 1B, 1C, 1D)
        return view('classroom', ['classList' => $class]);
    }

    public function show($id) {
        $class = ClassRoom::with(['students', 'homeroomTeacher'])
        ->findOrFail($id);
        return view('class-detail', ['class' => $class]);
    }

    public function create(){
        $teacher = Teacher::select('id', 'name')->get();
        return view('class-add', ['teacher' => $teacher]);
    }

    public function store(Request $request){
        $class = ClassRoom::create($request->all());
        return redirect('/class');
    }

    public function edit(Request $request, $id){
        $class = ClassRoom::with('homeroomTeacher')->findOrFail($id);
        $teacher = Teacher::where('id', '!=', $class->teacher_id)->get(['id', 'name']);
        return view('class-edit', ['class' => $class, 'teacher' => $teacher]);
    }

    public function update(Request $request, $id){
        $class = ClassRoom::findOrFail($id);

        $class->update($request->all());
        return redirect('/class');
    }

    public function delete($id){
        $class = ClassRoom::findOrFail($id);
        return view('class-delete', ['class' => $class]);
    }

    public function destroy($id){
        $deletedClass = ClassRoom::findOrFail($id);
        $deletedClass->delete();

        return redirect('/class');
    }
}