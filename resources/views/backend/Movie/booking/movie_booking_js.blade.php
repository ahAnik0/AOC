<script  nonce="{{ csp_nonce() }}">
    $(document).ready(function () {
        $('.select2').select2();
    });
    $(function () {
        var table = $('.yajra-datatable').DataTable({
            "order": [[1, 'desc']],
            "bFilter": false,
            "columnDefs": [
                {"className": "dt-center", "targets": "_all"}
            ], "bDestroy": true,
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
            },
            drawCallback: function (settings) {
                var api = this.api();
                $('#total_data').html(api.ajax.json().recordsTotal);
            },
            ajax: {
                url: "{{ url('admin/movie/booing_member_search') }}",
                type: 'POSt',
                data: function (d) {
                    d.name = $('#name').val();
                    d.ba_no = $('#ba_no').val();
                    d.email = $('#email').val();
                    d.phone = $('#phone').val();
                    d.designation_id = $('#designation_id').val();
                    d.blood_group_id = $('#blood_group_id').val();
                    d.status = $('#status').val();
                    d.member_type = $('#member_type').val();
                    d.member_id_inputed = $('#member_id_inputed').val();
                    d._token = '{{csrf_token()}}'
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false},
                {data: 'photo', name: 'photo', orderable: false},
                {data: 'member_id_inputed', name: 'member_id_inputed', orderable: true},
                {data: 'ba_no', name: 'ba_no', orderable: true},
                {data: 'fullname', name: 'fullname', orderable: true},
                {data: 'phone', name: 'phone', orderable: true},
                {data: 'designation', name: 'designation', orderable: false},
                {data: 'status', name: 'status', orderable: false},
                {data: 'action', name: 'action', searchable: false,},
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
