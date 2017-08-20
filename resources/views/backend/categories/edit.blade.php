@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Hotelkategorie
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-10">
                                <form action="{{ route('backend.categories.update', ['id' => $category]) }}" class="form-horizontal" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Bezeichnung</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}">

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
                                            <textarea id="description" type="text" class="form-control" name="description" required>{{ old('description', $category->description) }}</textarea>

                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('number_of_beds') ? ' has-error' : '' }}">
                                        <label for="description" class="col-md-4 control-label">Anzahl Betten</label>
                                        <div class="col-md-6">
                                            <input id="number_of_beds" type="number" min="1" class="form-control" name="number_of_beds" value="{{ old('number_of_beds', $category->number_of_beds) }}">

                                            @if ($errors->has('number_of_beds'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('number_of_beds') }}</strong>
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
                                            <a href="{{ route('backend.categories.index') }}" class="btn btn-default">
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