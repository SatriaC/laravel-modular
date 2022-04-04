<?php

namespace GTI\OrganizationStructure\Controllers;

use App\Http\Controllers\Controller;
use GTI\OrganizationStructure\Services\OrganizationService;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{

    protected $service;

    public function __construct(
        OrganizationService $service
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
}
