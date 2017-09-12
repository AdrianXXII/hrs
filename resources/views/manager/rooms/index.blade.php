@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="/img/hotelroom.jpg" class="background-hotelroom">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>{{ $hotel->name }}<h3>
                        <h4>Zimmer</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                @if($rooms === null)
                                        <h1>Leider keine Zimmertypen vorhanden</h1>
                                        <p>Bitte erstelle vorher einen Zimmertyp</p>
                                        <a href="{{ route('manager.hotels.index') }}" class="btn btn-default">
                                            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Abbrechen
                                        </a>
                                @else
                                    <div class="float-right">
                                        <a href="{{ route('manager.rooms.create', ['hotel' => $hotel->id]) }}" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neu
                                        </a>
                                    </div>
                                    <table class="table table-striped table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Nummer</th>
                                                <th>Zimmertyp</th>
                                                <th>Anzahl Zimmer</th>
                                                <th>Preis CHF</th>
                                                <th>

                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($rooms as $room)
                                                <tr>
                                                    <td>{{ $room->room_number }}</td>
                                                    <td>{{ $room->roomtype->title }}</td>
                                                    <td>{{ $room->roomtype->category->number_of_beds }}</td>
                                                    <td>{{ $room->roomtype->price }}</td>
                                                    <td>
                                                        <a href="{{ route('manager.rooms.edit', ['hotel' => $hotel->id, 'room' => $room->id]) }}" class="btn btn-primary">
                                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                                        </a>
                                                        <form class="deleteBtn" method="post" action="{{ route('manager.rooms.delete', ['hotel' => $hotel->id, 'room' => $room->id]) }}">
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection