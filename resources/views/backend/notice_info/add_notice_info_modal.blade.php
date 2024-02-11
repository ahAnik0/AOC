<div class="modal fade" id="add_button" tabindex="-1" role="dialog" aria-labelledby="add_buttonLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('admin.save_notice_info')}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="Route_name">Title</label>
                        <input type="text" class="form-control" id="Route name" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Type</label>
                        <select class="form-control" id="status" name="type" required>
                            <option value="" disabled selected>Select One</option>
                                <option value="0">Notice</option>
                                <option value="1">Information</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label required">Notice/Info Date</label>
                        <input class="form-control" type="date" name="date" id="program_date">
                    </div>
                    <div class="form-group">
                        <label for="Route_name">PDF Upload</label>
                        <input type="file" class="form-control" id="Route name" name="pdf" required>
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
