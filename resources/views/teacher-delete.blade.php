@extends('layouts.mainlayout')
@section('title', 'Delete Teacher')

@section('content')
    <div class="mt-5">
        <h2>Are you sure to Delete Data : {{ $teacher->name }}</h2>

        <form style="display: inline-block;" action="/teacher-destroy/{{ $teacher->id }}" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-danger">Delete</button>
        </form>

        <a href="/teacher" class="btn btn-primary">Cancel</a>
    </div>
@endsection
