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
              
                return response()->json(['data' => true, 'route' => route('register'),'message' =>'user registered successfull']);
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
                        return response()->json(['data' => true, 'route' => route('edashboard')]);
                    } else {
                        return response()->json(['data' => true, 'route' => route('dashboard')]);
                    }
                } else {
                    Auth::logout();
                    return response()->json(['message' => 'Your account is not active.'], 401);
                }
            }

            return response()->json(['message' => 'Invalid username or password.'], 401);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['message' => 'Server error.'], 500);
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
