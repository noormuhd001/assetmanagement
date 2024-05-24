@extends('layout.landingpage')
{{-- 
@include('layout.navbar') --}}

@push('style')

<style>
    
    @import url('https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100..900;1,100..900&display=swap');
    
    h5{
        font-family: "Libre Franklin", sans-serif;
  font-optical-sizing: auto;
  font-weight: <weight>;
  font-style: normal;
  color:grey;
    }
    
    </style>
@endpush


@section('content')
<div class="col lg-6 text-center">
    <h5 >Welcome to the AssetTrack website</h5>
</div>
<div class="content-wrapper">
<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>

              <p>Total Aseets</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>Employee</h3>

              <p>Login</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </div>
</section>
</div>

   
@endsection
