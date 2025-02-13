@extends('layouts.main')

@section('title', 'Manage Franchise')

@section('header', 'Manage Franchise')

@section('content')

<div class="card shadow">
  <div class="card-header">
    <h3 class="card-title"><i class="fas fa-tasks"></i> Manage Franchises</h3>
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
          <th>Name</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Sample Static Data -->
        <tr>
          <td>1</td>
          <td>Franchise A</td>
          <td><span class="badge badge-success">Active</span></td>
          <td>
            <button class="btn btn-info btn-sm">
              <i class="fas fa-eye"></i> View
            </button>
            <button class="btn btn-warning btn-sm">
              <i class="fas fa-edit"></i> Edit
            </button>
            <button class="btn btn-danger btn-sm">
              <i class="fas fa-trash"></i> Delete
            </button>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Franchise B</td>
          <td><span class="badge badge-warning">For Renewal</span></td>
          <td>
            <button class="btn btn-info btn-sm">
              <i class="fas fa-eye"></i> View
            </button>
            <button class="btn btn-warning btn-sm">
              <i class="fas fa-edit"></i> Edit
            </button>
            <button class="btn btn-danger btn-sm">
              <i class="fas fa-trash"></i> Delete
            </button>
          </td>
        </tr>
        <tr>
          <td>3</td>
          <td>Franchise C</td>
          <td><span class="badge badge-danger">Closed</span></td>
          <td>
            <button class="btn btn-info btn-sm">
              <i class="fas fa-eye"></i> View
            </button>
            <button class="btn btn-warning btn-sm">
              <i class="fas fa-edit"></i> Edit
            </button>
            <button class="btn btn-danger btn-sm">
              <i class="fas fa-trash"></i> Delete
            </button>
          </td>
        </tr>
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
