<script  nonce="{{ csp_nonce() }}">
    $(document).ready(function () {
        $('.select2').select2();
    });

    $(function () {
        var table = $('.yajra-datatable').DataTable({
            "order": [[1, 'desc']],
            "bFilter": true,
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
                url: "{{ url('admin/device/search') }}",
                type: 'POSt',
                data: function (d) {
                    d.name = $('#name').val();
                    d._token = '{{csrf_token()}}'
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false},
                {data: 'device_name', name: 'device_name', orderable: true},
                {data: 'device_number', name: 'device_number', orderable: false},
                {data: 'device_ip', name: 'device_ip', orderable: false},
                {data: 'action', name: 'action', searchable: false,},
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

    // delete user
    function delete_data(id) {
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
                    url: '{{url('admin/device/delete')}}/' + id,
                    success: function (response) {
                        if (response) {
                            if (response.permission == false) {
                                toastr.warning('you dont have that Permission', 'Permission Denied');
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

    // save information
    $('#save_info').off().on('submit', function (event) {
        event.preventDefault();
        disableButton()
        $.ajax({
            url: "{{url('admin/device/store')}}",
            type: "POST",
            data: $(this).serializeArray(),
            success: function (response) {
                if (response.error) {
                    error_notification(response.error)
                    enableeButton()
                }
                if (response.success) {
                    enableeButton()
                    $('.yajra-datatable').DataTable().ajax.reload(null, false);
                    toastr.success('Information Saved', 'Saved');
                    $('#add_model').modal('hide');
                }
            },
            error: function (response) {
                enableeButton()
                clear_error_field();
                error_notification('Please fill up the form correctly and try again')
                $('#error_device_name').text(response.responseJSON.errors.device_name);
                $('#error_device_number').text(response.responseJSON.errors.device_number);
                $('#error_device_ip').text(response.responseJSON.errors.device_ip);
            }
        });
    })


    //edit info
    function edit(id) {
        event.preventDefault();
        disableButton()
        $('#edit_model').modal('show');
        $.ajax({
            url: "{{url('admin/device/edit')}}/" + id,
            type: "GET",
            success: function (response) {
                if (response) {
                    enableeButton()
                    $('#edit_status option[value="' + response.data.status + '"]').prop('selected', true);
                    $('#edit_device_name').val(response.data.device_name);
                    $('#edit_device_number').val(response.data.device_number);
                    $('#edit_device_ip').val(response.data.device_ip);
                    $('#edit_id').val(response.data.id);
                }
            }
        });
    }

    // Update information
    $('#update_form').off().on('submit', function (event) {
        event.preventDefault();
        disableButton()
        $.ajax({
            url: "{{url('admin/device/update')}}",
            type: "POST",
            data: $(this).serializeArray(),
            success: function (response) {
                if (response.error) {
                    error_notification(response.error)
                    enableeButton()
                }
                if (response.success) {
                    enableeButton()
                    $('.yajra-datatable').DataTable().ajax.reload(null, false);
                    toastr.success('Information Updated', 'Saved');
                    $('#edit_model').modal('hide');
                }
            },
            error: function (response) {
                enableeButton()
                clear_error_field();
                error_notification('Please fill up the form correctly and try again')
                $('#error_edit_device_name').text(response.responseJSON.errors.device_name);
                $('#error_edit_device_number').text(response.responseJSON.errors.device_number);
                $('#error_edit_device_ip').text(response.responseJSON.errors.device_ip);
            }
        });
    })

    function clear_error_field() {
        $('#error_device_name').text('');
        $('#error_device_number').text('');
        $('#error_device_ip').text('');
    }

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


    function error_notification(message) {
        var notify = $.notify('<i class="fa fa-bell-o"></i><strong>' + message + '</strong> ', {
            type: 'theme',
            allow_dismiss: true,
            delay: 2000,
            showProgressbar: true,
            timer: 300
        });
    }


</script>
