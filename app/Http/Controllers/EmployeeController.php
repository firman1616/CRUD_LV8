<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    function index()
    {
        $data = Employee::all();
        return view("datapegawai", compact('data'));
    }

    function tambahpegawai()
    {
        return view("tambahdata");
    }

    function insertdata(Request $request)
    {
        // dd($request->all());
        Employee::create($request->all());
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Di Tambahkan');
    }
}
