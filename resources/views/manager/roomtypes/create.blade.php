@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>{{ $hotel->name }}<h3>
                        <h4>Zimmertyp erstellen</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-10">
                                <form action="{{ route('manager.roomtypes.save', ['hotel' => $hotel->id]) }}" class="form-horizontal" method="POST">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Name</label>
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

                                    <div class="form-group{{ $errors->has('number_of_beds') ? ' has-error' : '' }}">
                                        <label for="number_of_beds" class="col-md-4 control-label">Anzahl Zimmer</label>
                                        <div class="col-md-6">
                                            <select id="number_of_beds" name="number_of_beds" class="form-control" onchange="filterPossibleCategories(this.value)">
                                                <option disabled selected value></option>
                                                @foreach($numberOfBeds as $option)
                                                    <option>{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                        <label for="category" class="col-md-4 control-label">Zimmerkategorie</label>
                                        <div class="col-md-6">
                                            <select id="category" name="category" class="form-control">
                                                <option disabled selected value></option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name . ' (' . $category->number_of_beds . ' Zimmer)'}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                        <label for="price" class="col-md-4 control-label">Preis (CHF)</label>
                                        <div class="col-md-6">
                                            <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}" required>

                                            @if ($errors->has('price'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Speichern
                                            </button>
                                            <a href="{{ route('manager.roomtypes.index', ['hotel' => $hotel->id]) }}" class="btn btn-default">
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
    <script>
        function filterPossibleCategories(val) {
            var list = document.getElementById("category");

            for(var i = 0; i < list.length; i++) {
                var matchstring = val.concat(' Zimmer');
                if (list.options[i].text.match(matchstring)) {
                    $(list.options[i]).show();
                } else {
                    $(list.options[i]).hide();
                }
            }

            list.selectedIndex = -1;
        }
    </script>
@endsection