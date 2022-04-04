<?php

namespace App\Imports\Employee;

use App\Models\Employees\Employee;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements  ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $now = new DateTime();

        return new Employee([
            //
            'nip' => $row['nip'],
            'nik' => $row['nik'],
            'name' => $row['name'],
            'gender' => $row['gender'],
            'birthdate' => Carbon::parse($row['birthdate'])->format('Y-m-d'),
            'birthplace' => $row['birthplace'],
            'address' => $row['address'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'organization' => $row['organization'],
            'division' => $row['division'],
            'department' => $row['department'],
            'position' => $row['position'],
            'manager_id' => $row['manager_id'],
            'start_at' => Carbon::parse($row['start_at'])->format('Y-m-d'),
            'created_by' => '1',
            // 'created_by' => Auth::user()->id,
            'created_at'=>$now,
            'updated_at'=>$now,
        ]);
    }
}
