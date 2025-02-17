@extends('layouts.main')

@section('title', 'Franchise Details')

@section('header', 'Franchise Details')

@section('content')

<div class="card shadow mb-4">
  <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
    <h3 class="card-title mb-0">Franchise Information</h3>
    <a href="{{ route('franchise.manage') }}" class="btn btn-success float-right text-dark">Back to Manage</a>
  </div>

  <div class="card-body">
    <!-- Basic Information -->
    <h5 class="text-primary">Basic Information</h5>
    <hr class="border-primary">
    <div class="row mb-4">
      <div class="col-md-6">
        <p><strong>Branch Name:</strong> <span class="text-dark">{{ $franchise->branch ?? 'Not Available' }}</span></p>
        <p><strong>Location:</strong> <span class="text-dark">{{ $franchise->location ?? 'Not Available' }}</span></p>
        <p><strong>Franchisee Name:</strong> <span class="text-dark">{{ $franchise->franchisee_name ?? 'Not Available' }}</span></p>
        <p><strong>Contact Number:</strong> <span class="text-dark">{{ $franchise->contact_number ?? 'Not Available' }}</span></p>
      </div>
      <div class="col-md-6">
        <p><strong>Variant:</strong> <span class="badge badge-secondary">{{ ucfirst($franchise->variant) ?? 'N/A' }}</span></p>
        <p><strong>Franchise Date:</strong> <span class="text-dark">{{ $franchise->franchise_date ?? 'Not Available' }}</span></p>
        <p><strong>Status:</strong> 
          <span class="badge {{ $franchise->status == 'pending' ? 'badge-warning' : 'badge-success' }}">
            {{ ucfirst($franchise->status) ?? 'N/A' }}
          </span>
        </p>
      </div>
    </div>

    <!-- Uploaded Requirements -->
    <h5 class="text-info">Uploaded Requirements</h5>
    <hr class="border-info">
    <div class="row mb-4">
      <div class="col-md-6">
        <ul class="list-group">
          <li class="list-group-item bg-light"><strong>Letter of Intent:</strong> 
            @if(optional($franchise->requirements)->letter_of_intent)
              <a href="{{ asset('storage/'.$franchise->requirements->letter_of_intent) }}" class="btn btn-sm btn-outline-info" target="_blank">View File</a>
            @else <span class="text-muted">N/A</span> @endif
          </li>
          <li class="list-group-item"><strong>Resume:</strong> 
            @if(optional($franchise->requirements)->resume)
              <a href="{{ asset('storage/'.$franchise->requirements->resume) }}" class="btn btn-sm btn-outline-info" target="_blank">View File</a>
            @else <span class="text-muted">N/A</span> @endif
          </li>
          <li class="list-group-item"><strong>Market Study:</strong> 
            @if(optional($franchise->requirements)->market_study)
              <a href="{{ asset('storage/'.$franchise->requirements->market_study) }}" class="btn btn-sm btn-outline-info" target="_blank">View File</a>
            @else <span class="text-muted">N/A</span> @endif
          </li>
        </ul>
      </div>

      <div class="col-md-6">
        <ul class="list-group">
          <li class="list-group-item"><strong>Vicinity Map:</strong> 
            @if(optional($franchise->requirements)->vicinity_map)
              <a href="{{ asset('storage/'.$franchise->requirements->vicinity_map) }}" class="btn btn-sm btn-outline-info" target="_blank">View File</a>
            @else <span class="text-muted">N/A</span> @endif
          </li>
          <li class="list-group-item"><strong>Site Inspection Report:</strong> 
            @if(optional($franchise->requirements)->site_inspection)
              <a href="{{ asset('storage/'.$franchise->requirements->site_inspection) }}" class="btn btn-sm btn-outline-info" target="_blank">View File</a>
            @else <span class="text-muted">N/A</span> @endif
          </li>
        </ul>
      </div>
    </div>

    <!-- Staff Details -->
    <h5 class="text-dark">Staff Details</h5>
    <hr class="border-dark">
    <div class="table-responsive mb-4">
      <table class="table table-striped table-hover">
        <thead class="bg-dark text-white">
          <tr>
            <th>Staff Name</th>
            <th>Designation</th>
          </tr>
        </thead>
        <tbody>
          @forelse($franchise->staff ?? [] as $staff)
            <tr>
              <td>{{ $staff->staff_name }}</td>
              <td>{{ $staff->staff_designation }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="2" class="text-center text-muted">No staff members found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Activity Logs -->
    <h5 class="text-secondary">Activity Logs</h5>
    <hr class="border-secondary">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="bg-secondary text-white">
          <tr>
            <th>Date & Time</th>
            <th>Action</th>
            <th>Performed By</th>
          </tr>
        </thead>
        <tbody>
          @forelse($franchise->activity_logs ?? [] as $log)
            <tr>
              <td>{{ $log->created_at }}</td>
              <td>{{ $log->action }}</td>
              <td>{{ $log->user->name ?? 'System' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-center text-muted">No activity logs found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</div>

@endsection
