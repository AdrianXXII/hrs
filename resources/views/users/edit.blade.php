@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Benutzer
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-10">
                                <form action="{{ route('users.update', ['id' => $user]) }}" class="form-horizontal" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Benutzername</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" readonly value="{{ $user->name }}">

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                        <label for="firstname" class="col-md-4 control-label">Vorname</label>
                                        <div class="col-md-6">
                                            <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname', $user->firstname) }}">

                                            @if ($errors->has('firstname'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                        <label for="lastname" class="col-md-4 control-label">Nachname</label>
                                        <div class="col-md-6">
                                            <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname', $user->lastname) }}">

                                            @if ($errors->has('lastname'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('lastname') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">E-Mail</label>
                                        <div class="col-md-6">
                                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email', $user->email) }}">

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('groupId') ? ' has-error' : '' }}">
                                        <label for="groupId" class="col-md-4 control-label">Group</label>
                                        <div class="col-md-6">
                                            <select name="groupId" id="groupId" class="form-control">
                                                @foreach($groups as $group)
                                                    @if($group->id == old('groupId', $user->group->id))
                                                        <option value="{{ $group->id }}" selected="selected">{{ $group->name }}</option>
                                                    @else
                                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            @if ($errors->has('groupId'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('groupId') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

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