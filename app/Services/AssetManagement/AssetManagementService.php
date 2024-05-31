<?php

namespace App\Services\AssetManagement;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AssetManagementService
{
    public function storeAsset($data)
    {
        $asset = new Asset();
        $asset->name = $data->name;
        $asset->model = $data->model;
        $asset->category = $data->category;
        $asset->save();
        return $asset;
    }
    public function editAsset($id)
    {
        $asset = Asset::findOrFail($id);
        return $asset;
    }
    public function deleteAsset($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();
        return $asset;
    }
    public function updateAsset($data)
    {

        $id = $data->id;
        $update = Asset::findOrFail($id);
        $update->name = $data->name;
        $update->model = $data->model;
        $update->category = $data->category;
        $update->save();
        return $update;
    }
    public function addAsset($id, $assetid)
    {
        $user = User::findOrFail($id);
        $addasset = Asset::findOrFail($assetid);
        $addasset->status = 1;
        $addasset->uuid =(string) Str::uuid();
        $addasset->employeeid = $user->id;
        $addasset->save();
        return $addasset;
    }

    public function removeAsset($id)
    {

        $removeasset = Asset::findOrFail($id);
        $removeasset->status = 0;
        $removeasset->uuid =null;
        $removeasset->employeeid = 0;
        $removeasset->save();
        return $removeasset;
    }

    public function listAsset()
    {
        $user = Auth::User();
        $asset = Asset::where('status', 0)->get();
        $assetadded = Asset::where('status', 1)
            ->where('employeeid', $user->id)->get();

        return [
            'user' => $user,
            'asset' => $asset,
            'assetadded' => $assetadded,
        ];
    }
}
