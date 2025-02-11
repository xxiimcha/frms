@extends('layouts.main')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')

@if(Auth::user()->role === 'franchise_manager')
<div class="row">
  <!-- Total Franchisees -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>50</h3> <!-- Static Value -->
        <p>Total Franchisees</p>
      </div>
      <div class="icon">
        <i class="fas fa-store"></i>
      </div>
    </div>
  </div>

  <!-- For Renewal -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>8</h3> <!-- Static Value -->
        <p>For Renewal</p>
      </div>
      <div class="icon">
        <i class="fas fa-sync-alt"></i>
      </div>
    </div>
  </div>

  <!-- For Closure -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>3</h3> <!-- Static Value -->
        <p>For Closure</p>
      </div>
      <div class="icon">
        <i class="fas fa-times-circle"></i>
      </div>
    </div>
  </div>

  <!-- Pending Approvals -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-secondary">
      <div class="inner">
        <h3>5</h3> <!-- Static Value -->
        <p>Pending Approvals</p>
      </div>
      <div class="icon">
        <i class="fas fa-clock"></i>
      </div>
    </div>
  </div>
</div>
@endif

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Welcome to the Dashboard</h3>
  </div>
  <div class="card-body">
    This is your dashboard. Customize it as needed!
  </div>
</div>

@endsection
