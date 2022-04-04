<?php

namespace App\Exports\Employee;

use App\Models\Employees\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::all();
    }
}
