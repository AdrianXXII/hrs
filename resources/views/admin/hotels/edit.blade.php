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
                                <form action="{{ route('admin.hotels.update', ['id' => $hotel]) }}" class="form-horizontal" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Hotelname</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $hotel->name) }}">

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
                                            <textarea id="description" type="text" class="form-control" name="description" required>{{ old('description', $hotel->description) }}</textarea>

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
                                                <option {{ $hotel->stars == 1 ? 'selected' : '' }}>1</option>
                                                <option {{ $hotel->stars == 2 ? 'selected' : '' }}>2</option>
                                                <option {{ $hotel->stars == 3 ? 'selected' : '' }}>3</option>
                                                <option {{ $hotel->stars == 4 ? 'selected' : '' }}>4</option>
                                                <option {{ $hotel->stars == 5 ? 'selected' : '' }}>5</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                        <label for="street" class="col-md-4 control-label">Strasse</label>
                                        <div class="col-md-6">
                                            <input id="street" type="text" class="form-control" name="street" value="{{ old('street', $hotel->street) }}" required>

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
                                            <input id="postalcode" type="text" class="form-control" name="postalcode" value="{{ old('postalcode', $hotel->postalcode) }}" required>

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
                                            <input id="area" type="text" class="form-control" name="area" value="{{ old('area', $hotel->area) }}" required>

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
                                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone', $hotel->telephone) }}" required>

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
                                            <input id="fax" type="text" class="form-control" name="fax" value="{{ old('fax', $hotel->fax) }}" required>

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
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $hotel->email) }}" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group{{ $errors->has('managers') ? ' has-error' : '' }}">
                                        <label for="managers" class="col-md-4 control-label">Hotel Manager</label>
                                        <div class="col-md-6">
                                            <select name="managers[]"  class="form-control" id="managers" multiple>
                                                @foreach ($users as $user)
                                                    <option {{ $hotel->isManagedBy($user) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name . ' (' . $user->group->name . ')' }}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block">
                                                <p>Selektierte Einträge sind bereits als Hotelmanager/-angestellte hinterlegt.<br>
                                                Um dem Hotel weitere Hotelmanager/-angestellte hinzuzufügen, selektiere weitere Einträge.<br>
                                                </p>
                                            </span>

                                            @if ($errors->has('managers'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('managers') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Speichern
                                            </button>
                                            <a href="{{ route('users.index') }}" class="btn btn-default">
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