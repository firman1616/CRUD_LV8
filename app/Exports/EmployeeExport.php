<?php

namespace App\Exports;


use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EmployeeExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Employee::query();
    }

    public function map($employee): array
    {
        $x = 1;
        return [
            $x++,
            $employee->nama,
            $employee->jenis_kelamin,
            $employee->no_telp
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama Pegawai',
            'Jenis Kelamin',
            'No Telphone'
        ];
    }
}
// class EmployeeExport implements FromCollection
// {
//     use Exportable;

//     public function collection()
//     {
//         return Employee::all();
//     }
// }
