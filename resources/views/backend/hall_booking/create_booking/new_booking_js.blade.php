<script  nonce="{{ csp_nonce() }}">
    $(document).ready(function() {
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
                setTimeout(function() {
                    $('.select2').select2();
                }, 50);
            },
            removeField(index) {
                this.fields.splice(index, 1);
            }
        }
    }

    $('#member_name').keyup(function() {
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
                success: function(data) {
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


    $("#program_date,#hall,#shift").change(function() {
        var program_date = $("#program_date").val();
        var hall = $("#hall").val();
        var shift = $("#shift").val();
        $('.error_field').html('');
        // console.warn(program_date)
        if (hall != '') {
            if (program_date != '') {
                if (shift != '' && shift != null) {
                    $.ajax({
                        url: "{{ route('check_date') }}",
                        method: "GET",
                        data: {
                            date: program_date,
                            hall: hall,
                            shift: shift,
                        },
                        success: function(data) {
                            if (data.status == "not_available") {
                                $('#hide_section').fadeOut(1000);
                                $('#error_date').html("This date is not available");
                            } else {
                                $('#hide_section').fadeIn(1000);
                                $('#error_date').html("This date is available");
                            }
                        }
                    });
                } else {
                    $('#error_shift').html("Please select a shift");
                }
            } else {
                $('#error_date').html("Please select a Date");
            }
        } else {
            $('#error_hall').html("Please select Hall first then select a Date");
        }
    })


    $(document).off().on('click', '.list', function() {
        event.preventDefault();
        $('#member_name').val('');
        $('#member_list').fadeOut();
        $('#new_member_bitton').fadeOut();
        // document.getElementById("member_name").focus();
    });

    function newMemberSection() {
        $('#member_search').fadeOut();
        $('#new_member').fadeIn();
    }

    function getcustomerdata(customer_id) {
        $.ajax({
            type: 'get',
            url: '{{ url('admin/service/get_customer_data_for_service') }}/' + customer_id,
            success: function(data) {
                console.warn(data)
                if (data.member === null) {
                    toastr.error('This member is inactive', 'Inactive');
                } else {
                    $('#member_details').fadeIn();
                    $('#member_id').val(data.member.id)
                    $('#member_name').val(data.member.fullname)
                    $('#member_id_inputed').html(data.member.member_id_inputed)
                    $('#member_ba_no').html(data.member.ba_no)
                    $('#member_name_show').html(data.member.fullname)
                    $('#member_phone').html(data.member.phone)
                    $('#previous_due').html(data.previous_due)
                    if (data.member.status == 0) {
                        $('#member_status').html('Inactive')
                    } else if (data.member.status == 1) {
                        $('#member_status').html('active')
                    } else if (data.member.status == 2) {
                        $('#member_status').html('Card Expaired')
                    }

                    if (data.member.isRetired == 0) {
                        $('#retire').html('Not Retired')
                    } else if (data.member.isRetired == 1) {
                        $('#retire').html('Retired')
                    }

                }
            }

        });
    }
    $(function() {
            $("#program_date").datepicker({
                minDate: 0,
                // dateFormat: 'yy-mm-dd' // Set the date format if needed
            });
        });

    $(document).on("keydown", "form", function(event) {
        return event.key != "Enter";
    });
</script>
