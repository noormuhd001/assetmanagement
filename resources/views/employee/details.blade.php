@extends('layout.layout')


@section('content')

@section('breadcrumbs')

{{ Breadcrumbs::render('employee.details', $user->id) }}


@endsection


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employee Details</div>

                <div class="card-body">
                    <h5>Name : {{ $user->name }}</h5>
                    <h5>Emailid: {{ $user->email }}</h5>
                    <h5>Phone No: {{ $user->phone }}</h5>
                </div>
            </div>
        </div>
    </div>

        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Asset Available</div>

                <div class="card-body">
                    @if ($asset->isNotEmpty())
                        
                 
                    <table class="table">
                        <thead>
                            <tr>
                                
                                <th>Name</th>
                                <th>Category</th>
                                <th>Model No/Serial No</th>
                                <th>Action</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asset as $assets)
                                <tr>
                                    <td>{{ $assets->name }}</td>
                                    <td>{{ $assets->category }}</td>
                                    <td>{{ $assets->model }}</td>
                                  
                                        
                                  
                                    <td><a href="{{ route('addasset', ['id' => $user->id, 'assetid' => $assets->id]) }}"><button class="btn btn-outline-primary">Add</button></a></td>                                  
                                   
                                </tr>

                            @endforeach
                        </tbody>
                    </table>

                    @else
                        <p class="text-danger">No Asset Available</p>
                    
                    @endif
                </div>
            </div>
        </div>
    </div>

 
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              
                <div class="card-header">Asset Added</div>
               
                <div class="card-body">
                    @if ($assetadded->isNotEmpty())
                  
                        
                  

                    <table class="table">

                        
                  
                        <thead>
                            <tr>
                                
                                <th>Name</th>
                                <th>Category</th>
                                <th>Model No/Serial No</th>
                                <th>Action</th>
                               
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assetadded as $assetaddeds)
                                <tr>
                                    <td>{{ $assetaddeds->name }}</td>
                                    <td>{{ $assetaddeds->category }}</td>
                                    <td>{{ $assetaddeds->model }}</td>
                                    <td><a href="{{ route('removeasset',['id'=> $assetaddeds->id]) }}"><button class="btn btn-outline-danger">Remove</button></a></td>
                                        
                                  
                                    
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