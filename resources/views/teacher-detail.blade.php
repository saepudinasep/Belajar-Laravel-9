@extends('layouts.mainlayout')

@section('title', 'Detail Teacher')
{{-- @section('hover', 'active') --}}

@section('content')


    <h2>Anda sedang melihat data detail dari teacher yang bernama {{ $teacher->name }}</h2>

    <div class="mt-5">
        <h3>
            Class :
            @if ($teacher->class)
                {{ $teacher->class->name }}
            @else
                -
            @endif
        </h3>
    </div>

    <div class="mt-5">
        <h4>List Students</h4>
        <ol>
            @foreach ($teacher->class->students as $item)
                <li>{{ $item->name }}</li>
            @endforeach
        </ol>
    </div>

    {{-- {{ $teacher->class->students->name }} --}}

@endsection
