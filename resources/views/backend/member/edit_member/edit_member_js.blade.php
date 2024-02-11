<script  nonce="{{ csp_nonce() }}">
    $(document).ready(function () {
        var value = $("#privilage_data").val();
        $('.select2').select2();
        $("#privilege").select2().val(value.split(","));
    });

    $("#member_type").change(function () {
        if ($(this).val() == 2) {
            $("#ba_no_label").text('Ts No');
        } else if ($(this).val() == 3) {
            $("#ba_no_label").text('Civil No');
        } else {
            $("#ba_no_label").text('BA No');
        }
    });

    // save information
    $('#save_info').off().on('submit', function (event) {
        event.preventDefault();
        disableButton()
        $.ajax({
            url: "{{url('admin/member/update_member_info')}}/" +{{$member->id}},
            type: "POST",
            data: $(this).serializeArray(),
            success: function (response) {
                if (response.error) {
                    error_notification(response.error)
                    enableeButton()
                }
                if (response.success) {
                    disableButton()
                    toastr.success('Information Updated', 'Updated');
                    setTimeout(window.location.href = "{{url('admin/member/edit_member_file')}}/" +{{$member->id}}, 50000)
                }
            },

            error: function (response) {
                enableeButton()
                clear_error_field();
                error_notification('Please fill up the form correctly and try again')
                $('#error_member_type').text(response.responseJSON.errors.member_type);
                $('#error_ba_no').text(response.responseJSON.errors.ba_no);
                $('#error_privilege').text(response.responseJSON.errors.privilege);
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
                $('#error_rfid').text(response.responseJSON.errors.rfid);
                $('#error_connection_to').text(response.responseJSON.errors.connection_to);
            }
        });
    })


    function clear_error_field() {
        $('#error_member_type').text('');
        $('#error_ba_no').text('');
        $('#error_privilege').text('');
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
        $('#error_connection_to').text('');
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
