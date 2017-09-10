@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>{{ $hotel->name }}</h1>
        @if (! $hotel->getRooms() == null)
            @foreach ($hotel->getRoomTypes() as $roomType)
                <div class="col-lg-4">
                    <h4>{{ $roomType->title }}</h4>
                    @for ($i = 0; $i < $roomType->category->number_of_beds ; $i++)
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    @endfor
                    <br>
                    <img alt="hotelsample" class="img-thumbnail" src="/img/roomsample.jpg" data-holder-rendered="true">
                    <p>{{ $roomType->description }}</p>
                    <p><a class="btn btn-primary" href="#" role="button">Reservieren »</a></p>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection

