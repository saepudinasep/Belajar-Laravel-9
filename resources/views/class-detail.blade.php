@extends('layouts.mainlayout')

@section('title', 'Detail Class')
{{-- @section('hover', 'active') --}}

@section('content')


    <h2>Anda sedang melihat data detail dari class {{ $class->name }}</h2>

    <div class="mt-5">
        <strong>Homeroom Teacher : {{ $class->homeroomTeacher->name }}</strong>
    </div>

    <div class="mt-5">
        <h4>Student List</h4>
        <ol>
            @foreach ($class->students as $item)
                <li>{{ $item->name }}</li>
            @endforeach
        </ol>
    </div>

@endsection
