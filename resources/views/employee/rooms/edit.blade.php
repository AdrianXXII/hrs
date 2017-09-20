@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>{{ $hotel->name }}<h3>
                        <h4>Zimmer erstellen</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-10">
                                <form action="{{ route('employee.rooms.update', ['hotel' => $hotel->id, 'room' => $room->id]) }}" class="form-horizontal" method="POST">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="form-group{{ $errors->has('room_number') ? ' has-error' : '' }}">
                                        <label for="room_number" class="col-md-4 control-label">Zimmernummer</label>
                                        <div class="col-md-6">
                                            <input id="room_number" type="text" class="form-control" name="room_number" value="{{ $room->room_number }}" required>

                                            @if ($errors->has('room_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('room_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('room_type') ? ' has-error' : '' }}">
                                        <label for="room_type" class="col-md-4 control-label">Zimmertyp</label>
                                        <div class="col-md-6">
                                            <select id="room_type" name="room_type" class="form-control">
                                                @foreach($roomTypes as $roomType)
                                                    <option {{ $room->roomtype->id == $roomType->id ? 'selected' : '' }} value="{{ $roomType->id }}">{{ $roomType->getData() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Speichern
                                            </button>
                                            <a href="{{ route('employee.rooms.index', ['hotel' => $hotel->id]) }}" class="btn btn-default">
                                                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Abbrechen
                                            </a>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection