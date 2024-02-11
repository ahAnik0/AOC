<div class="modal fade" id="add_model" tabindex="-1" role="dialog" aria-labelledby="add_model" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" id="save_info">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create @yield('title')</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group hidden_field">
                        <label class="control-label required">Device name</label>
                        <input class="form-control" type="text" name="device_name" autocomplete="off">
                        <span id="error_device_name" class="text-danger error_field"></span>
                    </div>
                    
                    <div class="form-group hidden_field">
                        <label class="control-label required">Device Number</label>
                        <input class="form-control" type="text" name="device_number" autocomplete="off">
                        <span id="error_device_number" class="text-danger error_field"></span>
                    </div>
                    
                    <div class="form-group hidden_field">
                        <label class="control-label required">Device IP</label>
                        <input class="form-control" type="text" name="device_ip" autocomplete="off">
                        <span id="error_device_ip" class="text-danger error_field"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" id="form_submission_button">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
