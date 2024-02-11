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
                        <label class="control-label required">Book/Item Name</label>
                        <input class="form-control" type="text" name="book_name" autocomplete="off">
                        <span id="error_add_book_name" class="text-danger error_field"></span>
                    </div>
                    <div class="form-group hidden_field">
                        <label class="control-label required">Book Author</label>
                        <input class="form-control" type="text" name="book_author" autocomplete="off">
                        <span id="error_add_book_author" class="text-danger error_field"></span>
                    </div>
                    <div class="form-group hidden_field">
                        <label class="control-label required">Buy price</label>
                        <input class="form-control" type="number" name="buy_price" autocomplete="off">
                        <span id="error_add_buy_price" class="text-danger error_field"></span>
                    </div>
                    <div class="form-group hidden_field">
                        <label class="control-label required">Selling price</label>
                        <input class="form-control" type="number" name="price" autocomplete="off">
                        <span id="error_add_price" class="text-danger error_field"></span>
                    </div>
                    <div class="form-group hidden_field">
                        <label class="control-label required">Quantity</label>
                        <input class="form-control" type="text" name="quantity" autocomplete="off">
                        <span id="error_add_quantity" class="text-danger error_field"></span>
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
