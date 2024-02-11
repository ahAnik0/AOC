<script  nonce="{{ csp_nonce() }}">
    $(document).ready(function () {
        $('.select2').select2();
    });
    $(function () {
        var table = $('.yajra-datatable').DataTable({
            "order": [[1, 'desc']],
            "bFilter": true,
            "columnDefs": [
                {"className": "dt-center", "targets": "_all", orderable: false}
            ], "bDestroy": true,
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
            },
            drawCallback: function (settings) {
                var api = this.api();
                $('#total_data').html(api.ajax.json().recordsTotal);
            },
            ajax: {
                url: "{{ url('admin/attendance/member_assign_device_search') }}",
                type: 'POSt',
                data: function (d) {
                    d.member_name = $('#member_name').val();
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                    d.device_id = $('#device_id').val();
                    d._token = '{{csrf_token()}}'
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false},
                {data: 'member', name: 'member', orderable: false},
                {data: 'card_id', name: 'card_id', orderable: false},
                {data: 'status', name: 'status', orderable: false},
                {data: 'auth_date', name: 'auth_date', orderable: false},
                {data: 'auth_time', name: 'auth_time', orderable: false},
                {data: 'device', name: 'device', orderable: false},
            ],
            dom: 'lBfrtip',
            buttons: [
                'excel', 'csv', 'pdf', 'print'
            ],
        });
        $('#search_form').on('submit', function (event) {
            event.preventDefault();
            table.draw(true);
        });
    });

    function form_reset() {
        document.getElementById("search_form").reset();
        $('.select2').val(null).trigger('change');
        $('.yajra-datatable').DataTable().ajax.reload(null, false);
    }
</script>
