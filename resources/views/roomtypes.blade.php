@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-2 col-lg-offset-1">
            @include('filter')
        </div>
        <div class="col-sm-7 col-md-7 col-lg-7">
            @foreach ($roomtypes as $roomtype)
                <div class="col-lg-4 col-sm-6">
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

