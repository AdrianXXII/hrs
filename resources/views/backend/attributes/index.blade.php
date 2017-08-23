@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Attribute
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="float-right">
                                    <a href="{{ route('attributes.create') }}" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neu
                                    </a>
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Attribute</th>
                                            <th>

                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($attributes as $attribute)
                                            <tr>
                                                <td>{{ $attribute->description }}</td>
                                                <td>
                                                    <a href="{{ route('attributes.edit', ['id' => $attribute->id]) }}" class="btn btn-primary">
                                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                                    </a>
                                                    <form method="post" class="deleteBtn" action="{{ route('attributes.delete', ['id' => $attribute->id]) }}">
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