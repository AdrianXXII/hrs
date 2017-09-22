/**
 * Created by Adrian on 9/17/2017.
 */
jQuery(document).ready(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $('.bs-datepicker-von').datetimepicker({
        format: 'DD.MM.YYYY',
        useCurrent: false,
        minDate: moment()
    });

    console.log($('.bs-datepicker-von'));

    $('.bs-datepicker-bis').datetimepicker({
        format: 'DD.MM.YYYY',
        useCurrent: false
    });
    $(".bs-datepicker-von").on("dp.change", function (e) {
        console.log('test');
        $('.bs-datepicker-bis').data("DateTimePicker").minDate(e.date);
    });
    $(".bs-datepicker-bis").on("dp.change", function (e) {
        console.dir(e.date);
        $('.bs-datepicker-von').data("DateTimePicker").maxDate(e.date);
    });
});