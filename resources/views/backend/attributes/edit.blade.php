@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Zusatzleistungen
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-10">
                                <form action="{{ route('attributes.update',['id' => $attribute->id] ) }}" class="form-horizontal" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label for="description" class="col-md-4 control-label">Beschreibung</label>
                                        <div class="col-md-6">
                                            <input id="description" type="text" class="form-control" name="description" value="{{ old('description',$attribute->description) }}">

                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('hotel_atr') ? ' has-error' : '' }}">
                                        <label for="hotel_atr" class="col-md-4 control-label">Hotel Attribute?</label>
                                        <div class="col-md-6">
                                            @if( old('hotel_atr',$attribute->hotel_atr) == 1)
                                                <label class="radio-inline"><input id="hotel_atr" type="radio" name="hotel_atr" checked value="1">Ja</label>
                                                <label class="radio-inline"><input id="hotel_atr" type="radio" name="hotel_atr" value="0">Nein</label>
                                            @else
                                                <label class="radio-inline"><input id="hotel_atr" type="radio" name="hotel_atr" value="1">Ja</label>
                                                <label class="radio-inline"><input id="hotel_atr" type="radio" name="hotel_atr" checked value="0">Nein</label>
                                            @endif
                                            @if ($errors->has('hotel_atr'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('hotel_atr') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Speichern
                                            </button>
                                            <a href="{{ route('attributes.index') }}" class="btn btn-default">
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