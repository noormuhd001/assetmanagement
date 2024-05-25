@extends('layout.layout')
@section('content')
@section('breadcrumbs')
    {{ Breadcrumbs::render('asset.list') }}
@endsection
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Asset Assigned</div>
                <div class="card-body">
                    @if ($assetadded->isNotEmpty())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Model No/Serial No</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assetadded as $assetaddeds)
                                    <tr>
                                        <td>{{ $assetaddeds->name }}</td>
                                        <td>{{ $assetaddeds->category }}</td>
                                        <td>{{ $assetaddeds->model }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-danger">No items added</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
