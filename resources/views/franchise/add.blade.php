@extends('layouts.main')

@section('title', 'Add Franchise')

@section('header', 'Add Franchise')

@section('content')
<div class="card shadow">
  <div class="card-header">
    <h3 class="card-title">Add Franchise</h3>
  </div>

  <div class="card-body">
    <form action="{{ url('franchise/store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Franchise Details -->
      <h5 class="mb-3">Franchise Details</h5>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Branch Name</label>
            <input type="text" name="branch" class="form-control" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Location</label>
            <input type="text" name="location" class="form-control" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Franchisee Name</label>
            <input type="text" name="franchisee_name" class="form-control" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="contact_number" class="form-control" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Variant</label>
            <select name="variant" class="form-control" required>
              <option value="">Select Variant</option>
              <option value="Standard">Standard</option>
              <option value="Premium">Premium</option>
              <option value="Luxury">Luxury</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Date of Franchise</label>
            <input type="date" name="franchise_date" class="form-control" required>
          </div>
        </div>
      </div>

      <!-- Staff Details -->
      <h5 class="mt-4">Staff Details</h5>
      <table class="table table-bordered" id="staffTable">
        <thead class="thead-light">
          <tr>
            <th>Staff Name</th>
            <th>Designation</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" name="staff_name[]" class="form-control" required></td>
            <td><input type="text" name="staff_designation[]" class="form-control" required></td>
            <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
          </tr>
        </tbody>
      </table>
      <button type="button" class="btn btn-outline-secondary mb-3" id="addStaffRow">Add Staff</button>

      <!-- Upload Section -->
      <h5 class="mt-4">Upload Requirements</h5>
      <div class="row">
        <div class="col-md-6">
          <div class="card p-3">
            <div class="form-group">
              <label>Letter of Intent</label>
              <input type="file" name="letter_of_intent" class="form-control-file" required>
            </div>
            <div class="form-group">
              <label>Resume</label>
              <input type="file" name="resume" class="form-control-file" required>
            </div>
            <div class="form-group">
              <label>Market Study</label>
              <input type="file" name="market_study" class="form-control-file" required>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card p-3">
            <div class="form-group">
              <label>Vicinity Map</label>
              <input type="file" name="vicinity_map" class="form-control-file" required>
            </div>
            <div class="form-group">
              <label>Franchise Presentation Fee (Receipt)</label>
              <input type="file" name="presentation_fee" class="form-control-file" required>
            </div>
            <div class="form-group">
              <label>Site Inspection Report</label>
              <input type="file" name="site_inspection" class="form-control-file" required>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-12">
          <div class="card p-3">
            <div class="form-group">
              <label>2 Valid IDs (Upload Multiple)</label>
              <input type="file" name="valid_ids[]" class="form-control-file" multiple required>
            </div>
            <div class="form-group">
              <label>Franchise Battery Test (Credit Investigation)</label>
              <input type="file" name="battery_test" class="form-control-file" required>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">Submit Franchise</button>
      </div>

    </form>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Add new staff row
    $('#addStaffRow').click(function() {
      $('#staffTable tbody').append(`
        <tr>
          <td><input type="text" name="staff_name[]" class="form-control" required></td>
          <td><input type="text" name="staff_designation[]" class="form-control" required></td>
          <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
        </tr>
      `);
    });

    // Remove staff row
    $(document).on('click', '.removeRow', function() {
      $(this).closest('tr').remove();
    });
  });
</script>
@endsection
