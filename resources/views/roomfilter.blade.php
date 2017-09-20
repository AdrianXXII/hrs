<?php
    if(request()->get('startDatum')) {
        $startDatum = new \Carbon\Carbon(request()->get('startDatum'));
    }

    if(request()->get('endDatum')) {
        $endDatum = new \Carbon\Carbon(request()->get('endDatum'));
    }

    if(isset($startDatum) && isset($endDatum) && $startDatum >= $endDatum) {
        unset($endDatum);
    }
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        Verfügbare Zimmer filtern
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <form class="form-inline" action="{{ route('hotels.show', $hotel->id) }}" method="GET">
                    <div class="form-group">
                        <label for="startDate" class="control-label">Von</label>

                        <div class="input-group date bs-datepicker-von">
                            <input type="text" class="form-control" name="startDatum" id="startDatum"
                                   value="{{ isset($startDatum) ? $startDatum->format('d.m.Y') : '' }}">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-md-offset-1">
                        <label for="endDatum" class="control-label">Bis</label>

                        <div class="input-group date bs-datepicker-bis">
                            <input type="text" class="form-control" name="endDatum" id="endDatum"
                                   value="{{ isset($endDatum) ? $endDatum->format('d.m.Y') : '' }}">
                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                        </div>
                    </div>
                    <button type="submit" class="pull-center btn btn-primary deleteBtn col-md-offset-1">
                        <span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Los!
                    </button>
                </form>
                <div class="{{ $errors->has('rooms') ? ' has-error' : '' }}">
                    @if ($errors->has('rooms'))
                        <span class="help-block">
                                            <strong>{{ $errors->first('rooms') }}</strong>
                                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>