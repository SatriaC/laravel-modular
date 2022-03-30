<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\PositionService;
use Illuminate\Http\Request;

class PositionController extends Controller
{

    protected $service;

    public function __construct(
        PositionService $service
    )
    {
        $this->service = $service;
    }

    public function index(Request $request)
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