<?php // This is a button that when clicked, pops up a window with a form for a user to create a new post

echo '<div class="modal fade" id="create-post-modalCenter" tabindex="-1" role="dialog" aria-labelledby="create-post-modalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="create-post-modalContent">
                <div class="create-post-modalHeader">
                    <h5 class="create-post-modalTitle" id="create-post-modalCenterTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                </div>
                <div class="modal-body">
                ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>';