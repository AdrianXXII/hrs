@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('roomfilter')
        <h1>{{ $hotel->name }}
                @for ($i = 0; $i < $hotel->stars; $i++)
                    <span class="pull-right glyphicon glyphicon-star" aria-hidden="true"></span>
                @endfor
        </h1>
        @if (session('success') && session('success') === true)
            <div id="status-alert" class="alert alert-success">
                <strong>Senden Erfolgreich!</strong> Ihre Reservation wurde abgesendet. Sie werden bald dies bezüglich Kontaktiert.
            </div>
        @elseif ((session('success') && session('success') === false))
            <div id="status-alert" class="alert alert-danger">
                <strong>Senden Fehlgeschlagen!</strong> Ihre Reservation wurde abgesendet.
            </div>
        @endif
        <hr>
            @if($roomTypes->count() == 0 && $filtered)
                <h2>Leider keine Zimmer für den angegebenen Zeitraum gefunden.</h2>
            @endif
            @foreach ($roomTypes as $roomType)
                <div class="col-lg-4">
                    <h3>{{ $roomType->title }}
                        @for ($i = 0; $i < $roomType->category->number_of_beds ; $i++)
                            <span class="pull-right glyphicon glyphicon-user" aria-hidden="true"></span>
                        @endfor
                    </h3>
                    <img alt="hotelsample" class="img-thumbnail" src="/img/roomsample.jpg" data-holder-rendered="true">
                    <p>{{ $roomType->description }}</p>
                    @if($filtered)
                        <a class="btn btn-primary" href="{{ route('reserve.create', ['hotel' => $hotel->id, 'roomtype' => $roomType->id, 'startDatum' => request()->get('startDatum'), 'endDatum' => request()->get('endDatum')]) }}" role="button">Reservieren »</a>
                    @endif
                </div>
            @endforeach
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">

            <div class="panel panel-info">
                <div class="panel-heading">
                    Review abgeben
                </div>
                <div class="panel-body">
                    <form action="{{ route('review.save', ['id' => $hotel->id ]) }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('reviewer') ? ' has-error' : '' }}">
                            <label for="reviewer" class="col-md-4 control-label">Name*</label>
                            <div class="col-md-6">
                                <input id="reviewer" type="text" class="form-control" name="reviewer" value="{{ old('reviewer') }}">

                                @if ($errors->has('reviewer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reviewer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
                            <label for="rating" class="col-md-4 control-label">Bewertung*</label>
                            <div class="col-md-6">
                                <select class="form-control" name="rating" id="rating">
                                    @for($i = 5; $i > 0; $i--)
                                        <option value="{{ $i  }}">{{ $i }}</option>
                                    @endfor
                                </select>

                                @if ($errors->has('rating'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rating') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('reviewer') ? ' has-error' : '' }}">
                            <label for="review" class="col-md-4 control-label">Kommentar*</label>
                            <div class="col-md-6">
                                <textarea id="review" rows="5" class="form-control" name="review">{{ old('review') }}</textarea>

                                @if ($errors->has('review'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('review') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Review abgeben
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            @foreach($hotel->getReviews() as $review)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $review->reviewer }}
                    </div>
                    <div class="panel-body">
                        <p>
                            @for ($i = 0; $i < $review->rating; $i++)
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            @endfor
                        </p>
                        <p>
                            {!! nl2br(e($review->review)) !!}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

