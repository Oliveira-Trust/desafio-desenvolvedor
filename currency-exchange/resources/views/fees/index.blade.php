<!DOCTYPE html>
<html>
<head>
    <title>Fees</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            margin-bottom: 30px;
            color: #343a40;
        }
        .table thead th {
            background-color: #343a40;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .table td, .table th {
            text-align: center;
        }
        .edit-btn, .delete-btn {
            margin-left: 10px;
        }
    </style>
</head>
<body>

<div class="container table-container">
    <h1 class="text-center"><i class="fas fa-dollar-sign"></i> Fees List</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Rate</th>
            <th>Threshold</th>
            <th>Created At</th>
            <th>Actions</th> <!-- New column for edit and delete buttons -->
        </tr>
        </thead>
        <tbody>
        @foreach ($fees as $key => $fee)
            <tr>
                <td>{{ $fee->name }}</td>
                <td>{{ $fee->rate }}%</td>
                <td>${{ number_format($fee->threshold, 2) }}
                    @if ($key == count($fees) - 1)
                        +
                    @else
                        - ${{ number_format($fees[$key + 1]->threshold, 2) }}
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($fee->created_at)->format('d M Y, H:i') }}</td>
                <td>
                    <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target="#editModal{{ $fee->id }}">
                        Edit
                    </button>
                    <button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#deleteModal{{ $fee->id }}">
                        Delete
                    </button>
                </td>
            </tr>

            <!-- Modal for Edit -->
            <div class="modal fade" id="editModal{{ $fee->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $fee->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $fee->id }}">Edit Fee: {{ $fee->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for editing fee details -->
                            <form method="POST" action="{{ route('fees.update', ['id' => $fee->id]) }}">
                                @csrf
                                @method('PUT')

                                <!-- Example input fields for editing -->
                                <div class="form-group">
                                    <label for="edit-name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $fee->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="edit-rate">Rate (%)</label>
                                    <input type="text" class="form-control" id="rate" name="rate" value="{{ $fee->rate }}">
                                </div>
                                <div class="form-group">
                                    <label for="edit-threshold">Threshold ($)</label>
                                    <input type="text" class="form-control" id="threshold" name="threshold" value="{{ $fee->threshold }}">
                                </div>

                                <!-- Save changes button -->
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Edit Modal -->

            <!-- Modal for Delete -->
            <div class="modal fade" id="deleteModal{{ $fee->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $fee->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $fee->id }}">Delete Fee: {{ $fee->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this fee?</p>
                        </div>
                        <div class="modal-footer">
                            <form method="POST" action="{{ route('fees.destroy', ['fee' => $fee->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Delete Modal -->

        @endforeach
        </tbody>
    </table>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
