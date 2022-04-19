@extends('layouts.admin')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12"></div>
        <div class="col-md-12">
            <table class="table table-dark mt-2">
                <thead>
                    <tr>
                      <th scope="col">BookID</th>
                      <th scope="col">Car</th>
                      <th scope="col">Pickup</th>
                      <th scope="col">Destination</th>
                      <th scope="col">Date</th>
                      <th scope="col">Mobile</th>
                      <th scope="col">Rent</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->bookid }}</td>
                            <td>{{ $item->carname }}</td>
                            <td>{{ $item->pickup }}</td>
                            <td>{{ $item->destination }}</td>
                            <td>{{ $item->bookdate }}</td>
                            <td>{{ $item->mobile }}</td>
                            <td>{{ $item->offer }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <button {{ $item->status == 'accepted' || $item->status == 'rejected' ? 'disabled' : '' }} class="btn dropdown-item" data-target="#OfferModal{{ $item->bookid }}" data-toggle="modal">Offer Fare</button>
                                    <button {{ $item->status == 'accepted' || $item->status == 'rejected' ? 'disabled' : '' }} class="btn dropdown-item" data-target="#NAModal{{ $item->bookid }}" data-toggle="modal">Not Available</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($data as $item)
<div class="modal fade" id="OfferModal{{ $item->bookid }}" tabindex="-1" aria-labelledby="OfferModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="OfferModalLabel">Offer For {{ $item->carname }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin_offerfare') }}" method="POST" id="offerForm{{ $item->bookid }}">
                @csrf
                <input type="hidden" name="bookid" value="{{ $item->bookid }}">
                <div class="form-group">
                    <label><b>Offer Fare</b></label>
                    <input type="number" name="offer" required class="form-control">
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="offerForm{{ $item->bookid }}" class="btn btn-primary">Offer fare</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="NAModal{{ $item->bookid }}" tabindex="-1" aria-labelledby="NAModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="NAModalLabel">Reject For {{ $item->carname }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin_notavailable') }}" method="POST" id="naForm{{ $item->bookid }}">
                @csrf
                <input type="hidden" name="bookid" value="{{ $item->bookid }}">
                <h3>Are You Sure</h3>
            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="naForm{{ $item->bookid }}" class="btn btn-warning">Reject</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@endsection
