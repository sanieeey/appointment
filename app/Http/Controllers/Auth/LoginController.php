<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return response()->json(['status' => 'success', 'redirect_url' => '/dashboard']);
        } else {
            return response()->json(['status' => 'success', 'redirect_url' => '/userdashboard']);
        }
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json(['status' => 'error', 'message' => trans('auth.failed')], 422);
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        return response()->json([
            'status' => 'error',
            'message' => 'Too many login attempts. Please try again in ' . $seconds . ' seconds.',
            'retry_after' => $seconds,
        ], 429);
    }

    protected function throttleKey(Request $request)
    {
        return strtolower($request->input('email')).'|'.$request->ip();
    }

    public function verify_login_email(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        try {
            if ($user) {
                Auth::login($user);
                return response()->json(['status' => 'success']);
            }
            return response()->json(['status' => 'error', 'message' => 'Unauthorized Access!']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 429);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function username()
    {
        return 'email';
    }
}
