<script  nonce="{{ csp_nonce() }}">
    $(document).ready(function () {
        $('.select2').select2();
    });


    $('#photograph_form').ajaxForm({
        beforeSend: function () {
            $('#photograph_form').find("#success").empty()
        },
        uploadProgress: function (event, position, total, percentComplete) {
            $('#photograph_form').find(".progress-bar").text(percentComplete + '%');
            $('#photograph_form').find(".progress-bar").css('width', percentComplete + '%');
        },
        success: function (data) {
            if (data.errors) {
                $('#photograph_form').find(".progress-bar").text('0%');
                $('#photograph_form').find(".progress-bar").css('width', '0%');
                $('#photograph_form').find("#success").html('<span class="text-danger"><b>' + data.errors + '</b></span>');
            }
            if (data.success) {
                $('#photograph_form').find(".progress-bar").text('Uploaded');
                $('#photograph_form').find(".progress-bar").css('width', '100%');
                $('#photograph_form').find("#success").html('<span class="text-success"><b>' + data.success + '</b></span><br /><br />');
                $('#photograph_form').find("#success").append(data.image);
                $('#photograph_file_name').text(data.file_name);
            }
        }
    });


    $('#sig_form').ajaxForm({
        beforeSend: function () {
            $('#sig_form').find("#success").empty();
        },
        uploadProgress: function (event, position, total, percentComplete) {
            $('#sig_form').find(".progress-bar").text(percentComplete + '%');
            $('#sig_form').find(".progress-bar").css('width', percentComplete + '%');
        },
        success: function (data) {
            if (data.errors) {
                $('#sig_form').find(".progress-bar").text('0%');
                $('#sig_form').find(".progress-bar").css('width', '0%');
                $('#sig_form').find("#success").html('<span class="text-danger"><b>' + data.errors + '</b></span>');
            }
            if (data.success) {
                $('#sig_form').find(".progress-bar").text('Uploaded');
                $('#sig_form').find(".progress-bar").css('width', '100%');
                $('#sig_form').find("#success").html('<span class="text-success"><b>' + data.success + '</b></span><br /><br />');
                $('#sig_form').find("#success").append(data.image);
                $('#sign_file_name').text(data.file_name);
            }
        }
    });

    $('#qr_code_form').ajaxForm({
        beforeSend: function () {
            $('#qr_code_form').find("#success").empty();
        },
        uploadProgress: function (event, position, total, percentComplete) {
            $('#qr_code_form').find(".progress-bar").text(percentComplete + '%');
            $('#qr_code_form').find(".progress-bar").css('width', percentComplete + '%');
        },
        success: function (data) {
            if (data.errors) {
                $('#qr_code_form').find(".progress-bar").text('0%');
                $('#qr_code_form').find(".progress-bar").css('width', '0%');
                $('#qr_code_form').find("#success").html('<span class="text-danger"><b>' + data.errors + '</b></span>');
            }
            if (data.success) {
                $('#qr_code_form').find(".progress-bar").text('Uploaded');
                $('#qr_code_form').find(".progress-bar").css('width', '100%');
                $('#qr_code_form').find("#success").html('<span class="text-success"><b>' + data.success + '</b></span><br /><br />');
                $('#qr_code_form').find("#success").append(data.image);
                $('#qr_code_file_name').text(data.file_name);
            }
        }
    });

    function submit_other_document() {
        event.preventDefault();
        $.ajax({
            url: "{{url('admin/member/store_file')}}/"+{{$member_id}},
            type: "POST",
            data: {
                photograph_file_name: $('#photograph_file_name').text(),
                sign_file_name: $('#sign_file_name').text(),
                qr_code_file_name: $('#qr_code_file_name').text(),
                _token: '{{csrf_token()}}'
            },
            success: function (response) {
                disableButton()
                toastr.success('File Saved', 'Saved');
                window.location.href = "{{route('admin.member/all_member')}}";

            },
            error: function (response) {
                console.warn(this.url)
                clear_error_field();
                error_notification('Please fill up the form correctly and try again');
                $('#error_photograph_file_name').text(response.responseJSON.errors.photograph_file_name);
                $('#error_sign_file_name').text(response.responseJSON.errors.sign_file_name);
                $('#error_qr_code_file_name').text(response.responseJSON.errors.qr_code_file_name);
                console.log('Error:', data);
            }
        });
    }

    function clear_error_field() {
        $('#error_photograph_file_name').text('');
        $('#error_sign_file_name').text('');
        $('#error_qr_code_file_name').text('');
    }

    function disableButton() {
        var btn = document.getElementById('form_submission_button');
        btn.disabled = true;
        btn.innerText = 'Saving....';
    }

    function enableeButton() {
        var btn = document.getElementById('form_submission_button');
        btn.disabled = true;
        btn.innerText = 'Saved'
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
