<div class="modal fade" id="due_model" tabindex="-1" role="dialog" aria-labelledby="due_model" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" id="save_due_info">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Please write exact amount</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="due_id" name="due_id">
                    <div class="form-group hidden_field">
                        <label class="control-label">Payable Amount</label>
                        <input class="form-control" type="text" min="1" id="due_amount"  name="due_amount">
                        <span id="error_cancel_reason" class="text-danger error_field"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" id="form_submission_button">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
