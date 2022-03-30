<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Services\Master\RoleService;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    protected $service;

    public function __construct(
        RoleService $service
    )
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        # code...
        return $this->service->index($request);
    }

    public function all(Request $request)
    {
        # code...
        return $this->service->all($request);
    }

    public function show($id)
    {
        # code...
        return $this->service->show($id);
    }

    public function store(Request $request)
    {
        # code...
        return $this->service->store($request);
    }

    public function update(Request $request, $id)
    {
        # code...
        return $this->service->update($request, $id);
    }

    public function destroy($id)
    {
        # code...
        return $this->service->destroy($id);
    }

    public function list()
    {
        # code...
        return $this->service->permissions();
    }

    public function rolePermission($id)
    {
        # code...
        return $this->service->rolePermission($id);
    }
}
