<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 footer-copyright">
                <p class="mb-0">{{ __('Copyright © ' . date('Y') . ' | All Rights Reserved by AOC') }}</p>
            </div>
            <div class="col-md-6">
                <p>Developed by <a href="https://www.tilbd.net/" target="_blank">Trust Innovation Limited</a></p>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="{{ asset('assets/backend/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/icons/feather-icon/feather-icon.js') }}"></script>
<script src="{{ asset('assets/backend/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('assets/backend/js/config.js') }}"></script>
<script src="{{ asset('assets/backend/js/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/script.js') }}"></script>
<script src="{{asset('assets/backend/js/toastr.min.js')}}"></script>
@stack('js')
{!! Toastr::message() !!}
<script  nonce="{{ csp_nonce() }}">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error('{{ $error }}', 'Error', {
        closeButton: true,
        progressBar: true,
    });
    @endforeach
    @endif

    $('#logout_button').on('submit', function (event) {
        event.preventDefault();
       document.getElementById('logout-form').submit();
    });


</script>
</body>
</html>
