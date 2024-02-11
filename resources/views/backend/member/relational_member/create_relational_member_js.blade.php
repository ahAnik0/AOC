<script  nonce="{{ csp_nonce() }}">
    $(document).ready(function () {
        $('.select2').select2();
    });

    $("#relationship_id").change(function () {
        disableButton()
        $.ajax({
            url: "{{url('relationship_search')}}/" + $(this).val(),
            type: "GET",
            success: function (response) {
                if (response) {
                    enableeButton()
                    $('#ba_no').val($('#ba_no_hidden').val()+response[0]);
                    $('#member_id_inputed').val($('#member_id_inputed_hidden').val()+response[0]);
                }
            },

        });
    });


    // save information
    $('#save_info').off().on('submit', function (event) {
        event.preventDefault();
        disableButton()
        $.ajax({
            url: "{{url('admin/member/store_relational_member')}}",
            type: "POST",
            data: $(this).serializeArray(),
            success: function (response) {
                if (response.error) {
                    error_notification(response.error)
                    enableeButton()
                }
                if (response.success) {
                    disableButton()
                    toastr.success('Information Saved', 'Saved');
                    setTimeout(window.location.href = "{{url('admin/member/store_file_form')}}/" + response.member_id, 50000)
                }
            },

            error: function (response) {
                enableeButton()
                clear_error_field();
                error_notification('Please fill up the form correctly and try again')
                $('#error_member_type').text(response.responseJSON.errors.member_type);
                $('#error_ba_no').text(response.responseJSON.errors.ba_no);
                $('#error_member_id_inputed').text(response.responseJSON.errors.member_id_inputed);
                $('#error_service_unit_id').text(response.responseJSON.errors.service_unit_id);
                $('#error_fullname').text(response.responseJSON.errors.fullname);
                $('#error_designation_id').text(response.responseJSON.errors.designation_id);
                $('#error_parent_member_id').text(response.responseJSON.errors.parent_member_id);
                $('#error_relationship_id').text(response.responseJSON.errors.relationship_id);
                $('#error_isRetired').text(response.responseJSON.errors.isRetired);
                $('#error_issue_date').text(response.responseJSON.errors.issue_date);
                $('#error_expire_date').text(response.responseJSON.errors.expire_date);
                $('#error_phone').text(response.responseJSON.errors.phone);
                $('#error_emergency_contact_no').text(response.responseJSON.errors.emergency_contact_no);
                $('#error_email').text(response.responseJSON.errors.email);
                $('#error_address').text(response.responseJSON.errors.address);
                $('#error_dob').text(response.responseJSON.errors.dob);
                $('#error_blood_group_id').text(response.responseJSON.errors.blood_group_id);
                $('#error_status').text(response.responseJSON.errors.status);
                $('#error_password').text(response.responseJSON.errors.password);
                $('#error_password_confirmation').text(response.responseJSON.errors.password_confirmation);
            }
        });
    })

    // Search Member
    $('#member_id_search_button').off().on('click', function (event) {
        event.preventDefault();
        disableButton()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('admin/member/relational_member_search')}}",
            type: "POST",
            data: {member_inputed_id: $('#search_member_id').val()},
            success: function (response) {
                if (response) {
                    // error_notification(response.error)
                    enableeButton()
                    $('#member_type option[value="' + response.member.member_type + '"]').prop('selected', true);
                    $('#designation_id option[value="' + response.member.designation_id + '"]').prop('selected', true);
                    $('#service_unit_id option[value="' + response.member.service_unit_id + '"]').prop('selected', true);
                    $('#isRetired option[value="' + response.member.isRetired + '"]').prop('selected', true);
                    // $('#status option[value="' + response.member.status + '"]').prop('selected', true);
                    $('#parent_member_id').val(response.member.id);
                    $('#ba_no').val(response.member.ba_no);
                    $('#ba_no_hidden').val(response.member.ba_no);
                    $('#member_id_inputed').val(response.member.member_id_inputed);
                    $('#member_id_inputed_hidden').val(response.member.member_id_inputed);
                    $('#phone').val(response.member.phone);
                    $('#emergency_contact_no').val(response.member.emergency_contact_no);
                    $('#email').val(response.member.email);
                    $('#address').val(response.member.address);
                    // $('#rfid').val(response.member.rfid);
                    // $('#issue_date').val(response.member.issue_date);
                    // $('#expire_date').val(response.member.expire_date);
                }
            },

            error: function (response) {
                // enableeButton()
                // clear_error_field();
                // error_notification('Please fill up the form correctly and try again')
                // $('#error_member_type').text(response.responseJSON.errors.member_type);
            }
        });
    })


    function clear_error_field() {
        $('#error_member_type').text('');
        $('#error_ba_no').text('');
        $('#error_member_id_inputed').text('');
        $('#error_service_unit_id').text('');
        $('#error_fullname').text('');
        $('#error_designation_id').text('');
        $('#error_parent_member_id').text('');
        $('#error_relationship_id').text('');
        $('#error_isRetired').text('');
        $('#error_issue_date').text('');
        $('#error_expire_date').text('');
        $('#error_phone').text('');
        $('#error_emergency_contact_no').text('');
        $('#error_email').text('');
        $('#error_address').text('');
        $('#error_dob').text('');
        $('#error_blood_group_id').text('');
        $('#error_status').text('');
        $('#error_password').text('');
        $('#error_password_confirmation').text('');
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
