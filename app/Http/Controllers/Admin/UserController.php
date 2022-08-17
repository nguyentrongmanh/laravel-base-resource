<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
}
