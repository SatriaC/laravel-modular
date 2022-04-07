<?php

namespace GTI\Attendance\Controllers;

use App\Http\Controllers\Controller;
use GTI\Attendance\Services\AttendanceService;
use GTI\OrganizationStructure\Services\DepartmentService;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    protected $service;

    public function __construct(
        AttendanceService $service
    )
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        # code...
        return $this->service->index($request);
    }

    public function show($id)
    {
        # code...
        return $this->service->show($id);
    }

    public function statistic(Request $request)
    {
        # code...
        return $this->service->statistic($request);
    }

    public function checkIn(Request $request)
    {
        # code...
        return $this->service->checkIn($request);
    }

    public function checkOut(Request $request, $id)
    {
        # code...
        return $this->service->checkOut($request, $id);
    }

    public function approve(Request $request, $id)
    {
        # code...
        return $this->service->approve($request, $id);
    }

    public function reject(Request $request, $id)
    {
        # code...
        return $this->service->reject($request, $id);
    }
}
