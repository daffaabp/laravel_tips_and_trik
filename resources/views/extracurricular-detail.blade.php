@extends('layouts.mainlayout')
@section('title', 'Extracurricular Detail')

@section('content')
    <h3>Anda sedang melihat data detail dari extracurricular {{ $ekskul->name }}</h3>

    <div class="mt-5">
        <h3>List Anggota Extracurricular</h3>
        <ol>

            @foreach ($ekskul->students as $item)
                <li>{{ $item->name }}</li>
            @endforeach
        </ol>
    </div>
@endsection
