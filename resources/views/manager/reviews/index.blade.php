@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @foreach($hotel->getReviews() as $review)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>{{ $review->reviewer }}</span>
                        <form method="post" class="deleteBtn pull-right" action="{{ route('manager.reviews.delete', ['hotel' => $hotel->id, 'review' => $review->id]) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger center-block deleteBtn">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </button>
                        </form>
                        <div class="clearfix"></div>

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

