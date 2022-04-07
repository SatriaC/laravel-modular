<?php

namespace GTI\Attendance\Services;

use App\Helpers\Pagination;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use GTI\Attendance\Repositories\AttendanceRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AttendanceService extends BaseService
{
    protected $repo;

    public function __construct(
        AttendanceRepository $repo,
    ) {
        parent::__construct();
        $this->repo = $repo;
    }

    public function index($request)
    {
        $data =  $this->repo->index($request);

        return Pagination::paginate($data, $request);
    }

    public function statistic($request)
    {
        # code...
        try {
            # code...
            $user = Auth::user()->id;
            $data =  $this->repo->statistic($request);

            return $this->responseMessage(__('content.message.read.success'), 200, true, $data);
        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            return $this->responseMessage(__('content.message.read.failed'), 400, false);
        }

    }

    public function checkin($request)
    {
        $db = DB::connection($this->connection);
        $db->beginTransaction();
        try {
            # code...
            $data = $request->all();
            $data['date'] = Carbon::parse($request->date)->format('Y-m-d');
            $data['start_at'] = Carbon::parse($request->start_at)->format('H:i:s');
            $data['image'] = '';
            $data['user_id'] = Auth::guard('api')->user()->id;
            $created = $this->repo->create($data);
            $db->commit();
            // dd($created);
            if (!empty($request->image)) {
                $image = $this->image($request, $created->id);
                $data['image'] = $image;
            }
            $this->repo->update($data, $created->id);
            $db->commit();

            $item = $this->repo->getById($created->id);

            return $this->responseMessage(__('content.message.create.success'), 200, true, $item);
        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            $db->rollback();
            return $this->responseMessage(__('content.message.create.failed'), 400, false);
        }
    }

    public function checkOut($request, $id)
    {
        # code...
        $db = DB::connection($this->connection);
        $db->beginTransaction();
        try {
            # code...
            $data = $request->all();
            $data['end_at'] = Carbon::parse($request->end_at)->format('H:i:s');
            $duration = $this->duration($id, $request);
            $data['duration'] = $duration;
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

    public function approve($request, $id)
    {
        # code...
        $db = DB::connection($this->connection);
        $db->beginTransaction();
        try {
            # code...
            $data['approved_by'] = Auth::guard('api')->user()->id;
            $data['approved_at'] = date('Y-m-d H:i:s');
            $data['status'] = 2;
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

    public function reject($request, $id)
    {
        # code...
        $db = DB::connection($this->connection);
        $db->beginTransaction();
        try {
            # code...
            $data = $request->all();
            $data['reject_by'] = Auth::guard('api')->user()->id;
            $data['reject_at'] = date('Y-m-d H:i:s');
            $data['status'] = 3;
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
            $data = $this->repo->show($id);

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

    public function image($request, $id)
    {
        # code...
        $file_data = $request->input('image');
        $replace = substr($file_data, 0, strpos($file_data, ',') + 1);
        $image = str_replace($replace, '', $file_data);
        $image = str_replace(' ', '+', $image);
        $extension = explode('/', mime_content_type($file_data))[1];
        $file_name = $id . '_attendance_' . time() . '.' . $extension; //generating unique file name;

        if ($file_data != "") { // storing image in storage/app/public Folder
            Storage::disk('public')->put('attendance/' . $file_name, base64_decode($image));
        }
        return $file_name;
    }

    public function duration($id, $request)
    {
        # code...
        $item = $this->repo->getById($id);
        $awal  = strtotime($item->date.' '.$item->start_at);
        $akhir = strtotime(date('Y-m-d').' '.Carbon::parse($request->end_at)->format('H:i:s'));
        $diff  = $akhir - $awal;
        $jam   = floor($diff / (60 * 60));
        $menit = $diff - ( $jam * (60 * 60) );
        $detik = $diff % 60;

        $data = $jam.':'.floor( $menit / 60 ).':'.$detik;

        return $data;
    }

}
