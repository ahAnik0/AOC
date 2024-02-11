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
                    <input type="hidden" id="edit_id" name="edit_id">
                    
                    <div class="form-group hidden_field">
                        <label class="control-label required">Book/Item Name</label>
                        <input class="form-control" type="text" name="book_name" autocomplete="off" id="edit_book_name">
                        <span id="error_add_book_name" class="text-danger error_field"></span>
                    </div>
                    
                    <div class="form-group hidden_field">
                        <label class="control-label required">Book Author</label>
                        <input class="form-control" type="text" name="book_author" autocomplete="off" id="edit_book_author">
                        <span id="error_add_book_author" class="text-danger error_field"></span>
                    </div>
                    
                    <div class="form-group hidden_field">
                        <label class="control-label required">Buy price</label>
                        <input class="form-control" type="text" name="buy_price" autocomplete="off" id="edit_buy_price">
                        <span id="error_add_buy_price" class="text-danger error_field"></span>
                    </div>
                    
                    <div class="form-group hidden_field">
                        <label class="control-label required">selling price</label>
                        <input class="form-control" type="text" name="price" autocomplete="off" id="edit_price">
                        <span id="error_add_price" class="text-danger error_field"></span>
                    </div>
                    
                    <div class="form-group hidden_field">
                        <label class="control-label required">Quantity</label>
                        <input class="form-control" type="text" name="quantity" autocomplete="off" id="edit_quantity">
                        <span id="error_add_quantity" class="text-danger error_field"></span>
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
