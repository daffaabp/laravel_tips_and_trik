@extends('layouts.mainlayout')
@section('title', 'Students')

@section('content')
    <h1>Ini Halaman Students</h1>

    <div class="my-5 d-flex justify-content-between">
        <a href="student-add" class="btn btn-primary">Add Data</a>
        <a href="student-deleted" class="btn btn-info">Show Deleted Data</a>
    </div>

    @if (Session::has('status'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <h3>Student List</h3>

    <div class="my-5 col-12 col-sm-8 col-md-5">
        <form action="" method="get" class="input-group flex-nowrap mb-3">
            <input type="text" class="form-control" placeholder="Keyword" name="keyword" aria-label="Search"
                aria-describedby="addon-wrapping">
            <button class="input-group-text btn btn-primary" id="addon-wrapping">Search</button>
        </form>
    </div>

    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>NIS</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($studentList as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->gender }}</td>
                        <td>{{ $data->nis }}</td>
                        <td class="text-center">
                            @if (Auth::user()->role_id != 1 && Auth::user()->role_id != 2)
                                -
                            @else
                                <a href="student-detail/{{ $data->name }}">
                                    <button type="button" class="btn btn-primary">Detail</button>
                                </a>

                                <a href="student-edit/{{ $data->id }}">
                                    <button type="button" class="btn btn-warning">Edit</button>
                                </a>
                            @endif

                            @if (Auth::user()->role_id == 1)
                                <a href="student-delete/{{ $data->id }}">
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="my-5">
        {{ $studentList->withQueryString()->links() }}
    </div>
@endsection
