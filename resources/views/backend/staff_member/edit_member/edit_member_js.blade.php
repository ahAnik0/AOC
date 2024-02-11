<script  nonce="{{ csp_nonce() }}">
    $(document).ready(function () {
        var value = $("#privilage_data").val();
        $('.select2').select2();
        $("#privilege").select2().val(value.split(","));
    });
</script>
