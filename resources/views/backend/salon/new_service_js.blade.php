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
        $.ajax({
            type: 'get',
            url: '{{ url('admin/service/get_customer_data_for_service') }}/' + customer_id,
            success: function (data) {
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

    $(document).on("keydown", "form", function (event) {
        return event.key != "Enter";
    });

    $(document).on("change", "#exampleFormControlSelect9", function () {
      // alert(hairProp);

      var prevChecked = $(this).attr("data-prop");

      var memberType = $(this).val();
      if (memberType == 'officer_guest') {
        $("#cbx1").val("120.00");
        $("#hairCutLabel").html("Hair Cut - 120TK");

        if ($("#cbx1").prop('checked')) {
          if (prevChecked == 'officer_guest') {
            var prevBill = $("#grandtotal").val();
            var prevBillValue = prevBill ? parseFloat(prevBill) : 0;
            $("#grandtotal").val(prevBillValue);
          } else if (prevChecked == '') {
            var prevBill = $("#grandtotal").val();
            var prevBillValue = prevBill ? parseFloat(prevBill) : 0;
            $("#grandtotal").val(prevBillValue + 20);
          } else {
            var prevBill = $("#grandtotal").val();
            var prevBillValue = prevBill ? parseFloat(prevBill) : 0;
            $("#grandtotal").val(prevBillValue + 20);
          }
        }

      } else {
        $("#cbx1").val("100.00");
        $("#hairCutLabel").html("Hair Cut - 100TK");

        if ($("#cbx1").prop('checked')) {
          if (prevChecked == 'officer_guest') {
            var prevBill = $("#grandtotal").val();
            var prevBillValue = prevBill ? parseFloat(prevBill) : 0;
            $("#grandtotal").val(prevBillValue - 20);
          } else if (prevChecked == '') {
            var prevBill = $("#grandtotal").val();
            var prevBillValue = prevBill ? parseFloat(prevBill) : 0;
            $("#grandtotal").val(prevBillValue);
          } else {
            var prevBill = $("#grandtotal").val();
            var prevBillValue = prevBill ? parseFloat(prevBill) : 0;
            $("#grandtotal").val(prevBillValue);
          }
        }
      }



      $(this).attr('data-prop', memberType);
    });

    //saloon & grooming selection part
    $(document).on("change", ":checkbox", function () {
      if ($(this).prop('checked')) {
        var currentBill = $(this).val();
        var currentBillValue = currentBill ? parseFloat(currentBill) : 0;

        var prevBill = $("#grandtotal").val();
        var prevBillValue = prevBill ? parseFloat(prevBill) : 0;

        var totalBill = currentBillValue + prevBillValue;
        $("#grandtotal").val(totalBill);
      } else {
        var currentBill = $(this).val();
        var currentBillValue = currentBill ? parseFloat(currentBill) : 0;

        var prevBill = $("#grandtotal").val();
        var prevBillValue = prevBill ? parseFloat(prevBill) : 0;

        var totalBill = prevBillValue - currentBillValue;
        $("#grandtotal").val(totalBill);
      }
      // alert(totalBill);
    });

    // Package Selection part
    $(document).on("click", ":radio", function () {
      var prevChecked = $(this).attr("data-prop");
      var value = $(this).val();

      if (prevChecked == '') {
        var currentBill = $(this).attr("data-id");
        var currentBillValue = currentBill ? parseFloat(currentBill) : 0;

        var prevBill = $("#grandtotal").val();
        var prevBillValue = prevBill ? parseFloat(prevBill) : 0;

        var totalBill = currentBillValue + prevBillValue;
        $("#grandtotal").val(totalBill);
      } else if (prevChecked == 'package_1') {
        var currentBill = $(this).attr("data-id");
        var currentBillValue = currentBill ? parseFloat(currentBill) : 0;

        var prevBill = $("#grandtotal").val();
        var prevBillValue = prevBill ? parseFloat(prevBill) : 0;

        var totalBill = currentBillValue + prevBillValue - 730;
        $("#grandtotal").val(totalBill);
      } else if (prevChecked == 'package_2') {
        var currentBill = $(this).attr("data-id");
        var currentBillValue = currentBill ? parseFloat(currentBill) : 0;

        var prevBill = $("#grandtotal").val();
        var prevBillValue = prevBill ? parseFloat(prevBill) : 0;

        var totalBill = currentBillValue + prevBillValue - 1250;
        $("#grandtotal").val(totalBill);
      }

      $(":radio").attr('data-prop', value);
      // alert('totalBill');
    });
</script>
