
<form action="{{ route('winners') }}" method="get">
    @csrf
    <div class="modal fade" id="selectWinnerModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titleModal"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="selectWinnerForm" name="selectWinnerForm" class="col-form-label">
                        <div class="form-group">
                            <label for="numberOfWinners" class="control-label">Enter the numbers to select winners</label>
                            <input type="number" class="form-control" id="numberOfWinners" name="numberOfWinners" placeholder="Enter Number" min="1" value="" required="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="numberToSelect" value="create">Select Winner</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>