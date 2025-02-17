@extends('layouts.main')

@section('title', 'Manage Franchise')

@section('header', 'Manage Franchise')

@section('content')

<div class="card shadow">
  <div class="card-header">
    <h3 class="card-title">Manage Franchises</h3>
    <div class="float-right">
      <a href="{{ url('franchise/add') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Add Franchise
      </a>
    </div>
  </div>

  <div class="card-body">
    <table id="franchiseTable" class="table table-hover table-bordered">
      <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Branch</th>
          <th>Franchisee</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($franchises as $franchise)
        <tr>
          <td>{{ $franchise->id }}</td>
          <td>{{ $franchise->branch }}</td>
          <td>{{ $franchise->franchisee_name }}</td>
          <td>
            @if ($franchise->status == 'Active')
              <span class="badge badge-success">Active</span>
            @elseif ($franchise->status == 'For Renewal')
              <span class="badge badge-warning">For Renewal</span>
            @elseif ($franchise->status == 'Closed')
              <span class="badge badge-danger">Closed</span>
            @else
              <span class="badge badge-secondary">Pending</span>
            @endif
          </td>
          <td>
            <a href="{{ url('franchise/view', $franchise->id) }}" class="btn btn-info btn-sm">
              <i class="fas fa-eye"></i> View
            </a>
            <a href="{{ url('franchise/edit', $franchise->id) }}" class="btn btn-warning btn-sm">
              <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ url('franchise/delete', $franchise->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this franchise?')">
                <i class="fas fa-trash"></i> Delete
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#franchiseTable').DataTable({
      "responsive": true,
      "autoWidth": false,
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true
    });
  });
</script>
@endsection
