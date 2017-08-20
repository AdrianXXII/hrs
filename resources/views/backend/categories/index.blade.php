@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Hotelkategorien
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="float-right">
                                    <a href="{{ route('backend.categories.create') }}" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neu
                                    </a>
                                </div>
                                <table class="table table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Beschreibung</th>
                                            <th>Anzahl Zimmer</th>
                                            <th>

                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->description }}</td>
                                                <td>{{ $category->number_of_beds }}</td>
                                                <td>
                                                    <a href="{{ route('backend.categories.edit', ['id' => $category->id]) }}" class="btn btn-primary">
                                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                                    </a>
                                                    <form method="post" action="{{ route('backend.categories.delete', ['id' => $category->id]) }}">
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