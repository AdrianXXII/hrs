@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Neue Reservation
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <form class="form-inline" action="{{ route('employee.reservations.create') }}" method="GET">
                                    <div class="form-group">
                                        <label for="startDate" class="col-md-4 control-label">Von</label>

                                        <div class="input-group date bs-datepicker-von">
                                            <input type="text" class="form-control" name="startDatum" id="startDatum">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="endDatum" class="col-md-4 control-label">Bis</label>

                                        <div class="input-group date bs-datepicker-bis">
                                            <input type="text" class="form-control" name="endDatum" id="endDatum">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="roomtype" class="col-md-4 control-label">Zimmerart</label>
                                        <select name="roomtype" class="form-control" id="roomtype">
                                            @foreach($hotels as $hotel)
                                                @if($hotel->active == true)
                                                    @foreach($hotel->roomtypes as $roomtype)
                                                        @if($roomtype->active == true)
                                                            <option value="{{ $roomtype->id }}">{{ $hotel->name . "-" . $roomtype->title }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary center-block deleteBtn">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neu
                                    </button>
                                </form>
                                <div class="{{ $errors->has('rooms') ? ' has-error' : '' }}">
                                    @if ($errors->has('rooms'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rooms') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Reservationen
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Hotel</th>
                                            <th>Zimmerart</th>
                                            <th>Zimmer</th>
                                            <th>Kunde</th>
                                            <th>Datum</th>
                                            <th>Status</th>
                                            <th>

                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reservations as $reservation)
                                            <tr>
                                                <td>{{ $reservation->roomtype->hotel->name }}</td>
                                                <td>{{ $reservation->roomtype->title }}</td>
                                                <td>{{ $reservation->room->room_number }}</td>
                                                <td>{{ $reservation->name }}</td>
                                                <td>{{ (new \Carbon\Carbon($reservation->reservation_start))->format('d.m.Y') }} - {{ (new \Carbon\Carbon($reservation->reservation_end))->format('d.m.Y') }}</td>
                                                <td>{{ $reservation->getStatusText() }}</td>
                                                <td>
                                                    <a href="{{ route('employee.reservations.edit', ['id' => $reservation->id]) }}" class="btn btn-primary">
                                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                                    </a>
                                                    <form method="post" class="deleteBtn" action="{{ route('employee.reservations.delete', ['id' => $reservation->id]) }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger center-block deleteBtn">
                                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                        </button>
                                                    </form>
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
    </div>
@endsection