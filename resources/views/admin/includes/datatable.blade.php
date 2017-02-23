@section('scripts')
<link href="{{ url('') }}/assets/admin/datatables/datatables.bootstrap.css" rel="stylesheet">
<link href="{{ url('') }}/assets/admin/js/data-table/css/dataTables.responsive.css" rel="stylesheet">
<script src="{{ url('') }}/assets/admin/datatables/datatables.min.js" type="text/javascript"></script>
<script src="{{ url('') }}/assets/admin/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<style type="text/css">
    .dt-buttons{
        float:right;
        margin-top: 20px;
        margin-bottom: 20px;
        margin-right: 20px;
    }
    #sample_1_length {
        margin-left: 20px;
    }
    #sample_1_filter{
        margin-right: 20px;
    }
</style>
<script type="text/javascript">
var table = $('#sample_1');

    var oTable = table.dataTable({
        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
        "language": {
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            "emptyTable": "No data available in table",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "No entries found",
            "infoFiltered": "(filtered1 from _MAX_ total entries)",
            "lengthMenu": "_MENU_ entries",
            "search": "Search:",
            "zeroRecords": "No matching records found"
        },
        buttons: [
            { extend: 'print', className: 'btn btn-default dark btn-outline' },
            { extend: 'copy', className: 'btn btn-default red btn-outline' },
            { extend: 'pdf', className: 'btn btn-default green btn-outline' },
            { extend: 'excel', className: 'btn btn-default yellow btn-outline ' },
            { extend: 'csv', className: 'btn btn-default purple btn-outline ' },
            // { extend: 'colvis', className: 'btn btn-default dark btn-outline', text: 'Columns'}
        ],

        // setup responsive extension: http://datatables.net/extensions/responsive/
        responsive: true,

        "order": [
            [0, 'asc']
        ],

        "lengthMenu": [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "pageLength": 10,

        "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

    });

    var table = $('#sample_2');

        var oTable = table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "_MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },
            buttons: [
                { extend: 'print', className: 'btn btn-default dark btn-outline' },
                { extend: 'copy', className: 'btn btn-default red btn-outline' },
                { extend: 'pdf', className: 'btn btn-default green btn-outline' },
                { extend: 'excel', className: 'btn btn-default yellow btn-outline ' },
                { extend: 'csv', className: 'btn btn-default purple btn-outline ' },
                // { extend: 'colvis', className: 'btn btn-default dark btn-outline', text: 'Columns'}
            ],

            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: true,

            "order": [
                [0, 'asc']
            ],

            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

        });
</script>
@stop
