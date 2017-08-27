@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($hotels as $hotel)
            <div class="col-lg-4">
                <h2>{{ $hotel->name }}</h2>
                @for ($i = 0; $i < $hotel->stars; $i++)
                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                @endfor
                <br>
                <img alt="hotelsample" class="img-thumbnail" src="/img/hotelsample.jpg" data-holder-rendered="true">
                <p>{{ $hotel->description }}</p>
                <p><a class="btn btn-primary" href="{{ route('hotels.show', ['hotel' => $hotel->id]) }}" role="button">Zum Hotel »</a></p>
            </div>
        @endforeach
    </div>
</div>
@endsection

