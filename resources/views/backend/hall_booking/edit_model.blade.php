
<div class="modal fade" id="edit_model" tabindex="-1" role="dialog" aria-labelledby="edit_model" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" id="update_form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit @yield('title')</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                
{{--                    <div class="form-group hidden_field">--}}
{{--                        <label class="control-label required">Member name</label>--}}
{{--                        <input class="form-control" type="text" name="edit_member_id" autocomplete="off" readonly>--}}
{{--                        <span id="error_add_member_id" class="text-danger error_field"></span>--}}
{{--                    </div>--}}
                    
                    <input type="hidden" id="edit_id" name="edit_id">
                    
                    <div class="col-md-12"  id="member_details">
                        <ul class="list-group" id="stl_5">
                            <li class="list-group-item">Member Id: <span id="member_id_inputed"></span></li>
                            <li class="list-group-item">Ba No: <span id="member_ba_no"></span></li>
                            <li class="list-group-item">Member Name: <span id="member_name_show"></span></li>
                            <li class="list-group-item">Phone: <span id="member_phone"></span></li>
                            <li class="list-group-item">Retired: <span id="retire"></span></li>
                            <li class="list-group-item bg-warning">Status: <span id="member_status"></span></li>
                        </ul>
                    </div>
                    
                    <div class="form-group hidden_field">
                        <label class="control-label required">Event Title</label>
                        <input class="form-control" type="text" name="title" id="edit_title" autocomplete="off">
                        <span id="error_add_title" class="text-danger error_field"></span>
                    </div>
                    <div class="form-group hidden_field">
                        <label class="control-label required">Start Date</label>
                        <input class="form-control" type="date" name="start" id="edit_start" autocomplete="off">
                        <span id="error_add_start" class="text-danger error_field"></span>
                    </div>
                    
                    <div class="form-group hidden_field">
                        <label class="control-label required">End Date</label>
                        <input class="form-control" type="date" name="end" id="edit_end" autocomplete="off">
                        <span id="error_add_end" class="text-danger error_field"></span>
                    </div>
                    
                    <div class="form-group hidden_field">
                        <label class="control-label required">Time</label>
                        <input class="form-control" type="time" name="time" id="edit_time" autocomplete="off">
                        <span id="error_add_time" class="text-danger error_field"></span>
                    </div>
                    
                    <div class="form-group hidden_field">
                        <label class="control-label">Event Details</label>
                        
                        <textarea class="form-control" name="details" id="edit_details"></textarea>
                        <span id="error_add_details" class="text-danger error_field"></span>
                    </div>
                    
                    <div class="form-group hidden_field">
                        <label class="control-label required">Program</label>
                        <input class="form-control" type="text" name="edit_prog" autocomplete="off">
                        <span id="error_add_prog" class="text-danger error_field"></span>
                    </div>
                    
                    <div class="form-group">
                        <label class="required">Status</label>
                        <select name="status" id="edit_status" class="form-control">
                            <option value="" selected disabled>Please Select</option>
                            <option value="1">Booked</option>
                            <option value="2">Due</option>
                            <option value="3">Paid</option>
                        </select>
                        <span id="error_add_status" class="text-danger error_field"></span>
                    </div>
                    
                    <div class="form-group hidden_field">
                        <label class="control-label">Amount</label>
                        <input class="form-control" type="number" name="amount" id="edit_amount" autocomplete="off">
                        <span id="error_add_amount" class="text-danger error_field"></span>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" id="form_submission_button">Update changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
