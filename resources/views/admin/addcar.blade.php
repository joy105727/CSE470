@extends('layouts.admin')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12"></div>
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin_savecar') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="py-3 text-center font-bold font-up test-info">Register Your Car</h2>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="custom-select" required name="vehicletype">
                                        <option value="" selected>--Select Vehicle Type--</option>
                                        <option value="Private Car">Private Car</option>
                                        <option value="Motor Cycle">Motor Cycle</option>
                                        <option value="CNG">CNG</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" name="carname" placeholder="Car Name" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" name="carno" placeholder="Car No." required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="number" name="seat" placeholder="Total Number Of Seat" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" name="mobile" type="text" placeholder="Mobile No." required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="file" class="form-control" name="carimage" required/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info float-right">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Car No.</th>
                                    <th>Seat</th>
                                    <th>Mobile</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->carid }}</td>
                                    <td>{{ $item->vehicletype }}</td>
                                    <td>{{ $item->carname }}</td>
                                    <td>{{ $item->carno }}</td>
                                    <td>{{ $item->seat }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td><img src="/media/cars/{{ $item->carimage }}" class="img-thumbnail" alt="" width="40%"></td>
                                    <td>{{ $item->sts }}</td>
                                    <td><button class="btn btn-warning" data-target="#EditModal{{ $item->carid }}" data-toggle="modal">Edit</button></td>
                                    <td><button class="btn btn-danger" data-target="#DeleteModal{{ $item->carid }}" data-toggle="modal">Delete</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($data as $item)
<div class="modal fade" id="EditModal{{ $item->carid }}" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditModalLabel">Book {{ $item->carname }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin_editcar') }}" method="POST" id="editForm{{ $item->carid }}">
                @csrf
                <input type="hidden" name="carid" value="{{ $item->carid }}">
                <div class="form-group">
                    <label>Vehicle Type</label>
                    <select class="custom-select" required name="vehicletype">
                        <option value="Private Car" {{ $item->vehicletype == 'Private Car' ? 'selected' : '' }}>Private Car</option>
                        <option value="Motor Cycle" {{ $item->vehicletype == 'Motor Cycle' ? 'selected' : '' }}>Motor Cycle</option>
                        <option value="CNG" {{ $item->vehicletype == 'CNG' ? 'selected' : '' }}>CNG</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Car Name</label>
                    <input class="form-control" name="carname" value="{{ $item->carname }}" required/>
                </div>
                <div class="form-group">
                    <label>Car No</label>
                    <input class="form-control" name="carno" value="{{ $item->carno }}" required/>
                </div>
                <div class="form-group">
                    <label>Amount of Seats</label>
                    <input class="form-control" name="seat" value="{{ $item->seat }}" required/>
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input class="form-control" name="mobile" value="{{ $item->mobile }}" required/>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="editForm{{ $item->carid }}" class="btn btn-warning">Edit Car</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="DeleteModal{{ $item->carid }}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="DeleteModalLabel">Delete {{ $item->carname }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin_deletecar') }}" method="POST" id="deleteForm{{ $item->carid }}">
                @csrf
                <input type="hidden" name="carid" value="{{ $item->carid }}">
                <h3>Are You Sure?</h3>
                <h5><i>All Information And Booking of This Car Will Be Deleted</i></h5>
            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="deleteForm{{ $item->carid }}" class="btn btn-danger">Delete Car</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@endsection
