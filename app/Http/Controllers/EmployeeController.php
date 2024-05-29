<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Http\Requests\Employee\EmployeeUpdateRequest;
use App\Jobs\SendEmailJob;
use App\Services\EmployeeManagement\EmployeeManagementService;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    private $employeeManagementService;
    public function __construct(EmployeeManagementService $employeeManagementService)
    {
        $this->employeeManagementService = $employeeManagementService;
    }

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = $this->employeeManagementService->index(Auth::user()->id);
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('employee.edit', ['id' => $row->id]) . '" class="edit btn btn-primary btn-sm">Edit</a> <a href="' . route('employee.delete', ['id' => $row->id]) . '" class="delete btn btn-danger btn-sm">Delete</a>
                        <a href="' . route('employee.details', ['id' => $row->id]) . '" class="delete btn btn-outline-primary btn-sm">Details</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view("employee.index");
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function create()
    {
        return view("employee.create");
    }
    public function store(EmployeeStoreRequest $request)
    {
        try {
            $user = $this->employeeManagementService->store($request);
            if ($user) {
                dispatch(new SendEmailJob($user));
                return redirect()->route('employee.create')->with('success', 'user registered successfull');
            } {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function edit($id)
    {
        try {
            $data = $this->employeeManagementService->employeeEdit($id);
            return view('employee.edit', $data);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function delete($id)
    {
        try {
            $delete = $this->employeeManagementService->delete($id);
            if ($delete) {
                return redirect()->route('employeedetails')->with('success', 'employee deleted successfully');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function verify($id)
    {
        try {
            $user = $this->employeeManagementService->verify($id);
            if ($user) {
                $user->isActive = 1;
                $user->verification = null;
                $user->save();
                return view('email.success', ['user' => $user]);
            } else {
                return view('email.failed', ['user' => $user]);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function update(EmployeeUpdateRequest $request)
    {
        try {
            $update = $this->employeeManagementService->update($request);
            if ($update) {
                return response()->json(['data' => true, 'route' => route('employeedetails'), 'message' => 'employee updated successfully']);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function details($id)
    {
        try {
            $data = $this->employeeManagementService->employeeDetail($id);
            return view('employee.details', $data);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
}
