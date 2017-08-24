@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="/img/hotelroom.jpg" class="background-hotelroom">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>{{ $hotel->name }}<h3>
                        <h4>Zimmertypen</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="float-right">
                                    <a href="{{ route('manager.roomtypes.create', ['hotel' => $hotel->id]) }}" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neu
                                    </a>
                                </div>
                                <table class="table table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Titel</th>
                                            <th>Kategorie</th>
                                            <th>Anz. Zimmer</th>
                                            <th>Preis CHF</th>
                                            <th>

                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($roomtypes as $roomtype)
                                            <tr>
                                                <td>{{ $roomtype->title }}</td>
                                                <td>{{ $roomtype->category->name }}</td>
                                                <td>{{ $roomtype->category->number_of_beds }}</td>
                                                <td>{{ $roomtype->price }}</td>
                                                <td>
                                                    <a href="{{ route('manager.roomtypes.edit', ['hotel' => $hotel->id, 'roomtype' => $roomtype->id]) }}" class="btn btn-primary">
                                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                                    </a>
                                                    <form class="deleteBtn" method="post" action="{{ route('manager.roomtypes.delete', ['hotel' => $hotel->id, 'roomtype' => $roomtype->id]) }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger center-block deleteBtn">
                                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                        </button>
                                                    </form>
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