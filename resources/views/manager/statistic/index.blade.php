@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Statistik</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <form action="{{ route('manager.statistic.index') }}" class="form-horizontal" method="GET">
                                    {{ csrf_field() }}

                                        <label for="zeitraum" class="control-label">Zeitraum</label>
                                        <select class="form-control" id="zeitraum" name="timerange">
                                            <option {{ $timeRange == 30 ? "selected" : "" }} value="30">Letzte 30 Tage</option>
                                            <option {{ $timeRange == 90 ? "selected" : "" }} value="90">Letzte 90 Tage</option>
                                            <option {{ $timeRange == 180 ? "selected" : "" }} value="180">Letzte 180 Tage</option>
                                            <option {{ $timeRange == 365 ? "selected" : "" }} value="365">Letzte 365 Tage</option>
                                        </select>
                                        <br>
                                        <button type="submit" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Suchen
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                @include('manager.statistic.part.profitablerooms')
                                <hr>
                                @include('manager.statistic.part.roomusing')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection