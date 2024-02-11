<script  nonce="{{ csp_nonce() }}">
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
    
    
    {{--$('#book_name').keyup(function () {--}}
    {{--    var query = $(this).val();--}}
    {{--    if (query != '') {--}}
    {{--        var _token = $('input[name="_token"]').val();--}}
    {{--        $.ajax({--}}
    {{--            url: "{{ route('admin.library/search_book') }}",--}}
    {{--            method: "POST",--}}
    {{--            data: {--}}
    {{--                query: query,--}}
    {{--                _token: _token--}}
    {{--            },--}}
    {{--            success: function (data) {--}}
    {{--                // console.warn(data)--}}
    {{--                $('#booklist').fadeIn();--}}
    {{--                $('#booklist').html(data);--}}
    {{--            }--}}
    {{--        });--}}
    {{--    } else if (query == '') {--}}
    {{--        $('#book_list').html('');--}}
    {{--    }--}}
    {{--});--}}
    
    {{--$(document).off().on('click', '.book_list', function () {--}}
    {{--    event.preventDefault();--}}
    {{--    $('#member_name').val('');--}}
    {{--    $('#booklist').fadeOut();--}}
    {{--    // document.getElementById("member_name").focus();--}}
    {{--});--}}


    function getcustomerdata(customer_id) {
        console.warn(customer_id)
        $.ajax({
            type: 'get',
            url: '{{ url('admin/service/get_customer_data_for_service') }}/' + customer_id,
            success: function (data) {
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

    $(document).on("keydown", "form", function (event) {
        return event.key != "Enter";
    });
</script>
