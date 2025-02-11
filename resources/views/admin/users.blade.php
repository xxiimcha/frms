@extends('layouts.main')

@section('title', 'User Management')

@section('header', 'User Management')

@section('content')
<div class="card shadow">
  <div class="card-header">
    <h3 class="card-title"><i class="fas fa-users"></i> Manage Users</h3>
    <div class="float-right">
      <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
        <i class="fas fa-user-plus"></i> Add User
      </button>
    </div>
  </div>
  
  <div class="card-body">
    <table id="usersTable" class="table table-hover table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td><span class="badge badge-info">{{ ucfirst($user->role) }}</span></td>
          <td>
            @if($user->status === 'active')
              <span class="badge badge-success">Active</span>
            @else
              <span class="badge badge-danger">Inactive</span>
            @endif
          </td>
          <td>
            <button class="btn btn-sm {{ $user->status === 'active' ? 'btn-danger' : 'btn-success' }}"
                    onclick="changeStatus({{ $user->id }}, '{{ $user->status === 'active' ? 'inactive' : 'active' }}')">
              <i class="fas {{ $user->status === 'active' ? 'fa-times' : 'fa-check' }}"></i>
              {{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}
            </button>
            <button class="btn btn-warning btn-sm" onclick="editUser({{ $user }})" data-toggle="modal" data-target="#editUserModal">
              <i class="fas fa-edit"></i> Edit
            </button>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
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

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><i class="fas fa-user-plus"></i> Add New User</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control" required>
              <option value="admin">Admin</option>
              <option value="franchise_manager">Franchise Manager</option>
              <option value="accounting">Accounting</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Add User</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title"><i class="fas fa-edit"></i> Edit User</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editUserForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <input type="hidden" id="editUserId" name="id">
          <div class="form-group">
            <label>Name</label>
            <input type="text" id="editUserName" name="name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" id="editUserEmail" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Role</label>
            <select id="editUserRole" name="role" class="form-control" required>
              <option value="admin">Admin</option>
              <option value="franchise_manager">Franchise Manager</option>
              <option value="accounting">Accounting</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning">Update User</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#usersTable').DataTable({
      "responsive": true,
      "autoWidth": false,
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true
    });

    @if(session('success'))
      toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
      toastr.error("{{ session('error') }}");
    @endif
  });

  function editUser(user) {
    $('#editUserId').val(user.id);
    $('#editUserName').val(user.name);
    $('#editUserEmail').val(user.email);
    $('#editUserRole').val(user.role);
    $('#editUserForm').attr('action', '/users/' + user.id);
  }
  
  function changeStatus(userId, newStatus) {
    $.ajax({
      url: '/users/' + userId + '/status',
      type: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        status: newStatus
      },
      success: function(response) {
        toastr.success(response.message);
        setTimeout(() => location.reload(), 1000); // Refresh page after 1 sec
      },
      error: function(xhr) {
        toastr.error('Error updating status.');
      }
    });
  }
</script>

@endsection
