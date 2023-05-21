<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\StudentCreateRequest;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // untuk var_dump bawaan laravel
        // dd('test');
        // $nama = 'budi';
        // return view('student', ['nama' => $nama]);
        // eloquent orm(recomended)
        // query builder
        // raw query(not recomended)
        // dd($student);

        // Query Builder
        // $student = DB::table('students')->get();
        // dd($student);
        // create data
        // DB::table('students')->insert([
        //     'name' => 'query builder',
        //     'gender' => 'L',
        //     'nis' => '0201021',
        //     'class_id' => 1
        // ]);
        // // update data
        // DB::table('students')->where('id', 16)->update([
        //     'name' => 'Query Builder',
        //     'class_id' => 3
        // ]);
        // delete data
        // DB::table('students')->where('id', 16)->delete();

        // Eloquent
        // $student = Student::all();
        // dd($student);
        // create data
        // Student::create([
        //     'name' => 'eloquent',
        //     'gender' => 'P',
        //     'nis' => '0201033',
        //     'class_id' => 2
        // ]);
        // update data
        // Student::find(17)->update([
        //     'name' => 'Eloquents',
        //     'class_id' => 1
        // ]);
        // delete data
        // Student::find(17)->delete();


        // $nilai = [9,8,7,6,4,8,9,1,10,3,9,7,1,5,3,9];

        // dd($nilai);
        // hitung rata-rata
        // php biasa
        // $countNilai = count($nilai);
        // $totalNilai = array_sum($nilai);
        // $nilaiRataRata = $totalNilai / $countNilai;
        // dd($nilaiRataRata);

        // collection
        // $nilaiRataRata = collect($nilai)->avg();
        // dd($nilaiRataRata);

        // contains = cek apakah sebuah array memiliki sesuatu
        // $aa = collect($nilai)->contains(function($value){
        //     return $value < 6;
        // });
        // dd($aa);

        // diff = cek apakah data ada/tidak ada di array lain
        // $restaurantA = ["burger", "siomay", "pizza", "spaghetti", "makaroni", "martabak", "bakso"];
        // $restaurantB = ["pizza", "fried chicken", "martabak", "sayur asem", "pecel lele", "bakso"];

        // menu A tidak ada di menu B
        // $menuRestoA = collect($restaurantA)->diff($restaurantB);
        // menu B tidak ada di menu A
        // $menuRestoB = collect($restaurantB)->diff($restaurantA);
        // dd($menuRestoA);

        // filter = untuk menyaring
        // $aa = collect($nilai)->filter(function ($value) {
        //     return $value > 7;
        // })->all();
        // dd($aa);

        // pluck untuk mengambil data array didalam array
        // $biodata = [
        //     ['nama' => 'budi', 'umur' => 17],
        //     ['nama' => 'ani', 'umur' => 16],
        //     ['nama' => 'siti', 'umur' => 17],
        //     ['nama' => 'rudi', 'umur' => 20],
        // ];

        // $aa = collect($biodata)->pluck('umur')->all();
        // dd($aa);

        // map perulangan/looping
        // php biasa
        // $nilaiKaliDua = [];
        // foreach ($nilai as $value) {
        //     array_push($nilaiKaliDua, $value * 2);
        // }
        // dd($nilaiKaliDua);

        // $aa = collect($nilai)->map(function ($value) {
        //     return $value * 2;
        // })->all();
        // dd($aa);



        // $student = Student::all(); or


        // pencarian
        $keyword = $request->keyword;
        $student = Student::with('class')
                    ->where('name', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('gender', $keyword)
                    ->orWhere('nis', 'LIKE', '%'.$keyword.'%')
                    ->orWhereHas('class', function($query) use($keyword){
                        $query->where('name', 'LIKE', '%'.$keyword.'%');
                    })
                    ->paginate(10);

        // eiger loading
        // $student = Student::get();
        // $student = Student::paginate(10);
        // $student = Student::simplePaginate(10);
        return view('student', ['studentList' => $student]);
    }


    public function show($id)
    {
        // $student = Student::find($id);
        $student = Student::with(['class.homeroomTeacher', 'extracurriculars'])
                ->findOrFail($id);
        return view('student-detail', ['student' => $student]);
    }

    public function create()
    {
        $class = ClassRoom::get(['id', 'name']);
        return view('student-add', ['class' => $class]);
    }

    public function store(StudentCreateRequest $request)
    {
        // $student = new Student;
        // $student->name = $request->name;
        // $student->gender = $request->gender;
        // $student->nis = $request->nis;
        // $student->class_id = $request->class_id;

        // $student->save();

        // $validated = $request->validate([
        //     'nis' => 'unique:students|max:8|required',
        //     'name' => 'max:50|required',
        //     'gender' => 'required',
        //     'class_id' => 'required'
        // ]);

        $newName = '';
        if ($request->file('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $newName = $request->name.'-'.now()->timestamp.'.'.$extension;
            $request->file('photo')->storeAs('photo', $newName);
        }

        $request['image'] = $newName;

        // mass assigment
        $student = Student::create($request->all());

        if ($student) {
            Session::flash('status', 'success');
            Session::flash('message', 'add new student success');
        }

        return redirect('/students');
    }

    public function edit(Request $request, $id)
    {
        $student = Student::with('class')->findOrFail($id);
        $class = ClassRoom::where('id', '!=', $student->class_id)->get(['id', 'name']);
        return view('student-edit', ['student' => $student, 'class' => $class]);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        // $student->name = $request->name;
        // $student->gender = $request->gender;
        // $student->nis = $request->nis;
        // $student->class_id = $request->class_id;
        // $student->save();

        $student->update($request->all());

        if ($student) {
            Session::flash('status', 'success');
            Session::flash('message', 'Update student success');
        }

        return redirect('/students');
    }

    public function delete($id)
    {
        $student = Student::findOrFail($id);
        return view('student-delete', ['student' => $student]);
    }

    public function destroy($id)
    {
        // query builder
        // $deleteStudent = DB::table('students')->where('id', $id)->delete();

        // eloquent
        $deleteStudent = Student::findOrFail($id);
        $deleteStudent->delete();
        if ($deleteStudent) {
            Session::flash('status', 'success');
            Session::flash('message', 'Delete student success');
        }
        return redirect('/students');
    }

    public function deletedStudent()
    {
        $deletedStudent = Student::onlyTrashed()->get();
        return view('deletedStudent', ['student' => $deletedStudent]);
    }

    public function restore($id)
    {
        $deletedStudent = Student::withTrashed()->where('id',$id)->restore();
        if ($deletedStudent) {
            Session::flash('status', 'success');
            Session::flash('message', 'Restore student success');
        }
        return redirect('/students');
    }
}
