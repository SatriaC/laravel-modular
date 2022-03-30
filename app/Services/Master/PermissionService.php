<?php

namespace App\Services\Admin;

use App\Helpers\Pagination;
use App\Repositories\BaseRepository;
use App\Repositories\PermissionRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionService extends BaseService
{
    protected $repo;

    public function __construct(
        BaseRepository $repo
    ) {
        parent::__construct();
        $this->repo = $repo;
    }

    public function store($request)
    {
        try {
            # code...
            $data = $request->all();
            Permission::create($data);


            return redirect()->back()->with('success', 'Data has been created.');

        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            return redirect()->back()->with('failed', 'Could not create :object. Please check again.');
        }
    }

    public function data($request)
    {
        $query = Permission::query()->get();
        // dd($query);

        return DataTables::of($query)->addIndexColumn()->make(true);
    }

    public function update($request)
    {

        $db = DB::connection($this->connection);
        $db->beginTransaction();
        try {
            # code...
            $data = $request->all();
            $item = Permission::find($request->id);
            $item->update([
                'name' => $request->name
            ]);

            $db->commit();

        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            $db->rollback();
            // return $this->responseMessage(__('content.message.create.failed'), 400, false);

        }
    }

    public function destroy($id)
    {
        Permission::find($id)->delete();
    }

}
