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
                                <form action="{{ route('backend.hotels.save') }}" class="form-horizontal" method="POST">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Hotelname</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label for="description" class="col-md-4 control-label">Beschreibung</label>
                                        <div class="col-md-6">
                                            <textarea id="description" type="text" class="form-control" name="description" required>{{ old('description') }}</textarea>

                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('stars') ? ' has-error' : '' }}">
                                        <label for="stars" class="col-md-4 control-label">Sterne</label>
                                        <div class="col-md-6">
                                            <select id="stars" name="stars" class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                        <label for="street" class="col-md-4 control-label">Strasse</label>
                                        <div class="col-md-6">
                                            <input id="street" type="text" class="form-control" name="street" value="{{ old('street') }}" required>

                                            @if ($errors->has('street'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('street') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('postalcode') ? ' has-error' : '' }}">
                                        <label for="postalcode" class="col-md-4 control-label">Postleitzahl</label>
                                        <div class="col-md-6">
                                            <input id="postalcode" type="text" class="form-control" name="postalcode" value="{{ old('postalcode') }}" required>

                                            @if ($errors->has('postalcode'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('postalcode') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                                        <label for="area" class="col-md-4 control-label">Ort</label>
                                        <div class="col-md-6">
                                            <input id="area" type="text" class="form-control" name="area" value="{{ old('area') }}" required>

                                            @if ($errors->has('area'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('area') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label for="phone" class="col-md-4 control-label">Telefon</label>
                                        <div class="col-md-6">
                                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>

                                            @if ($errors->has('phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
                                        <label for="fax" class="col-md-4 control-label">Fax</label>
                                        <div class="col-md-6">
                                            <input id="fax" type="text" class="form-control" name="fax" value="{{ old('fax') }}" required>

                                            @if ($errors->has('fax'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('fax') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">E-Mail</label>
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Speichern
                                            </button>
                                            <a href="{{ route('backend.hotels.index') }}" class="btn btn-default">
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