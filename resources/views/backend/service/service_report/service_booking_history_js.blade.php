<script  nonce="{{ csp_nonce() }}">
    $(document).ready(function() {
        $('.select2').select2();
    });
    $(function() {
        var table = $('.yajra-datatable').DataTable({
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };
                total = this.api().ajax.json().sum
                pageTotal = api
                    .column(4, {
                        page: 'current'
                    })
                    .data()
                    .sum()
                $(api.column(4).footer()).html(
                    ' Tk ' + total + ' total'
                );
            },
            "order": [
                [1, 'desc']
            ],
            "bFilter": false,
            "columnDefs": [{
                "className": "dt-center",
                "targets": "_all",
                orderable: false
            }],
            "bDestroy": true,
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
            },
            drawCallback: function(settings) {
                var api = this.api();
                $('#total_data').html(api.ajax.json().recordsTotal);
            },
            ajax: {
                url: "{{ url('admin/service/service_report_search') }}",
                type: 'POSt',
                data: function(d) {
                    d.service_name = $('#service_name').val();
                    d.member_id = $('#member_id').val();
                    d.member_name = $('#member_name').val();
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                    d._token = '{{ csrf_token() }}'
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'service_name',
                    name: 'service_name',
                    orderable: true
                },
                {
                    data: 'member',
                    name: 'member',
                    orderable: false
                },
                {
                    data: 'number_of_person',
                    name: 'number_of_person',
                    orderable: true
                },
                {
                    data: 'name_of_guests',
                    name: 'name_of_guests',
                    orderable: true
                },
                {
                    data: 'amount',
                    name: 'amount',
                    orderable: true
                },
                {
                    data: 'date',
                    name: 'date',
                    orderable: false
                },
                {
                    data: 'time',
                    name: 'time',
                    orderable: false
                },
                {
                    data: 'remarks',
                    name: 'remarks',
                    orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
            // dom: 'lBfrtip',
            dom: 'lBfrtip',
        buttons: [
             'csv', 'excel', 'pdf', 'print'
        ],
        }).buttons();
        $('#search_form').on('submit', function(event) {
            event.preventDefault();
            table.draw(true);
        });
    });

    function form_reset() {
        document.getElementById("search_form").reset();
        $('.select2').val(null).trigger('change');
        $('.yajra-datatable').DataTable().ajax.reload(null, false);
    }

    // delete user
    function delete_member(id) {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                $.ajax({
                    type: 'get',
                    url: '{{ url('admin/member/delete_member') }}/' + id,
                    success: function(response) {
                        if (response) {
                            if (response.permission == false) {
                                toastr.error('you dont have that Permission', 'Permission Denied');
                            } else {
                                toastr.success('Deleted Successful', 'Deleted');
                                $('.yajra-datatable').DataTable().ajax.reload(null, false);
                            }
                        }
                    }
                });
            } else if (
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        })
    }

    function cancel(id) {
        $('#cancel_id').val(id)
        $('#cancel_model').modal('show');
    }


    $('#save_cancel_info').off().on('submit', function(event) {
        event.preventDefault();
        disableButton()
        $.ajax({
            url: "{{ url('admin/service/cancel_service') }}",
            type: "POST",
            data: $(this).serializeArray(),
            success: function(response) {
                if (response.error) {
                    error_notification(response.error)
                    enableeButton()
                }
                if (response.success) {
                    enableeButton()
                    $('.yajra-datatable').DataTable().ajax.reload(null, false);
                    toastr.success('Canceled', 'Updated');
                    $('#cancel_model').modal('hide');
                }
            },
            error: function(response) {
                enableeButton()
                clear_error_field();
                error_notification('Please fill up the form correctly and try again')
                $('#error_cancel_reason').text(response.responseJSON.errors.cancel_reason);
            }
        });
    })

    function disableButton() {
        var btn = document.getElementById('form_submission_button');
        btn.disabled = true;
        btn.innerText = 'Saving....';
    }

    function enableeButton() {
        var btn = document.getElementById('form_submission_button');
        btn.disabled = false;
        btn.innerText = 'Save'
    }


    feather.replace()
</script>
