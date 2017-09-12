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
                                <address>
                                    <strong>{{ $hotel->name }}</strong>
                                    @for ($i = 0; $i < $hotel->stars; $i++)
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    @endfor
                                    <br>
                                    {{ $hotel->street }}<br>
                                    {{ $hotel->postalcode . ' ' . $hotel->area }}3<br>
                                </address>

                                <address>
                                    <strong>Kontakt</strong><br>
                                    <abbr title="Telefonnummer">Tel:</abbr> {{ $hotel->telephone }}<br>
                                    <abbr title="Faxnummer">Fax:</abbr> {{ $hotel->fax }}<br>
                                    <a href="mailto:#">{{ $hotel->email }}</a>
                                </address>

                                <hr>

                                <form action="{{ route('manager.hotels.update', ['id' => $hotel]) }}" class="form-horizontal" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="form-group{{ $errors->has('attributes') ? ' has-error' : '' }}">
                                        <label for="managers" class="col-md-4 control-label">Hotelattribute</label>
                                        <div class="col-md-6">
                                            <select size="11" name="attributes[]"  class="form-control" id="managers" multiple>
                                                @foreach ($attributes as $attribute)
                                                    <option {{ $hotel->hasAttribute($attribute) ? 'selected' : '' }} value="{{ $attribute->id }}">
                                                        {{ $attribute->description }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('managers') ? ' has-error' : '' }}">
                                        <label for="managers" class="col-md-4 control-label">Hotelangestellte</label>
                                        <div class="col-md-6">
                                            <select size="11" name="staff[]"  class="form-control" id="managers" multiple>
                                                @foreach ($users as $user)
                                                    <option {{ $hotel->isManagedBy($user) ? 'selected' : '' }} value="{{ $user->id }}">
                                                        {{ $user->firstname . ' ' . $user->lastname . ' (' . $user->name . ')' }}
                                                    </option>
                                                @endforeach
                                            </select>

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
                                            <a href="{{ route('manager.hotels.index') }}" class="btn btn-default">
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