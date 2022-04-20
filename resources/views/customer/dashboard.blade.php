@extends('layouts.customer')

@section('content')

<div class="row p-3">
    @foreach($data as $item)
    <div class="col-lg-3">
        <div class="card">
            <img class="card-img-top" src="/media/cars/{{ $item->carimage }}" alt="{{ $item->carname }}">
            <div class="card-body">
                <h5 class="card-title">{{ $item->carname }}</h5>
                <p class="card-text"><b>Available Seats: </b>{{ $item->seat }}</p>
                <button class="btn btn-primary" data-target="#BookingModal{{ $item->carid }}" data-toggle="modal">Book This Car</button>
            </div>
        </div>
    </div>
    @endforeach
</div>

@foreach($data as $item)
<div class="modal fade" id="BookingModal{{ $item->carid }}" tabindex="-1" aria-labelledby="BookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="BookingModalLabel">Book {{ $item->carname }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('customer_bookcar') }}" method="POST" id="bookingForm{{ $item->carid }}">
                @csrf
                <input type="hidden" name="carid" value="{{ $item->carid }}">
                <div class="form-group">
                    <label><b>Booking Date</b></label>
                    <input type="date" name="bookdate" required class="form-control">
                </div>
                <div class="form-group">
                    <label><b>Destination</b></label>
                    <input type="text" name="destination" required class="form-control">
                </div>
                <div class="form-group">
                    <label><b>Pickup Point</b></label>
                    <input type="text" name="pickup" required class="form-control">
                </div>
                <div class="form-group">
                    <label><b>Start Time</b></label>
                    <input type="time" name="starttime" required class="form-control">
                </div>
                <div class="form-group">
                    <label><b>End Time</b></label>
                    <input type="time" name="endtime" required class="form-control">
                </div>
                <div class="form-group">
                    <label><b>Mobile</b></label>
                    <input type="text" name="mobile" required class="form-control">
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="bookingForm{{ $item->carid }}" class="btn btn-primary">Book This Car</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@endsection
