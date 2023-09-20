@extends('layouts.mainlayout')
@section('title', 'Home')

@section('content')
    <h1>Ini Halaman Home</h1>
    <h2>Selamat Datang, {{ Auth::user()->name }}. Anda adalah {{ Auth::user()->role->name }} </h2>

    {{-- @if ($role == 'admin')
            <a href="">ke halaman admin</a>
        @elseif ($role == 'staff')
            <a href="">ke halaman gudang</a>
        @else
            <a href="">ke halaman whatever</a>
        @endif
        <button class="btn btn-primary">Home</button> --}}

    {{-- @switch($role)
            @case($role == 'admin')
                <a href="">ke halaman admin</a>
            @break

            @case($role == 'staff')
                <a href="">ke halaman admin</a>
            @break

            @default
                <a href="">ke halaman whatever</a>
        @endswitch --}}

    {{-- <table class="table">
        <tr>
            <th>No.</th>
            <th>Nama</th>
        </tr>
        @foreach ($buah as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data }}</td>
            </tr>
        @endforeach
    </table> --}}

    <x-alert message='ini adalah halaman Home' type='success' />
@endsection
