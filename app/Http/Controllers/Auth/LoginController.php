<?php

namespace App\Http\Controllers\Auth;

use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        Session::put('previous_user', url()->previous());
        $listEmail = User::get()->pluck('email');
        return view('auth.login', ['listEmail' => $listEmail]);
    }

    /**
     * Show the application loginprocess.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|email',
            'password' => 'required|min:6|max:16',
        ])->setAttributeNames([
            'email' => '郵便物',
            'password' => 'パスワード',
        ]);
        if ($validator->fails()) {
            $message = array_combine($validator->errors()->keys(), $validator->errors()->all());
            return response()->json(['error' => $message], StatusCode::BAD_REQUEST);
        }
        $credentials = $request->only(['email', 'password']);
        $remember = $request->remember_me == 'true' ? true : false;
        if (auth()->attempt($credentials, $remember)) {
            if (empty(auth()->user()->email_verified_at)) {
            auth()->logout();
            return response()->json(['message' => 'あなたのメールアドレスを確認してください。'], StatusCode::BAD_REQUEST);
        }
            $url = Session::get("previous_user");
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
        auth()->logout();
        return redirect(route('login'));
    }
}
