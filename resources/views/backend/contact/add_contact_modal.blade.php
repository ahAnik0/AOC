<div class="modal fade" id="add_button" tabindex="-1" role="dialog" aria-labelledby="add_buttonLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('admin.save_contact')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="Route_name">Name</label>
                        <input type="text" class="form-control" id="Route name" name="name">
                    </div>


                    <div class="form-group">
                        <label for="Route_name">Mobile</label>
                        <input type="number" class="form-control" name="mobile">
                    </div>

                </div>
                <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-secondary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
