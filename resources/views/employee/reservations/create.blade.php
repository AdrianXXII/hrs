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
                            <div class="col-lg-6">
                                <h2>{{ $roomtype->hotel->name }}</h2>
                                @for ($i = 0; $i < $roomtype->hotel->stars; $i++)
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                @endfor
                                <br>
                                <img alt="hotelsample" class="img-thumbnail" src="/img/hotelsample.jpg" data-holder-rendered="true">
                                <p>{{ $roomtype->hotel->description }}</p>
                            </div>
                            <div class="col-lg-6">
                                <h2>{{ $roomtype->title }}</h2>
                                @for ($i = 0; $i < $roomtype->category->number_of_beds ; $i++)
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                @endfor
                                <br>
                                <img alt="hotelsample" class="img-thumbnail" src="/img/roomsample.jpg" data-holder-rendered="true">
                                <p>{{ $roomtype->description }}</p>
                            </div>
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
                                <form action="{{ route('employee.reservations.save') }}" class="form-horizontal" method="POST">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="roomtypeId" class="col-md-4 control-label">Zimmerart</label>
                                        <div class="col-md-6">
                                            <input type="hidden" name="roomtypeId" id="roomtypeId" value="{{ $roomtype->id }}">
                                            <input type="text" class="form-control" readonly name="roomtype" value="{{ $roomtype->title }}">
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Kundenname</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                        <label for="firstname" class="col-md-4 control-label">Vorname</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="firstname" id="firstname" value="{{ old('firstname') }}">
                                        </div>
                                        @if ($errors->has('firstname'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('firstname') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">Email</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                        <label for="telephone" class="col-md-4 control-label">Tel.</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="telephone" id="telephone" value="{{ old('telephone') }}">
                                        </div>
                                        @if ($errors->has('telephone'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('telephone') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('startDatum') ? ' has-error' : '' }}">
                                        <label for="startDatum" class="col-md-4 control-label">Anreisedatum</label>
                                        <div class="col-md-6">

                                            <div class="input-group date bs-datepicker-von">
                                                <input id="startDatum" type="text" class="form-control" name="startDatum" value="{{ old('startDatum', $startDatum->format('d.m.Y')) }}">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        @if ($errors->has('startDatum'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('startDatum') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('endDatum') ? ' has-error' : '' }}">
                                        <label for="endDatum" class="col-md-4 control-label">Abreisedatum</label>
                                        <div class="col-md-6">
                                            <div class="input-group date bs-datepicker-bis">
                                                <input id="endDatum" type="text" class="form-control" name="endDatum" value="{{ old('endDatum', $endDatum->format('d.m.Y')) }}">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        @if ($errors->has('endDatum'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('endDatum') }}</strong>
                                                </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                        <label for="price" class="col-md-4 control-label">Preis</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="price" id="price" value="{{ old('price') }}">

                                        </div>
                                        @if ($errors->has('price'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('number_of_people') ? ' has-error' : '' }}">
                                        <label for="number_of_people" class="col-md-4 control-label">Anzahl Gäste</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="number_of_people" id="number_of_people" value="{{ old('number_of_people') }}">

                                        </div>
                                        @if ($errors->has('number_of_people'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('number_of_people') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('roomId') ? ' has-error' : '' }}">
                                        <label for="roomId" class="col-md-4 control-label">Zimmer</label>
                                        <div class="col-md-6">
                                            <select name="roomId" id="roomId" class="form-control">
                                                @foreach($rooms as $room)
                                                    @if($room->id == old('roomId'))
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