@extends('layouts.mainlayout')
@section('title', 'Students Detail')

@section('content')
    <h3>Anda sedang melihat data detail dari class {{ $class->name }}</h3>

    <div class="mt-5">
        <h4>Homeroom Teacher : {{ $class->homeroomTeacher->name }}</h4>
    </div>

    <div class="mt-5">
        <h5>List Student</h5>
        <ol>
            @foreach ($class->students as $item)
                <li>
                    {{ $item->name }}
                </li>
            @endforeach
        </ol>
    </div>
@endsection
