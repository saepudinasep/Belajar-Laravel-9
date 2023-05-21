@extends('layouts.mainlayout')

@section('title', 'Detail Students')
{{-- @section('hover', 'active') --}}

@section('content')

    <h2>Anda sedang melihat data detail dari siswa yang bernama {{ $student->name }}</h2>

    <div class="my-3 d-flex justify-content-center">
        @if ($student->image != '')
            <img src="{{ asset('storage/photo/'.$student->image) }}" alt="" width="200">
        @else
            <i class="fas fa-user-circle"></i>
        @endif
    </div>

    <table class="table table-bordered mt-5">
        <tr>
            <th>NIS</th>
            <th>Gender</th>
            <th>Class</th>
            <th>Homeroom Teacher</th>
        </tr>
        <tr>
            <td>{{ $student->nis }}</td>
            <td>
                @if ($student->gender == 'P')
                    Perempuan
                    @else
                    Laki - Laki
                @endif
            </td>
            <td>{{ $student->class->name }}</td>
            <td>{{ $student->class->homeroomTeacher->name }}</td>
        </tr>
    </table>

    <div class="">
        <h3>Extracurriculars</h3>
        <ol>
            @foreach ($student->extracurriculars as $item)
            <li>{{ $item->name }}</li>
            @endforeach
        </ol>
    </div>

@endsection
