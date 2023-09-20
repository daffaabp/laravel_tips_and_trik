@extends('layouts.mainlayout')
@section('title', 'Edit Teacher')

@section('content')
    <h1>Ini Halaman Edit Teacher</h1>

    <div class="mt-5 col-8 m-auto">
        <form action="/teacher/{{ $teacher->id }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name">Name Teacher :</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $teacher->name }}" required>
            </div>

            <div class="mb-3">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>
@endsection
