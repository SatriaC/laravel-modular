<?php

namespace App\Services;

use App\Exports\Employee\EmployeeExport;
use App\Helpers\Pagination;
use App\Imports\Employee\EmployeeImport;
use App\Repositories\EmployeeRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeService extends BaseService
{
    protected $repo;

    public function __construct(
        EmployeeRepository $repo,
    ) {
        parent::__construct();
        $this->repo = $repo;
    }

    public function index($request)
    {
        $data =  $this->repo->index($request);

        return Pagination::paginate($data, $request);
    }

    public function store($request)
    {
        $db = DB::connection($this->connection);
        $db->beginTransaction();
        try {
            # code...
            $data = $request->all();
            $data['created_by'] = '1';
            $data['start_at'] = Carbon::parse($request->start_at)->format('Y-m-d');
            $data['birthdate'] = Carbon::parse($request->birthdate)->format('Y-m-d');
            $item = $this->repo->create($data);
            $db->commit();

            return $this->responseMessage(__('content.message.create.success'), 200, true, $item);
        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            $db->rollback();
            return $this->responseMessage(__('content.message.create.failed'), 400, false);
        }
    }

    public function update($request, $id)
    {
        # code...
        $db = DB::connection($this->connection);
        $db->beginTransaction();
        try {
            # code...
            $data = $request->all();
            $data['updated_by'] = '1';
            $data['start_at'] = Carbon::parse($request->start_at)->format('Y-m-d');
            if (isset($request->end_at)) {
                # code...
                $data['end_at'] = Carbon::parse($request->end_at)->format('Y-m-d');
            }
            $data['birthdate'] = Carbon::parse($request->birthdate)->format('Y-m-d');
            $this->repo->update($data, $id);
            $db->commit();

            $item = $this->repo->getById($id);

            return $this->responseMessage(__('content.message.update.success'), 200, true, $item);
        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            $db->rollback();
            return $this->responseMessage(__('content.message.update.failed'), 400, false);
        }
    }

    public function show($id)
    {
        try {
            # code...
            $data = $this->repo->getById($id);

            return $this->responseMessage(__('content.message.read.success'), 200, true, $data);
        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            return $this->responseMessage(__('content.message.read.failed'), 400, false);
        }
    }

    public function destroy($id)
    {
        # code...
        try {
            # code...
            $data['deleted_by'] = '1';
            $this->repo->update($data, $id);
            $this->repo->delete($id);
            return $this->responseMessage(__('content.message.delete.success'), 200, true);
        } catch (\Throwable $exc) {
            # code...
            Log::error($exc);
            return $this->responseMessage(__('content.message.delete.failed'), 400, false);
        }
    }

    public function import($request)
    {
        # code...
        try {
            # code...
            Validator::make($request->all(), [
                'file' => 'required|mimes:csv,xls,xlsx'
            ])->validate();


            // menangkap file excel
            $file = $request->file('file');

            Excel::import(new EmployeeImport, $file);

            return $this->responseMessage(__('content.message.create.success'), 200, true);
        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            return $this->responseMessage(__('content.message.create.failed'), 400, false);
        }
    }

    public function export()
    {
        # code...
        try {
            # code...
            return Excel::download(new EmployeeExport, 'employee.xlsx');
        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            return $this->responseMessage(__('content.message.create.failed'), 400, false);
        }
    }

}
