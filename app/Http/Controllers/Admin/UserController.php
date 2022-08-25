<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusCode;
use App\Enums\UploadFilePath;
use App\Http\Controllers\Controller;
use App\Mail\CreateAccountUser;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $pageLimit = $this->newListLimit($request);
        $breadcrumbs = ['ユーザー一覧'];
        $users = new User();
        if (isset($request['search_input'])) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('name', 'LIKE',"%{$request['search_input']}%")
                    ->orWhere('email', 'LIKE',"%{$request['search_input']}%");
            });
        }
        $users = $users->sortable(['created_at' => 'desc'])->paginate($pageLimit);
        Log::info($users->toArray());
        return view('admin.user.index', [
            'users' => $users,
            'request' => $request,
            'pageLimit' => $pageLimit,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function create()
    {
        $breadcrumbs = ['ユーザー作成'];
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
            $passwordUser = bin2hex(random_bytes(4));
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password =  Hash::make($passwordUser);
            $user->sex =  $request->sex;
            $user->birth_date =  $request->birthDate;
            $user->email_verified_at = Carbon::now();
            $user->save();
            if ($request->hasFile('icon')) {
                $user->addMedia($request->icon)->toMediaCollection('user');
            }
            $user->save();
            Mail::send(new CreateAccountUser($user->name ,$user->email, $passwordUser));

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
        $breadcrumbs = ['ユーザー編集'];
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
            $user->save();
            if ($request->hasFile('icon')) {
                $user->clearMediaCollection('user');
                $user->addMedia($request->icon)->toMediaCollection('user');
            }

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
