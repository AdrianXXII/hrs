@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Hotel
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-10">
                                <h2>{{ $hotel->name }}</h2>
                                @for ($i = 0; $i < $hotel->stars; $i++)
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                @endfor
                                <br>
                                <img alt="hotelsample" class="img-thumbnail" src="/img/hotelsample.jpg" data-holder-rendered="true">
                                <p>{{ $hotel->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Reservation Editieren
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-10">
                                <form action="{{ route('manager.reservations.update', ['id' => $reservation->id]) }}" class="form-horizontal" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="form-group">
                                        <label for="roomtype" class="col-md-4 control-label">Zimmerart</label>
                                        <div class="col-md-6">
                                            {{ $reservation->roomtype->title }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-md-4 control-label">Kundenname</label>
                                        <div class="col-md-6">
                                            {{ $reservation->name }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname" class="col-md-4 control-label">Vorname</label>
                                        <div class="col-md-6">
                                            {{ $reservation->firstname }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname" class="col-md-4 control-label">email</label>
                                        <div class="col-md-6">
                                            {{ $reservation->email }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname" class="col-md-4 control-label">Buchungsdatum</label>
                                        <div class="col-md-6">
                                            {{ (new \Carbon\Carbon($reservation->bookdate))->format('d.m.Y hh:mm') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname" class="col-md-4 control-label">Start</label>
                                        <div class="col-md-6">
                                            {{ (new \Carbon\Carbon($reservation->reservation_start))->format('d.m.Y') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname" class="col-md-4 control-label">End</label>
                                        <div class="col-md-6">
                                            {{ (new \Carbon\Carbon($reservation->reservation_end))->format('d.m.Y') }}
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">Price</label>
                                        <div class="col-md-6">
                                            {{ $reservation->price }}
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('roomId') ? ' has-error' : '' }}">
                                        <label for="roomId" class="col-md-4 control-label">Room</label>
                                        <div class="col-md-6">
                                            <select name="roomId" id="roomId" class="form-control">
                                                @foreach($rooms as $room)
                                                    @if($room->id == old('roomId', $reservation->room_id))
                                                        <option value="{{ $room->id }}" selected="selected">{{ $room->room_number }}</option>
                                                    @else
                                                        <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            @if ($errors->has('roomId'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('roomId') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                        <label for="status" class="col-md-4 control-label">Status</label>
                                        <div class="col-md-6">
                                            <select name="status" id="status" class="form-control">
                                                    @if(\App\Reservation::STATUS_NEW == old('status', $reservation->status))
                                                        <option value="{{ \App\Reservation::STATUS_NEW }}" selected="selected">New</option>
                                                    @else
                                                        <option value="{{ \App\Reservation::STATUS_NEW }}">New</option>
                                                    @endif
                                                    @if(\App\Reservation::STATUS_CONFIRMED == old('status', $reservation->status))
                                                        <option value="{{ \App\Reservation::STATUS_CONFIRMED }}" selected="selected">Bestätigt</option>
                                                    @else
                                                        <option value="{{ \App\Reservation::STATUS_CONFIRMED }}">Bestätigt</option>
                                                    @endif
                                                    @if(\App\Reservation::STATUS_REJECTED == old('status', $reservation->status))
                                                        <option value="{{ \App\Reservation::STATUS_REJECTED }}" selected="selected">Abgelehnt</option>
                                                    @else
                                                        <option value="{{ \App\Reservation::STATUS_REJECTED }}">Abgelehnt</option>
                                                    @endif
                                                    @if(\App\Reservation::STATUS_CANCELLED == old('status', $reservation->status))
                                                        <option value="{{ \App\Reservation::STATUS_CANCELLED }}" selected="selected">Abgesagt</option>
                                                    @else
                                                        <option value="{{ \App\Reservation::STATUS_CANCELLED }}">Abgesagt</option>
                                                    @endif
                                            </select>

                                            @if ($errors->has('status'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Speichern
                                            </button>
                                            <a href="{{ back() }}" class="btn btn-default">
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