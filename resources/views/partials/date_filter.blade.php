@if(isset($start_date) && isset($end_date))
<!-- DATE RANGE FILTER -->
<div class="col-md-8">
    <p>Los datos estan filtrados por el rago de fecha desde <b>{{ date('d F Y',strtotime($start_date)) }}</b> hasta <b>{{ date('d F Y',strtotime($end_date)) }}</b>, para cambiar el filtro de fecha haga clic en el calendario en la parte derecha.</p>

</div>
<div class="col-md-4">
    <div id="reportrange" class="dtrange pull-right">
        <span></span><b class="caret"></b>
    </div><br/><br/>

</div>
<!-- END RANGE FILTER -->
<script>
    function cb(start, end) {
        $('#reportrange span').html(moment(start).format('MMMM D, YYYY') + ' - ' + moment(end).format('MMMM D, YYYY'));
    }

    @if($start_date && $end_date)
        var start_date = '<?php echo $start_date; ?>';
        var end_date = '<?php echo $end_date; ?>';
        cb(start_date,end_date);
    @else
        cb(moment().subtract(29, 'days'),moment());
    @endif


    $('#reportrange').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        timePickerIncrement: 1

    },cb);

    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        console.log(picker.startDate.format('YYYY-MM-DD'));
        console.log(picker.endDate.format('YYYY-MM-DD'));
        $("#loadingDIV").show();
        window.location.replace("?start_date="+picker.startDate.format('YYYY-MM-DD')+"&end_date="+picker.endDate.format('YYYY-MM-DD'));

    });
</script>
@endif