<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {

        // lazy load
        // $class = ClassRoom::all(); // cara request data => ketika dibutuhkan ambil data
        // select * from table class
        // select * from students where class = 1A
        // select * from students where class = 1B

        // eager load
        $class = ClassRoom::get(); //cara request data
        // select * from table class
        // select * from students where class in (1a,1b)
        // dd($student);
        return view('classroom', ['classList' => $class]);
    }

    public function show($id)
    {
        $class = ClassRoom::with('students', 'homeroomTeacher')->findOrFail($id);
        return view('class-detail', ['class' => $class]);
    }
}
