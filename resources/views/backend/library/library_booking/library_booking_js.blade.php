<script nonce="{{ csp_nonce() }}">
    $(document).ready(function () {
        $('.select2').select2();
    });

    function handler() {
        return {
            fields: [],
            addNewField() {
                this.fields.push({
                    txt1: '',
                    txt2: ''
                });
                setTimeout(function () {
                    $('.select2').select2();
                }, 50);
            },
            removeField(index) {
                this.fields.splice(index, 1);
            }
        }
    }

    $('#member_name').keyup(function () {
        var query = $(this).val();
        if (query != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('admin.service/search_service_member') }}",
                method: "POST",
                data: {
                    query: query,
                    _token: _token
                },
                success: function (data) {
                    // console.warn(data)
                    $('#member_list').fadeIn();
                    $('#member_list').html(data);
                }
            });
        } else if (query == '') {
            $('#member_list').html('');
            $('#member_details').fadeOut();
        }
    });

    $(document).off().on('click', '.list', function () {
        event.preventDefault();
        $('#member_name').val('');
        $('#member_list').fadeOut();
        $('#new_member_bitton').fadeOut();
        // document.getElementById("member_name").focus();
    });

    $("form").submit(function () {
        //your code....
        setTimeout(function () {
            window.location.reload();
        }, 2000);
    });

    function newMemberSection() {
        $('#member_search').fadeOut();
        $('#new_member').fadeIn();
    }

    $('#book_name').keyup(function () {
        var query = $(this).val();
        if (query != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('admin.library/search_book') }}",
                method: "POST",
                data: {
                    query: query,
                    _token: _token
                },
                success: function (data) {
                    // console.warn(data)
                    $('#booklist').fadeIn();
                    $('#booklist').html(data);
                }
            });
        } else if (query == '') {
            $('#book_list').html('');
        }
    });

    $(document).off().on('click', '.book_list', function () {
        event.preventDefault();
        $('#booklist').fadeOut();
    });

    function getcustomerdata(customer_id) {
        $.ajax({
            type: 'get',
            url: '{{ url('admin/service/get_customer_data_for_service') }}/' + customer_id,
            success: function (data) {
                if (data.member === null) {
                    toastr.error('This member is inactive', 'Inactive');
                } else {
                    $('#member_details').fadeIn();
                    $('#member_list').fadeOut();
                    $('#member_id').val(data.member.id)
                    $('#member_name').val(data.member.fullname)
                    $('#member_id_inputed').html(data.member.member_id_inputed)
                    $('#member_ba_no').html(data.member.ba_no)
                    $('#member_name_show').html(data.member.fullname)
                    $('#member_phone').html(data.member.phone)
                    if (data.member.status == 0) {
                        $('#member_status').html('Inactive')
                    } else if (data.member.status == 1) {
                        $('#member_status').html('active')
                    } else if (data.member.status == 2) {
                        $('#member_status').html('Card Expaired')
                    }

                }
            }

        });
    }

    $(document).on("keydown", "form", function (event) {
        return event.key != "Enter";
    });

    function getBookData(id) {
        $.ajax({
            type: 'get',
            url: '{{ url('admin/library/single_book_search') }}/' + id,
            success: function (data) {
                // console.log(data)
                if (data.book === null) {
                    toastr.error('Book Not Available in stock', 'Not Available');
                } else {
                    var stock_id = [];
                    $('.stock_id').each(function () {
                        stock_id.push(this.value);
                    });
                    console.warn(data)
                    if (checkValue(id, stock_id) === 'yes') {
                        toastr.warning('Item Already selected', 'Already Selected');
                    } else {
                        var markup = "<tr><td>" + data.book.book_name + "</td><td>" + data.book.quantity + "</td><td><div> <input type='number' value='' class='qty' " +
                            "name='input_quantity[]' id='qty'> " + "</div></td> <td><input " + "type='text' disabled " +
                            "value=" +
                            data.book.price + " id='actual_price'></td><td><input type='text' class='btn btn-sm btn-success total_unit_price' readonly " + "id='total_unit_price' " +
                            "value=''><input " + "type='hidden' disabled value=" + data.book.id + " class='stock_id'></td><td><input type='button' " + "value='Delete'" +
                            " class='btn btn-sm btn-danger'></td></tr>";
                        $("#dsTable tbody").append(markup);
                    }
                }
            }
        });
    }

    function checkValue(value, arr) {
        var status = 'no';
        for (var i = 0; i < arr.length; i++) {
            var name = arr[i];
            if (name == value) {
                status = 'yes';
                break;
            }
        }

        return status;
    }

    $(document).on('keyup', '.qty', function () {
        var $row = $(this).closest('tr');
        var actual_price = $row.find('#actual_price').val();
        $row.find('#total_unit_price').val(($row.find('#qty').val() * actual_price).toFixed(2))
        show_total_quantity();
        show_total_grand_total()
    });

    function show_total_quantity() {
        var calculated_total_sum = 0;
        $("#dsTable .qty").each(function () {
            var get_textbox_value = $(this).val();
            if ($.isNumeric(get_textbox_value)) {
                calculated_total_sum += parseFloat(get_textbox_value);
            }
        });
        $("#total_quantity").html(calculated_total_sum);
    };

    function show_total_grand_total() {
        var labour_bill = Number($("#labour_bill").val())
        var calculated_total_sum = 0;
        $("#dsTable .total_unit_price").each(function () {
            var get_textbox_value = $(this).val();
            if ($.isNumeric(get_textbox_value)) {
                calculated_total_sum += parseFloat(get_textbox_value);
            }
        });
        var grand_total = Number(calculated_total_sum)
        $("#grand_total").html(grand_total);
    };

    function store_sales_data() {
        disableButton()
        var stock_id = [];
        $('.stock_id').each(function () {
            stock_id.push(this.value);
        });

        var per_quantity = [];
        $('.qty').each(function () {
            per_quantity.push(this.value);
        });

        var per_total_unit_price = [];
        $('.total_unit_price').each(function () {
            per_total_unit_price.push(this.value);
        });

        $.ajax({
            type: 'post',
            url: '{{ url('admin/library/submit_booking') }}',
            data: {
                member_id: $("#member_id").val(),
                grand_total: $("#grand_total").text(),
                quantity: $("#total_quantity").text(),
                stock_id: stock_id,
                per_quantity: per_quantity,
                per_total_unit_price: per_total_unit_price,
                "_token": "{{ csrf_token() }}",
            },
            success: function (data) {
                if (data.error) {
                    enableeButton()
                    toastr.error(data.error, 'Error');
                } else if (data.success) {
                    document.getElementById('form_submission_button').innerText = 'saved';
                    toastr.success('Sales successfully Completed', 'Updated');
                    window.open("{{ url('admin/library/library_slip_print') }}/" + data.booking_id, "_blank");
                    location.reload()
                }
            },
            error: function (response) {
                enableeButton()
                toastr.error(response.responseJSON.errors.customer_id);
                toastr.error(response.responseJSON.errors.stock_id);
                toastr.error(response.responseJSON.errors.grand_total);
                toastr.error(response.responseJSON.errors.per_quantity);
                toastr.error(response.responseJSON.errors.per_unit_price);
                toastr.error(response.responseJSON.errors.per_total_unit_price);
                toastr.error(response.responseJSON.errors.per_payment_type);
                toastr.error(response.responseJSON.errors.per_payment_amount);
                toastr.error(response.responseJSON.errors.sales_executive_id);
                toastr.error(response.responseJSON.errors.labour_bill);
            }
        });
    }

    function disableButton() {
        var btn = document.getElementById('form_submission_button');
        btn.disabled = true;
        btn.innerText = 'Saving....';
    }

    function enableeButton() {
        var btn = document.getElementById('form_submission_button');
        btn.disabled = false;
        btn.innerText = 'Save and continue'
    }


    function deleteRow(row) {
        document.getElementById('dsTable').deleteRow(row);
        show_total_quantity();
        show_total_grand_total();
    }

    function tableclick(e) {
        if (!e)
            e = window.event;
        if (e.target.value == "Delete")
            deleteRow(e.target.parentNode.parentNode.rowIndex);
    }

    document.getElementById('dsTable').addEventListener('click', tableclick, false);

</script>
