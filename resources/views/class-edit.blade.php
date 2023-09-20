@extends('layouts.mainlayout')
@section('title', 'Edit Class')

@section('content')
    <h1>Ini Halaman Edit Class</h1>

    <div class="mt-5 col-8 m-auto">
        <form action="/class/{{ $class->id }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name">Name Class :</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $class->name }}" required>
            </div>

            <div class="mb-3">
                <label for="teacher">Teacher :</label>
                <select name="teacher_id" id="teacher" class="form-control" required>
                    <option value="{{ $class->homeroomTeacher->id }}">{{ $class->homeroomTeacher->name }}</option>
                    @foreach ($teacher as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>
@endsection
