<?php

namespace App\Http\Controllers;

use App\Http\Requests\Asset\AssetStoreRequest;
use App\Http\Requests\Asset\AssetUpdateRequest;
use App\Models\Asset;
use App\Services\AssetManagement\AssetManagementService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class AssetController extends Controller
{
    private $assetManagementService;
    public function __construct(AssetManagementService $assetManagementService)
    {
        $this->assetManagementService = $assetManagementService;
    }



    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Asset::select('*');
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {

                        $btn = '<a href="' . route('asset.edit', ['id' => $row->id]) . '" class="edit btn btn-primary btn-sm">Edit</a>
                     <a href="' . route('asset.delete', ['id' => $row->id]) . '" class="delete btn btn-danger btn-sm">Delete</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return view('Asset.index');
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }


    public function create()
    {

        return view('asset.create');
    }

    public function store(AssetStoreRequest $request)
    {
        try {
            $asset = $this->assetManagementService->storeAsset($request);
            if ($asset) {
                return redirect()->route('asset.index')->with('success', 'Asset added successfully');
            } else {
                return redirect()->route('asset.index')->with('errror', 'Asset added successfully');
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function edit($id)
    {
        try {
            $asset = $this->assetManagementService->editAsset($id);
            if ($asset) {
                return view('asset.edit', ['asset' => $asset]);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function delete($id)
    {
        try {
            $asset = $this->assetManagementService->deleteAsset($id);

            if ($asset) {
                return redirect()->route('asset.index')->with('success', 'asset deleted successfully');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function update(AssetUpdateRequest $request)
    {
        try {
            $update = $this->assetManagementService->updateAsset($request);

            if ($update) {
                return redirect()->route('asset.index')->with('success', 'asset updated success');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function listAsset()
    {
        try {
            $data = $this->assetManagementService->listAsset();
            return view('asset.list', $data);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function addasset($id, $assetid)
    {
        try {
            $addasset = $this->assetManagementService->addAsset($id, $assetid);
            if ($addasset) {
                return redirect()->back()->with('success', 'asset added successfully');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }


    public function removeasset($id)
    {
        try {
            $removeasset = $this->assetManagementService->removeAsset($id);

            if ($removeasset) {

                return redirect()->back()->with('success', 'asset removed successfully');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
}
