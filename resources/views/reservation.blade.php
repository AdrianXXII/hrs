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
                                <h2>{{ $hotel->name }}</h2>
                                @for ($i = 0; $i < $hotel->stars; $i++)
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
                        <div class="row">
                            <div class="col-lg-4">
                                <h4>Hotelausstattung</h4>
                                @foreach($hotel->attributes as $attribute)
                                    <span class="label label-primary">{{ $attribute->description }}</span>
                                @endforeach
                            </div>
                            <div class="col-lg-4 col-lg-offset-2">
                                <h4>Zimmerausstattung</h4>
                                @foreach($roomtype->attributes as $attribute)
                                    <span class="label label-primary">{{ $attribute->description }}</span>
                                @endforeach
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
                                <form action="{{ route('reserve.save', ['hotel' => $hotel->id, 'roomtype' => $roomtype->id]) }}" class="form-horizontal" method="POST">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="roomtypeId" class="col-md-4 control-label">Zimmerart</label>
                                        <div class="col-md-6">
                                            <input type="text" readonly class="form-control" value="{{ $roomtype->title }}">
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Name</label>
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
                                        <label for="firstname" class="col-md-4 control-label">Email</label>
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
                                                <input id="startDatum" type="text" class="form-control" name="startDatum" value="{{ old('startDatum', $startDatum) }}">
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
                                                <input id="endDatum" type="text" class="form-control" name="endDatum" value="{{ old('endDatum', $endDatum) }}">
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
                                    <div class="form-group{{ $errors->has('number_of_people') ? ' has-error' : '' }}">
                                        <label for="number_of_people" class="col-md-4 control-label">Anzahl Gäste:</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="number_of_people" id="number_of_people" value="{{ old('number_of_people') }}">
                                        </div>
                                        @if ($errors->has('number_of_people'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('number_of_people') }}</strong>
                                                </span>
                                        @endif
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