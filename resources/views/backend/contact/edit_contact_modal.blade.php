<div class="modal fade" id="edit_user" tabindex="-1" role="dialog" aria-labelledby="edit_userTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_userTitle">Edit Contact</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                   
            </div>
            <div class="modal-body">

                    <form action="{{route('admin.update_contact')}}" method="post">
                        @csrf
                            <div id="edit_body">

                            </div>

                        <div class="modal-footer">
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
