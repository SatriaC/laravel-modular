<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\EmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    protected $service;

    public function __construct(
        EmployeeService $service
    )
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        # code...
        return $this->service->index($request);
    }

    public function store(EmployeeRequest $request)
    {
        # code...
        return $this->service->store($request);
    }

    public function update(Request $request, $id)
    {
        # code...
        return $this->service->update($request, $id);
    }

    public function show($id)
    {
        # code...
        return $this->service->show($id);
    }

    public function destroy($id)
    {
        # code...
        return $this->service->destroy($id);
    }

    public function import(Request $request)
    {
        # code...
        return $this->service->import($request);
    }

    public function export()
    {
        # code...
        return $this->service->export();
    }
}
