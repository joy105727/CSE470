@extends('layouts.customer')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12"></div>
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>BookID</th>
                                    <th>Date</th>
                                    <th>Car</th>
                                    <th>Car No</th>
                                    <th>Time</th>
                                    <th>Offer</th>
                                    <th>Response</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->bookid }}</td>
                                    <td>{{ $item->bookdate }}</td>
                                    <td>{{ $item->carname }}</td>
                                    <td>{{ $item->carno }}</td>
                                    <td>{{ $item->starttime }} - {{ $item->endtime }}</td>
                                    <td>{{ $item->offer }}</td>
                                    <td>{{ $item->response }}</td>
                                    <td>
                                        @if($item->offer)
                                        <button class="btn btn-success" {{ $item->status == 'accepted' ? 'disabled' : '' }} data-target="#AcceptModal{{ $item->bookid }}" data-toggle="modal">Accept</button>
                                        @else
                                        <button class="btn btn-warning">No Offers Yet</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == 'accepted')
                                        <button class="btn btn-danger" disabled>Delete</button>
                                        @else
                                        <button class="btn btn-danger" data-target="#DeleteModal{{ $item->bookid }}" data-toggle="modal">Delete</button>
                                        @endif
                                    </td>
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
<div class="modal fade" id="AcceptModal{{ $item->bookid }}" tabindex="-1" aria-labelledby="AcceptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AcceptModalLabel">Accept Fare</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('customer_acceptfare') }}" method="POST" id="acceptForm{{ $item->bookid }}">
                @csrf
                <input type="hidden" name="bookid" value="{{ $item->bookid }}">
                <h3>Are You Sure?</h3>
            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="acceptForm{{ $item->bookid }}" class="btn btn-success">Accept Fare</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="DeleteModal{{ $item->bookid }}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="DeleteModalLabel">Delete Booking</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('customer_deletebooking') }}" method="POST" id="deleteForm{{ $item->bookid }}">
                @csrf
                <input type="hidden" name="bookid" value="{{ $item->bookid }}">
                <h3>Are You Sure?</h3>
            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="deleteForm{{ $item->bookid }}" class="btn btn-danger">Delete Booking</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@endsection
