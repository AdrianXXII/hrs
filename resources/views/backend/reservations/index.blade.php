@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Reservationen
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="float-right">
                                    <a href="{{ route('manager.reservations.create') }}" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neu
                                    </a>
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Hotel</th>
                                            <th>Zimmerart</th>
                                            <th>Zimmer</th>
                                            <th>Kunde</th>
                                            <th>Datum</th>
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
                                                <td>{{ (new \Carbon\Carbon($reservation->room->reservation_start))->format('d.m.Y') }} - {{ (new \Carbon\Carbon($reservation->room->reservation_end))->format('d.m.Y') }}</td>
                                                <td>
                                                    <a href="{{ route('manager.reservations.edit', ['id' => $reservation->id]) }}" class="btn btn-primary">
                                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                                    </a>
                                                    <form method="post" class="deleteBtn" action="{{ route('manager.reservations.delete', ['id' => $reservation->id]) }}">
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