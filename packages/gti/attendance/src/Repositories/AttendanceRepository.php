<?php

namespace GTI\Attendance\Repositories;

use App\Repositories\BaseRepository;
use Carbon\Carbon;
use GTI\Attendance\Models\Attendance;

class AttendanceRepository extends BaseRepository
{
    public function __construct(Attendance $model)
    {
        $this->model = $model;
    }

    public function index($request)
    {
        # code...
        $data = $this->model;

        if (isset($request->user_id)) {
            # code...
            $data->where('user_id', $request->user_id );
        }

        if (isset($request->name)) {
            # code...
            $data->where('name', 'LIKE', '%'.$request->name.'%' );
        }

        if (isset($request->status)) {
            # code...
            $data->where('status', $request->status );
        }

        if(isset($request->start_date) && isset($request->end_date)){
            $start_date = Carbon::parse($request->start_date)->startOfDay();
            $end_date = Carbon::parse($request->end_date)->endOfDay();
            $data->whereBetween('created_at', array($start_date, $end_date));
        }

        if (isset($request->month)) {
            # code...
            $data->whereMonth('date', $request->month );
        }

        if (isset($request->year)) {
            # code...
            $data->whereYear('date', $request->year );
        }

        return $data;
    }

    public function statistic($request)
    {
        # code...
        $data['total'] = $this->model->whereDay('date', date('d'))->count();

        return $data;
    }

    public function show($id)
    {
        # code...
        $data = $this->model
        ->where('attendances.id', $id)
        ->leftJoin('users as t1', 't1.id', '=','attendances.user_id')
        ->leftJoin('employees as t2','t2.id', '=', 't1.employee_id')
        ->leftJoin('users as t3', 't3.id', '=','attendances.approved_by')
        ->leftJoin('employees as t4','t4.id', '=', 't3.employee_id')
        ->get(['attendances.*', 't2.name as user_name', 't4.name as approve_name'])->last();
        dd($data);

        return $data;
    }

}
