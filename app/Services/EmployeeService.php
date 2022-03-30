<?php

namespace App\Services;

use App\Helpers\Pagination;
use App\Repositories\EmployeeRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeService extends BaseService
{
    protected $repo;

    public function __construct(
        EmployeeRepository $repo,
    ) {
        parent::__construct();
        $this->repo = $repo;
    }

    public function all()
    {
        $data =  $this->repo->all();

        return Pagination::paginate($data);
    }

    public function store($request)
    {
        $db = DB::connection($this->connection);
        $db->beginTransaction();
        try {
            # code...
            $data = $request->all();
            $data['start_contract'] = Carbon::parse($request->start_contract)->format('Y-m-d');
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
            $data['start_contract'] = Carbon::parse($request->start_contract)->format('Y-m-d');
            $data['birthdate'] = Carbon::parse($request->birthdate)->format('Y-m-d');
            $this->repo->update($data, $id);
            $db->commit();

            $item = $this->repo->getById($id);

            return $this->responseMessage(__('content.message.create.success'), 200, true, $item);
        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            $db->rollback();
            return $this->responseMessage(__('content.message.create.failed'), 400, false);
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
            $this->repo->delete($id);
            return $this->responseMessage(__('content.message.delete.success'), 200, true);
        } catch (\Throwable $exc) {
            # code...
            Log::error($exc);
            return $this->responseMessage(__('content.message.delete.failed'), 400, false);
        }
    }

}
