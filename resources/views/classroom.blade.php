@extends('layouts.mainlayout')

@section('title', 'Class')
{{-- @section('hover', 'active') --}}

@section('content')

<h1>Ini Halaman Class</h1>

<div class="my-5">
    <a href="" class="btn btn-primary">Add Data</a>
</div>

<h3>Class List</h3>
<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($classList as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->name}}</td>
            <td><a href="class-detail/{{ $data->id }}">Detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- <ol>
    @foreach($classList as $data)
    <li>{{$data->name}}</li>
    @endforeach
</ol> -->
@endsection
