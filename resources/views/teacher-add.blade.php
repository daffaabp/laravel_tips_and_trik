@extends('layouts.mainlayout')
@section('title', 'Add New Teacher')

@section('content')
    <h1>Ini Halaman Add Teacher</h1>

    <div class="mt-5 col-8 m-auto">
        <form action="teacher" method="post">
            @csrf
            <div class="mb-3">
                <label for="name">Name Teacher :</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="mb-3">
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        </form>
    </div>
@endsection
