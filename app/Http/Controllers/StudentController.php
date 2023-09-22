<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCreateRequest;
use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // Ini adalah cara Lazy Loading
        // $student = Student::all();
        // return view('student', ['studentList' => $student]);

        // Ini adalah cara Eager Loading --> lebih cepat
        $keyword = $request->keyword;
        $student = Student::with('class')
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('gender', $keyword)
            ->orWhere('nis', 'LIKE', '%' . $keyword . '%')
            ->orWhereHas('class', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->paginate(10);
        return view('student', ['studentList' => $student]);

        // $data1 = collect(['Tarwan', 'Nuni']);
        // $collection = $data1->concat(['Yeni', 'Amni', 'Yono']);

        // dd($collection->all());

        // Method Combine
        // $keys = collect(['name', 'account', 'address']);
        // $values = collect(['Yusuf', '101020005', 'Jakarta']);

        // $collection = $keys->combine($values);
        // dd($collection->all());

        // $nilai = [9,8,7,6,4,8,9,1,10,3,9,7,1,5,3,9];
        // kita akan mencari tahu hasil dari nilai dikalikan dengan 2 dari data-data yang ada di array $nilai
        // PHP biasa
        // $nilaiKaliDua = [];
        // foreach ($nilai as $value) {
        //     array_push($nilaiKaliDua, $value * 2);
        // };
        // dd($nilaiKaliDua);

        // Collection
        // $aaa = collect($nilai)->map(function ($value) {
        //     return $value * 2;
        // })->all();
        // dd($aaa);

        // $biodata = [
        //     ['nama' => 'Hafiz', 'umur' => 17],
        //     ['nama' => 'Aqso', 'umur' => 16],
        //     ['nama' => 'Harun', 'umur' => 20],
        //     ['nama' => 'Yazid', 'umur' => 19]
        // ];

        // $aaa = collect($biodata)->pluck('nama')->all();
        // dd($aaa);

        // $nilai = [9,8,7,6,4,8,9,1,10,3,9,7,1,5,3,9];
        // $aaa = collect($nilai)->filter(function ($value) {
        //     return $value > 7;
        // })->all();

        // dd($aaa);

        // contains = cek apakah sebuah array memiliki sesuatu
        // $aaa = collect($nilai)->contains(function($value) {
        //     return $value < 6;
        // });
        // dd($aaa);

        // $restaurantA = ["burger", "siomay", "pizza", "spaghetti", "makaroni", "martabak", "bakso"];
        // $restaurantB = ["pizaa", "fried chicken", "martabak", "sayur asem", "pecel lele", "bakso"];

        // $menuRestoA = collect($restaurantA)->diff($restaurantB);
        // dd($menuRestoA);
    }

    public function show($slug)
    {
        $student = Student::with(['class.homeroomTeacher', 'extracurriculars'])
            ->where('slug', $slug)->first(); // method findOrFail berfungsi untuk jika ada akan ia tampilkan datanya, tapi jika tidak ada dia akan menampilkan Not Found
        return view('student-detail', ['student' => $student]);
    }

    public function create()
    {
        $class = ClassRoom::select('id', 'name')->get();
        return view('student-add', ['class' => $class]);
    }

    public function store(StudentCreateRequest $request)
    {

        // $validated = $request->validate([
        //     'nis ' => 'unique:students|max:9|required',
        //     'name' => 'max:50|required',
        //     'gender' => 'required',
        //     'class_id' => 'required'
        // ]);

        // Ini pake cara biasa
        //  $student = new Student;
        // $student->name = $request->name;
        // $student->gender = $request->gender;
        // $student->nis = $request->nis;
        // $student->class_id = $request->class_id;
        // $student->save();

        // Ini pake cara Mass Assignment
        $newName = '';

        if ($request->file('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('photo', $newName);
        }

        $request['image'] = $newName;
        $student = Student::create($request->all());

        if ($student) {
            Session::flash('status', 'success');
            Session::flash('message', 'add new student success!');
        }
        return redirect('/students');
    }

    public function edit(Request $request, $slug)
    {
        $student = Student::with('class')->where('slug', $slug)->first();
        $class = ClassRoom::where('id', '!=', $student->class_id)->get(['id', 'name']);
        return view('student-edit', ['student' => $student, 'class' => $class]);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $student->update($request->all());
        return redirect('/students');
    }

    public function delete($slug)
    {
        $student = Student::where('slug', $slug)->first();
        return view('student-delete', ['student' => $student]);
    }

    public function destroy($id)
    {
        $deletedStudent = Student::findOrFail($id);
        $deletedStudent->delete();

        if ($deletedStudent) {
            Session::flash('status', 'success');
            Session::flash('message', 'delete student success!');
        }

        return redirect('/students');
    }

    public function deletedStudent()
    {
        $deletedStudent = Student::onlyTrashed()->get();

        return view('student-deleted-list', ['student' => $deletedStudent]);
    }

    public function restore($id)
    {
        $deletedStudent = Student::withTrashed()->where('id', $id)->restore();

        if ($deletedStudent) {
            Session::flash('status', 'success');
            Session::flash('message', 'restore student success!');
        }

        return redirect('/students');
    }

    public function massUpdate()
    {
        $student = Student::all();
        collect($student)->map(function ($item) {
            $item->slug = Str::slug($item->name, '_');
            $item->save();
        });
    }
}
