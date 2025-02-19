@extends('layouts.main')

@section('title', 'Franchise Variants')

@section('header', 'Franchise Variants')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Franchise Variants</h3>
        <button class="btn btn-success" data-toggle="modal" data-target="#addVariantModal">Add Variant</button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>#</th>
                        <th>Variant Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($variants as $index => $variant)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $variant->name }}</td>
                        <td>{{ $variant->description ?? 'N/A' }}</td>
                        <td>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editVariantModal{{ $variant->id }}">Edit</button>
                            <form action="{{ route('franchise.variants.delete', $variant->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this variant?')">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Variant Modal -->
                    <div class="modal fade" id="editVariantModal{{ $variant->id }}" tabindex="-1" role="dialog" aria-labelledby="editVariantLabel{{ $variant->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-secondary text-white">
                                    <h5 class="modal-title" id="editVariantLabel{{ $variant->id }}">Edit Franchise Variant</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('franchise.variants.update', $variant->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">Variant Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $variant->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" name="description" rows="3">{{ $variant->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No franchise variants found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Variant Modal -->
<div class="modal fade" id="addVariantModal" tabindex="-1" role="dialog" aria-labelledby="addVariantLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="addVariantLabel">Add Franchise Variant</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('franchise.variants.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Variant Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add Variant</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
