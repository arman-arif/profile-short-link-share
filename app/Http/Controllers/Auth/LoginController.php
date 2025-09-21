<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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
    protected string $redirectTo = '/';
    protected string $whoLogin = 'user';
    protected array $rateLimitsTiers = [
        [3, 15], // 3 attempts for 15 minutes
        [6, 45], // 6 attempts for 45 minutes
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful, we will increase the number of attempts
        // to log in and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts, they will get locked out.
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

        if ($this->whoLogin == 'admin') {
            return redirect()->intended('/admin/dashboard');
        }

        $user = $this->guard()->user();
        if ($user->is_disabled) {
            $this->guard()->logout();
            return redirect('/login')->withErrors(['email' => 'Your account has been disabled. Please contact support.']);
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }

    protected function attemptLogin(Request $request)
    {
        $adminAttempt =  $this->guard('admin')->attempt(
            $this->credentials($request), $request->boolean('remember')
        );

        if ($adminAttempt) {
            $this->whoLogin = 'admin';
            return $adminAttempt;
        }

        return $this->guard()->attempt(
            $this->credentials($request), $request->boolean('remember')
        );
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|captcha'
        ], [
            'g-recaptcha-response' => 'Invalid reCaptcha response.'
        ]);
    }

    protected function guard($guard = 'web')
    {
        return Auth::guard($guard);
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->maxAttempts($request)
        );
    }


    private function getAttemptKey(Request $request)
    {
        return 'failed_login_attempts:' . $this->throttleKey($request);
    }

    protected function getAttempts(Request $request)
    {
        return Cache::get($this->getAttemptKey($request), 0);
    }

    protected function maxAttempts(Request $request)
    {
        $attempts = $this->getAttempts($request);
        if ($attempts > $this->rateLimitsTiers[0][0]) {
            return $this->rateLimitsTiers[1][0];
        }
        return $this->rateLimitsTiers[0][0];
    }

    public function decayMinutes(Request $request)
    {
        $attempts = $this->getAttempts($request);
        if ($attempts > $this->rateLimitsTiers[0][1]) {
            return $this->rateLimitsTiers[1][1];
        }
        return $this->rateLimitsTiers[0][1];
    }

    protected function incrementLoginAttempts(Request $request)
    {
        $this->limiter()->hit(
            $this->throttleKey($request), $this->decayMinutes($request) * 60
        );
        Cache::remember($this->getAttemptKey($request), 45, function () use ($request) {
            return $this->getAttempts($request) + 1;
        });
    }

    protected function clearLoginAttempts(Request $request)
    {
        $this->limiter()->clear($this->throttleKey($request));
        Cache::forget($this->getAttemptKey($request));
    }
}
