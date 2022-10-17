<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthenticatedSessionController extends Controller
{
   /**
     * Display the login view for teacher.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('teacher.auth.login');
    }

    
    /**
     * Handle an incoming authentication request.
     *
     * @param  TeacherLoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TeacherLoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::TEACHER_HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('teacher')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('teacher.login');
    }
}
