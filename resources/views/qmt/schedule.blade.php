@extends('layouts.main')

@section('title', 'QMT Schedule')

@section('header', 'QMT Schedule')

@section('content')

<div class="card shadow">
  <div class="card-header">
    <h3 class="card-title">QMT Schedule Management</h3>
  </div>

  <div class="card-body">
    <table class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr>
          <th>Branch</th>
          <th>Year</th>
          <th>Q1</th>
          <th>Q2</th>
          <th>Q3</th>
          <th>Q4</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($franchises as $franchise)
          @php
            $schedule = $franchise->qmtSchedules->first();
          @endphp
          <tr>
            <td>{{ $franchise->branch }}</td>
            <td>{{ $schedule->year ?? date('Y') }}</td>
            <td>{{ $schedule->q1 ?? 'N/A' }}</td>
            <td>{{ $schedule->q2 ?? 'N/A' }}</td>
            <td>{{ $schedule->q3 ?? 'N/A' }}</td>
            <td>{{ $schedule->q4 ?? 'N/A' }}</td>
            <td>
              <button class="btn btn-primary btn-sm edit-schedule" 
                      data-id="{{ $schedule->id ?? '' }}" 
                      data-franchise="{{ $franchise->id }}" 
                      data-year="{{ $schedule->year ?? date('Y') }}" 
                      data-q1="{{ $schedule->q1 ?? '' }}" 
                      data-q2="{{ $schedule->q2 ?? '' }}" 
                      data-q3="{{ $schedule->q3 ?? '' }}" 
                      data-q4="{{ $schedule->q4 ?? '' }}">
                Edit
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Modal for Editing QMT Schedule -->
<div class="modal fade" id="editScheduleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-white">
        <h5 class="modal-title">Edit QMT Schedule</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="scheduleForm" method="POST">
          @csrf
          <div class="form-group">
            <label>Year</label>
            <input type="number" name="year" id="scheduleYear" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Q1 Date</label>
            <input type="date" name="q1" id="scheduleQ1" class="form-control">
          </div>
          <div class="form-group">
            <label>Q2 Date</label>
            <input type="date" name="q2" id="scheduleQ2" class="form-control">
          </div>
          <div class="form-group">
            <label>Q3 Date</label>
            <input type="date" name="q3" id="scheduleQ3" class="form-control">
          </div>
          <div class="form-group">
            <label>Q4 Date</label>
            <input type="date" name="q4" id="scheduleQ4" class="form-control">
          </div>
          <input type="hidden" name="franchise_id" id="scheduleFranchiseId">
          <button type="submit" class="btn btn-success">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.edit-schedule').click(function() {
      let id = $(this).data('id');
      let franchiseId = $(this).data('franchise');
      let year = $(this).data('year');
      let q1 = $(this).data('q1');
      let q2 = $(this).data('q2');
      let q3 = $(this).data('q3');
      let q4 = $(this).data('q4');

      $('#scheduleForm').attr('action', id ? `/qmt/schedule/${id}/update` : `/qmt/schedule/store`);
      $('#scheduleFranchiseId').val(franchiseId);
      $('#scheduleYear').val(year);
      $('#scheduleQ1').val(q1);
      $('#scheduleQ2').val(q2);
      $('#scheduleQ3').val(q3);
      $('#scheduleQ4').val(q4);
      
      $('#editScheduleModal').modal('show');
    });
  });
</script>

@endsection
