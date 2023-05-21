@extends('layouts.mainlayout')

@section('title', 'Home')

@section('content')

<h1>Ini Halaman Home</h1>
<h2>Selamat Datang {{ Auth::user()->name }}. Anda adalah {{ Auth::user()->role->name }}</h2>



{{--
<!-- @if ($role == 'admin')
        <a href="#">ke halaman admin</a>
        @elseif ($role == 'staff')
        <a href="#">ke halaman gudang</a>
        @else
        <a href="#">ke halaman whatever</a>
        @endif -->

<!-- @switch($role)
        @case($role=='admin')
        <a href="#">ke halaman admin</a>
        @break
        @case($role=='staff')
        <a href="#">ke halaman staff</a>
        @break
        @default
        <a href="#">ke halaman whatever</a>
        @endswitch -->
 --}}

{{-- <!-- @for($i = 0; $i < 5; $i++) {{$i}} <br>
            @endfor --> --}}
{{--
<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
        </tr>
    </thead>
    <tbody>
        @foreach($buah as $data)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$data}}</td>
        </tr>
        @endforeach

    </tbody>
</table> --}}
@endsection
