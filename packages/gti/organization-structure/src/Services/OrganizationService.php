<?php

namespace GTI\OrganizationStructure\Services;

use App\Helpers\Pagination;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use GTI\OrganizationStructure\Models\Organization;
use GTI\OrganizationStructure\Repositories\OrganizationRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrganizationService extends BaseService
{
    protected $repo;

    public function __construct(
        OrganizationRepository $repo,
    ) {
        parent::__construct();
        $this->repo = $repo;
    }

    public function all()
    {
        # code...
        return $this->repo->all();
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
            $data['created_by'] = Auth::guard('api')->user()->id;
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
            $data['updated_by'] = Auth::guard('api')->user()->id;
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
            $data['deleted_by'] = Auth::guard('api')->user()->id;
            $this->repo->update($data, $id);
            $this->repo->delete($id);
            return $this->responseMessage(__('content.message.delete.success'), 200, true);
        } catch (\Throwable $exc) {
            # code...
            Log::error($exc);
            return $this->responseMessage(__('content.message.delete.failed'), 400, false);
        }
    }

}
