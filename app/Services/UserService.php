<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\EmployeeRepository;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService extends BaseService
{
    protected $repo;
    protected $repoUser;

    public function __construct(
        EmployeeRepository $repo,
        UserRepository $repoUser
    ) {
        parent::__construct();
        $this->repo = $repo;
        $this->repoUser = $repoUser;
    }

    public function show()
    {
        try {
            # code...
            $user = Auth::guard('api')->user();
            $data = $this->repo->getById($user->employee->id);

            return $this->responseMessage(__('content.message.read.success'), 200, true, $data);
        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            return $this->responseMessage(__('content.message.read.failed'), 400, false);
        }
    }

    public function update($request)
    {
        # code...
        $db = DB::connection($this->connection);
        $db->beginTransaction();
        try {
            # code...
            $user = Auth::guard('api')->user();
            $data = $request->all();
            $data['updated_by'] = $user->id;
            $data['birthdate'] = Carbon::parse($request->birthdate)->format('Y-m-d');
            $email['email'] = $request->email;
            $this->repo->update($data, $user->employee->id);
            $this->repoUser->update($email, $user->id);
            $db->commit();

            $item = $this->repo->getById($user->employee->id);

            return $this->responseMessage(__('content.message.update.success'), 200, true, $item);
        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            $db->rollback();
            return $this->responseMessage(__('content.message.update.failed'), 400, false);
        }
    }

    public function updatePassword($request)
    {
        # code...
        $db = DB::connection($this->connection);
        $db->beginTransaction();
        try {
            # code...
            $user = User::where('id', Auth::guard('api')->user()->id)->orderBy('id', 'desc')->first();
            $user->password = bcrypt($request->password);
            $user->save();
            $db->commit();
            return $this->responseMessage(__('content.message.update.success'), 200, true);
        } catch (Exception $exc) {
            # code...
            Log::error($exc);
            $db->rollback();
            return $this->responseMessage(__('content.message.update.failed'), 400, false);
        }
    }
}
