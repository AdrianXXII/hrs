@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-2 col-lg-offset-1">
            @include('filter')
        </div>
        <div class="col-sm-7 col-md-7 col-lg-7">
            @if($roomtypes->count() === 0)
                <h1>Leider keine Hotels für Ihre Suche verfügbar</h1>
            @endif
            @foreach ($roomtypes as $roomtype)
                <div class="col-lg-4 col-sm-6">
                    <h2>{{ $roomtype->hotel->name }}</h2>
                    @for ($i = 0; $i < $roomtype->hotel->stars; $i++)
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    @endfor
                    @for ($i = 0; $i < $roomtype->category->number_of_beds; $i++)
                        <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                    @endfor
                    <br>

                    <div id="{{ 'carousel' . $roomtype->id }}" class="carousel slide" data-ride="carousel" style="overflow: hidden;">
                        <ol class="carousel-indicators">
                            <li data-target="{{ '#carousel' . $roomtype->id }}" data-slide-to="0" class="active"></li>
                            <li data-target="{{ '#carousel' . $roomtype->id }}" data-slide-to="1"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="/img/hotelsample.jpg" alt="Hotel" class="img-thumbnail roomtype-img">
                            </div>

                            <div class="item">
                                <img src="/img/roomsample.jpg" alt="Room" class="img-thumbnail roomtype-img">
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="{{ '#carousel' . $roomtype->id }}" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="{{ '#carousel' . $roomtype->id }}" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <strong>{{ $roomtype->title }}</strong>
                    <p>{{ $roomtype->description }}</p>
                    <p><a class="btn btn-primary" href="{{ route('reserve.create', ['hotel' => $roomtype->hotel->id, 'roomtype' => $roomtype->id, 'startDatum' => request()->get('anreisedatum'), 'endDatum' => request()->get('abreisedatum')]) }}" role="button">Reservieren »</a></p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section ('scripts')
    <script type="text/javascript">
        $(function () {
            $('#datepicker_anreise').datetimepicker({
                format: 'DD.MM.YYYY'
            });
        });

        $(function () {
            $('#datepicker_abreise').datetimepicker({
                format: 'DD.MM.YYYY'
            });
        });

        var options = [];

        $( '.dropdown-menu a' ).on( 'click', function( event ) {

            var $target = $( event.currentTarget ),
                val = $target.attr( 'data-value' ),
                $inp = $target.find( 'input' ),
                idx;

            if ( ( idx = options.indexOf( val ) ) > -1 ) {
                options.splice( idx, 1 );
                setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
            } else {
                options.push( val );
                setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
            }

            $( event.target ).blur();

            console.log( options );
            return false;
        });
    </script>

    <script>
        $('#anzahlPersonen').on('change', function(e) {
           filterPossibleCategories(e);
        });

        function filterPossibleCategories(e) {
            var $list = $('#zimmerKategorie option');
            var numberOfPersons = $(e.target).val();

            $list.each(function() {
                if($(this).data('numberofbeds') >= numberOfPersons) {
                    $(this).show();
                } else {
                    $(this).hide();
                }

                $(this).removeAttr("selected");
            });

            $availableCategories = $('#zimmerKategorie option').filter(function() {
                return $(this).data('numberofbeds') >= numberOfPersons
            });

            if($availableCategories.length >= 1) {
                $('#zimmerKategorie').prop("disabled", false);
                $('#filterButton').prop("disabled", false);
            } else {
                $('#zimmerKategorie').prop("disabled", true);
                $('#filterButton').prop("disabled", true);
            }

            $('#zimmerKategorie').find('option:visible').first().attr("selected","selected");
        }
    </script>
@endsection

