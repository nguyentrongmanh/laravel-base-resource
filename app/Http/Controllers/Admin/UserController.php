<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusCode;
use App\Enums\UploadFilePath;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $pageLimit = $this->newListLimit($request);
        $breadcrumbs = ['User list'];
        $users = new User();
        if (isset($request['search_input'])) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('name', 'LIKE',"%{$request['search_input']}%")
                    ->orWhere('email', 'LIKE',"%{$request['search_input']}%");
            });
        }
        $users = $users->sortable(['created_at' => 'desc'])->paginate($pageLimit);
        return view('admin.user.index', [
            'users' => $users,
            'request' => $request,
            'pageLimit' => $pageLimit,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function create()
    {
        $breadcrumbs = ['User create'];
        $listEmail = User::get()->pluck('email');
        return view('admin.user.create', [
            'breadcrumbs' => $breadcrumbs,
            'listEmail' => $listEmail
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password =  Hash::make($request->password);
            $user->sex =  $request->sex;
            $user->birth_date =  $request->birthDate;
            $user->email_verified_at = Carbon::now();
            $user->save();
            if ($request->hasFile('icon')) {
                $user->icon = uploadImage(UploadFilePath::USER, $user->id, $request->icon);
            }
            $user->save();

            DB::commit();
            return response()->json(['status' => StatusCode::OK], StatusCode::OK);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e);
            return response()->json($e->getMessage(), StatusCode::INTERNAL_ERR);
        }
    }

    public function edit($id)
    {
        $breadcrumbs = ['User edit'];
        $user = User::find($id);
        $listEmail = User::where('id', '!=', $id)->get()->pluck('email');
        return view('admin.user.edit', [
            'breadcrumbs' => $breadcrumbs,
            'listEmail' => $listEmail,
            'user' => $user
        ]);
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password =  Hash::make($request->password);
            $user->sex =  $request->sex;
            $user->birth_date =  $request->birthDate;
            $user->email_verified_at = Carbon::now();
            if ($request->hasFile('icon')) {
                $user->icon = uploadImage(UploadFilePath::USER, $user->id, $request->icon);
            }
            $user->save();

            DB::commit();
            return response()->json(['status' => StatusCode::OK], StatusCode::OK);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e);
            return response()->json($e->getMessage(), StatusCode::INTERNAL_ERR);
        }
    }

    public function destroy($id)
    {
        try {
            User::where('id', $id)->delete();
            return response()->json(['message' => 'success'], StatusCode::OK);
        } catch (Exception $e) {
            Log::info($e);
            return response()->json(['message' => $e->getMessage()], StatusCode::INTERNAL_ERR);
        }
    }
}
