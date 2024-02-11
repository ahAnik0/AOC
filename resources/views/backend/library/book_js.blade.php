<script  nonce="{{ csp_nonce() }}">
    $(document).ready(function () {
        $('.select2').select2();
    });

    $(function () {
        var table = $('.yajra-datatable').DataTable({
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                var intVal = function (i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                total_qty = this.api().ajax.json().total_qty
                $(api.column(6).footer()).html(
                    ' Total: ' + total_qty
                );
                total_price = this.api().ajax.json().total_price
                $(api.column(5).footer()).html(
                    ' Tk ' + total_price
                );
                actual_price = this.api().ajax.json().actual_price
                $(api.column(4).footer()).html(
                    ' Tk ' + actual_price
                );
                buy_price = this.api().ajax.json().buy_price
                $(api.column(3).footer()).html(
                    ' Tk ' + buy_price
                );
            },
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
                url: "{{ url('admin/book/search') }}",
                type: 'POSt',
                data: function (d) {
                    d.name = $('#name').val();
                    d._token = '{{csrf_token()}}'
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false},
                {data: 'book_name', name: 'book_name', orderable: true, searchable: true},
                {data: 'book_author', name: 'book_author', orderable: false},
                {data: 'buy_price', name: 'buy_price', orderable: false},
                {data: 'price', name: 'price', orderable: false},
                {data: 'total_price', name: 'total_price', orderable: false},
                {data: 'quantity', name: 'quantity', orderable: false},
                {data: 'status', name: 'status', orderable: false},
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
                    url: '{{url('admin/book/delete')}}/' + id,
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
            url: "{{url('admin/book/store')}}",
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
                $('#error_add_book_name').text(response.responseJSON.errors.book_name);
                $('#error_add_book_author').text(response.responseJSON.errors.book_author);
                $('#error_buy_price').text(response.responseJSON.errors.buy_price);
                $('#error_add_price').text(response.responseJSON.errors.price);
                $('#error_add_quantity').text(response.responseJSON.errors.quantity);
            }
        });
    })


    //edit info
    function edit(id) {
        event.preventDefault();
        disableButton()
        $('#edit_model').modal('show');
        $.ajax({
            url: "{{url('admin/book/edit')}}/" + id,
            type: "GET",
            success: function (response) {
                if (response) {
                    enableeButton()
                    $('#edit_status option[value="' + response.data.status + '"]').prop('selected', true);
                    $('#edit_book_name').val(response.data.book_name);
                    $('#edit_book_author').val(response.data.book_author);
                    $('#edit_price').val(response.data.price);
                    $('#edit_quantity').val(response.data.quantity);
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
            url: "{{url('admin/book/update')}}",
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
                $('#error_edit_book_name').text(response.responseJSON.errors.book_name);
                $('#error_edit_book_author').text(response.responseJSON.errors.book_author);
                $('#error_edit_price').text(response.responseJSON.errors.price);
                $('#error_edit_quantity').text(response.responseJSON.errors.quantity);
            }
        });
    })

    function clear_error_field() {
        $('#error_add_book_name').text('');
        $('#error_add_book_author').text('');
        $('#error_add_price').text('');
        $('#error_buy_price').text('');
        $('#error_add_quantity').text('');
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
