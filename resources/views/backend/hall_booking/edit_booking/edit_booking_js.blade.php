<script  nonce="{{ csp_nonce() }}">
    $(document).ready(function () {
        var value = $("#hall_data").val();
        $('.select2').select2();
        $("#hall").select2().val(value.split(","));
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

    $("#program_date,#hall").change(function () {
        var query = $("#program_date").val();
        var hall = $("#hall").val();
        console.warn(query)
        if (hall != '') {
            if (query != '') {
                $.ajax({
                    url: "{{ route('edit_check_date') }}",
                    method: "GET",
                    data: {
                        date: query,
                        hall: hall,
                    },
                    success: function (data) {
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
                $('#error_date').html("please select date");
            }
        } else {
            $('#error_date').html("please select hall first then select date");
        }
    })

    $(document).on("keydown", "form", function (event) {
        return event.key != "Enter";
    });

</script>
