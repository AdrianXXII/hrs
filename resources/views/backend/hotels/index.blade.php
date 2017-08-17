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
                                <div class="float-right">
                                    <a href="{{ route('backend.hotels.create') }}" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neu
                                    </a>
                                </div>
                                <table class="table table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Hotelname</th>
                                            <th>Adresse</th>
                                            <th>Hotelbenutzer</th>
                                            <th>

                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hotels as $hotel)
                                            <tr>
                                                <td>{{ $hotel->name }}</td>
                                                <td> {{ $hotel->street . ', ' . $hotel->area }}</td>
                                                <td>
                                                    <ul class="list-unstyled">
                                                    @foreach ($hotel->users as $user)
                                                        <li class="">{{ $user->name }}</li>
                                                    @endforeach
                                                    <ul>
                                                </td>
                                                <td>
                                                    <a href="{{ route('backend.hotels.edit', ['id' => $hotel->id]) }}" class="btn btn-primary">
                                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                                    </a>
                                                    <form method="post" action="{{ route('backend.hotels.delete', ['id' => $hotel->id]) }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger center-block">
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