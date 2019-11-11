<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
  <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="deleteContent"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" id="deleteUser">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>