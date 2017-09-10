@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Newsletter senden
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-10">
                                @if($recipients->count() === 0)
                                    <h1>Leider keine Abonnenten vorhanden</h1>
                                    <a href="{{ route('manager.hotels.index') }}" class="btn btn-default">
                                        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Abbrechen
                                    </a>
                                @else
                                    @if (isset($success))
                                        <div id="success-alert" class="alert alert-success">
                                            <strong>Senden Erfolgreich!</strong> Newsletter konnte erfolgreich versendet werden.
                                        </div>
                                    @endif
                                    <?php $to = "" ?>
                                    @foreach($recipients as $recipient)
                                        <?php $to .= $recipient->email . "; "; ?>
                                    @endforeach

                                    <form action="{{ route('manager.newsletter.send') }}" class="form-horizontal" method="POST">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('to') ? ' has-error' : '' }}">
                                            <label for="to" class="col-md-4 control-label">Newsletter Abonnenten</label>
                                            <div class="col-md-6">
                                                <textarea disabled id="to" class="form-control" name="to">{{ $to }}</textarea>

                                                @if ($errors->has('to'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('to') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                            <label for="subject" class="col-md-4 control-label">Betreff</label>
                                            <div class="col-md-6">
                                                <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}">

                                                @if ($errors->has('subject'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('subject') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                            <label for="body" class="col-md-4 control-label">Nachricht</label>
                                            <div class="col-md-6">
                                                <textarea id="body" class="form-control" name="body" rows="10">{{ old('body') }}</textarea>

                                                @if ($errors->has('body'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('body') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    <span class="glyphicon glyphicon-send" aria-hidden="true"></span> Senden
                                                </button>
                                                <a href="{{ route('manager.hotels.index') }}" class="btn btn-default">
                                                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Abbrechen
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script>
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("#success-alert").slideUp(500);
        });
    </script>
@endsection