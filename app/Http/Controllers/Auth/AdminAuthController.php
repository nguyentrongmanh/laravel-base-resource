<?php

namespace App\Http\Controllers\Auth;

use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function guard()
    {
        return auth()->guard('admin');
    }

    public function getLogin()
    {
        Session::put('previous', url()->previous());
        return view('auth.admin.login');
    }

    /**
     * Show the application loginprocess.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|email',
            'password' => 'required|min:6|max:16',
        ])->setAttributeNames([
            'email' => 'Eメール',
            'password' => 'パスワード',
        ]);
        if ($validator->fails()) {
            $message = array_combine($validator->errors()->keys(), $validator->errors()->all());
            return response()->json(['error' => $message], StatusCode::BAD_REQUEST);
        }
        $credentials = $request->only(['email', 'password']);
        $remember = $request->remember_me == 'true' ? true : false;
        if (auth()->guard('admin')->attempt($credentials, $remember)) {
            $url = Session::get("previous");
            return response()->json(["status" => StatusCode::OK, "previous" => $url], StatusCode::OK);

        } else {
            return response()->json(['message' => 'ユーザー名とパスワードが間違っています。'], StatusCode::BAD_REQUEST);
        }

    }

    /**
     * Show the application logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect(route('adminLogin'));
    }
}
