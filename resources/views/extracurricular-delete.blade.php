@extends('layouts.mainlayout')
@section('title', 'Delete Extracurricular')

@section('content')
    <div class="mt-5">
        <h2>Are you sure to Delete Extracurricular : {{ $ekskul->name }}</h2>

        <form style="display: inline-block;" action="/extracurricular-destroy/{{ $ekskul->id }}" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-danger">Delete</button>
        </form>

        <a href="/class" class="btn btn-primary">Cancel</a>
    </div>
@endsection
