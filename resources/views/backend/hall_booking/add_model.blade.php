<div class="modal fade" id="add_model" tabindex="-1" role="dialog" aria-labelledby="add_model" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" id="stl_2">
        <div class="modal-content">
            <form action="" id="save_info">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Client</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="row align-items-center" id="member_search">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="col-form-label required">Select member</label>
                                <input type="text" name="member_name" id="member_name" class="form-control input-lg"
                                       placeholder="Member name / Member ID / Ba no / Civil no / phone" autofocus autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="member_id" name="member_id">
                    <div id="member_list"></div>
                    
                    <div class="col-md-12" id="member_details">
                        <ul class="list-group" id="stl_3">
                            <li class="list-group-item">Ba No: <span id="member_ba_no"></span></li>
                            <li class="list-group-item">Member Id: <span id="member_id_inputed"></span></li>
                            <li class="list-group-item">Member Name: <span id="member_name_show"></span></li>
                            <li class="list-group-item">Phone: <span id="member_phone"></span></li>
                            <li class="list-group-item">Retire status: <span id="retire"></span></li>
                            <li class="list-group-item">Rank: <span id="rank"></span></li>
                            <li class="list-group-item">Serving Unit: <span id="serving_unit"></span></li>
                            <li class="list-group-item bg-warning">Status: <span id="member_status"></span></li>
                        </ul>
                    </div>
                    
                    <div class="form-group hidden_field">
                        <label class="control-label required">Program</label>
                        <input class="form-control" type="text" name="title" autocomplete="off">
                        <span id="error_add_title" class="text-danger error_field"></span>
                    </div>
                    <div class="form-group hidden_field">
                        <label class="control-label required">Program Date</label>
                        <input class="form-control" type="date" name="start" autocomplete="off">
                        <span id="error_add_start" class="text-danger error_field"></span>
                    </div>
                    
{{--                    <div class="form-group hidden_field">--}}
{{--                        <label class="control-label required">End Date</label>--}}
{{--                        <input class="form-control" type="date" name="end" autocomplete="off">--}}
{{--                        <span id="error_add_end" class="text-danger error_field"></span>--}}
{{--                    </div>--}}
                    
{{--                    <div class="form-group hidden_field">--}}
{{--                        <label class="control-label required">Time</label>--}}
{{--                        <input class="form-control" type="time" name="time" autocomplete="off">--}}
{{--                        <span id="error_add_time" class="text-danger error_field"></span>--}}
{{--                    </div>--}}
                    
                    <div class="form-group hidden_field">
                        <label class="control-label">Program Details</label>
                        
                        <textarea class="form-control" name="details"></textarea>
                        <span id="error_add_details" class="text-danger error_field"></span>
                    </div>
                    
{{--                    <div class="form-group hidden_field">--}}
{{--                        <label class="control-label required">Program</label>--}}
{{--                        <input class="form-control" type="text" name="prog" autocomplete="off">--}}
{{--                        <span id="error_add_prog" class="text-danger error_field"></span>--}}
{{--                    </div>--}}
                    
                    <div class="form-group">
                        <label class="required">Status</label>
                        <select name="status" class="form-control select2" id="status">
                            <option value="" selected disabled>Please Select</option>
                            <option value="1">Booked</option>
                            <option value="2">Due</option>
                            <option value="3">Paid</option>
                        </select>
                        <span id="error_add_status" class="text-danger error_field"></span>
                    </div>
                    
                    <div class="form-group hidden_field">
                        <label class="control-label">Amount</label>
                        <input class="form-control" type="number" name="amount" autocomplete="off">
                        <span id="error_add_amount" class="text-danger error_field"></span>
                    </div>
                    
                    <div class="form-group hidden_field">
                        <label class="control-label">Mobile No</label>
                        <input class="form-control" type="number" name="mobile" autocomplete="off">
                        <span id="error_add_amount" class="text-danger error_field"></span>
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
