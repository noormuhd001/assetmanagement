<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\EmployeeLoginRequest;
use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Auth;
use App\Services\AdminManagement\AdminManagementService;

class AdminController extends Controller
{
    private $adminManagementService;

    public function __construct(AdminManagementService $adminManagementService)
    {
        $this->adminManagementService = $adminManagementService;
    }
    public function loginpage()
    {
        return view("user.loginpage");
    }

    public function register()
    {
        return view("user.register");
    }
    public function adminSignup(EmployeeStoreRequest $request)
    {
        try {
            $user = $this->adminManagementService->register($request);
            if ($user) {
                dispatch(new SendEmailJob($user));
                return redirect()->route('register')->with('success', 'user registered successfull');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function login(EmployeeLoginRequest $request)
    {
        try {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if ($user->isActive) {
                    if ($user->role == 0) {
                        return redirect()->route('edashboard')->with('success', 'User login success');
                    } else {
                        return redirect()->route('dashboard')->with('success', 'admin login success');
                    }
                } else {
                    Auth::logout();
                    return redirect()->back()->withErrors(['email' => 'Your account is not active.']);
                }
            }
            return redirect()->back()->withErrors(['email' => 'Enter your Email and Password']);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function dashboard()
    {
        try {
            $data = $this->adminManagementService->getDashboard();
            return view('pages.dashboard', $data);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function edashboard()
    {
        try {
            $data = $this->adminManagementService->geteDashboard();
            return view('pages.edashboard', $data);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function logout()
    {
        Auth::logout();
        return view('user.loginpage');
    }
}
