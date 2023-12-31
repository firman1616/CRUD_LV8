<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Employee::where('nama', 'LIKE', '%' . $request->search . '%')->paginate(5);
            Session::put('halaman_url',request()->fullUrl());
        } else {
            $data = Employee::paginate(5);
            Session::put('halaman_url',request()->fullUrl());
        }

        return view("datapegawai", compact('data'));
    }

    function tambahpegawai()
    {
        return view("tambahdata");
    }

    function insertdata(Request $request)
    {
        // dd($request->all());
        $data = Employee::create($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Di Tambahkan');
    }

    function tampilkandata($id)
    {
        $data = Employee::find($id);

        return view("tampildata", compact('data'));
    }

    function updatedata(Request $request, $id)
    {
        $data = Employee::find($id);
        $data->update($request->all());
        if (session('halaman_url')) {
            return Redirect(session('halaman_url'))->with('success', 'Data Berhasil Di Update');
        }
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Di Update');
    }

    function delete($id)
    {
        $data = Employee::find($id);
        $data->delete();
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Di Hapus');
    }

    function exportpdf()
    {
        $data = Employee::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('datapegawai-pdf');
        return $pdf->download('data.pdf');
    }

    function exportexcel()
    {
        return Excel::download(new EmployeeExport, 'datapegawai.xlsx');
    }

    function importexcel(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('EmployeeData', $namafile);
        Excel::import(new EmployeeImport, \public_path('/EmployeeData/' . $namafile));
        return redirect()->route('pegawai');
    }
}
