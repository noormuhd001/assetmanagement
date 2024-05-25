<?php

namespace App\Services\EmployeeManagement;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeManagementService
{
    public function index($id)
    {
        $data = User::where('role', 0)->select('*');
        return $data;
    }
    public function store($data)
    {

        $user  = new User();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->phone = $data->phone;
        $user->password = Hash::make($data->password);
        $user->verification = $data->verification;
        $user->save();
        return $user;
    }
    public function employeeEdit($id)
    {
        $user = User::findorfail($id);
        return [
            "user" => $user,
        ];
    }
    public function delete($id)
    {
        $delete = User::findOrFail($id);
        $delete->delete();
        return $delete;
    }
    public function verify($id)
    {
        $user = User::where('verification', $id)->first();
        return $user;
    }
    public function update($data)
    {
        $id = $data->id;
        $update = User::findOrFail($id);
        $update->name = $data->name;
        $update->email = $data->email;
        $update->phone = $data->phone;
        $update->save();
        return $update;
    }
    public function employeedetail($id)
    {
        $user = User::findOrFail($id);
        $asset = Asset::where('status', 0)->get();
        $assetadded = Asset::where('status', 1)
            ->where('employeeid', $user->id)
            ->get();

        return [
            'user' => $user,
            'asset' => $asset,
            'assetadded' => $assetadded,
        ];
    }
}
