@extends('layouts.mainlayout')

@section('title', 'Extracurriculars Detail')


@section('content')

    <h2>Anda sedang melihat data detail dari Extracurriculars {{ $ekskul->name }}</h2>

    <div class="mt-5">
        <h3>
            List Peserta
        </h3>

        <ol>
            @foreach ($ekskul->students as $item)
                <li>{{ $item->name }}</li>
            @endforeach
        </ol>
    </div>

@endsection
