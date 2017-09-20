@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Hotels
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <table class="table table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Hotelname</th>
                                            <th>Adresse</th>
                                            <th>Aktionen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hotels as $hotel)
                                            <tr>
                                                <td>{{ $hotel->name }}</td>
                                                <td> {{ $hotel->street . ', ' . $hotel->area }}</td>

                                                <td>
                                                    <a href="{{ route('employee.rooms.index', ['id' => $hotel->id]) }}" class="btn btn-default">
                                                        Zimmer
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection