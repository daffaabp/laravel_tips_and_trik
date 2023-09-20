@extends('layouts.mainlayout')
@section('title', 'Teacher')

@section('content')
    <h1>Ini Halaman Teacher</h1>

    <div class="my-5">
        <a href="teacher-add" class="btn btn-primary">Add Data</a>
    </div>

    @if (Session::has('status'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <h3>Teacher List</h3>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($teacherList as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <a href="teacher-detail/{{ $item->id }}">
                            <button type="button" class="btn btn-primary">Detail</button>
                        </a>
                        <a href="teacher-edit/{{ $item->id }}">
                            <button type="button" class="btn btn-warning">Edit</button>
                        </a>
                        <a href="teacher-delete/{{ $item->id }}">
                            <button type="button" class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
