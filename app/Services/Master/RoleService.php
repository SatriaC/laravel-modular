<?php

namespace App\Services\Master;

use App\Helpers\Pagination;
use App\Repositories\Master\RoleRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class RoleService extends BaseService
{
    protected $repo;

    public function __construct(
        RoleRepository $repo
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
            // dd($request);
            $item = $this->repo->create(['name' => $request->name, 'guard_name'=>'web']);

            $permissions = $request->permission;
            $item->syncPermissions($permissions);
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
        $db = DB::connection($this->connection);
        $db->beginTransaction();
        try {
            # code...
            $role = $this->repo->getById($id);
            $role->update(['name' => $request->name, 'guard_name'=>'web']);
            $permissions = $request->permission;
            $role->syncPermissions($permissions);
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
            $data['permission'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id')
            ->all();

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

    public function permissions()
    {
        try {
            # code...

            $data = Permission::all();

            return $this->responseMessage(__('content.message.read.success'), 200, true, $data);
        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            return $this->responseMessage(__('content.message.read.failed'), 400, false);
        }
    }

    public function rolePermission($id)
    {
        try {
            # code...
            $data = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

            return $this->responseMessage(__('content.message.read.success'), 200, true, $data);
        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            return $this->responseMessage(__('content.message.read.failed'), 400, false);
        }
    }

}
