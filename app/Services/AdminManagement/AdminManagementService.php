<?php

namespace App\Services\AdminManagement;

use App\Models\Asset;
use App\Models\ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminManagementService
{

public function register($data){
    
    $user  = new User();
    $user->name = $data->name;
    $user->email = $data->email;
    $user->phone = $data->phone;
    $user->password = Hash::make($data->password);
    $user->verification = $data->verification;
    $user->save();

    return $user;
}

public function getDashboard(){
    
    $Asset = Asset::all()->count();
    $Ticket = ticket::all()->count();
    $User = User::Where('role', 0)->count();

    return [
       'Asset' => $Asset,
       'ticket' => $Ticket,
       'user' => $User,
    ];
}
public function geteDashboard(){
    $user = Auth::user();
    $username = $user->name;

    return [
        'username' => $username,
    ];
}






}