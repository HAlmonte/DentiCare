<div class='modal fade' id='delete-donation-<?php echo $donation_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="donation_id" value="<?php echo $donation_id ?>" hidden>
                <input type="text" name="old_proof_of_donation" value="<?php echo $proof_of_donation; ?>" hidden>
                <?php echo "Are you sure you want to delete?" ?>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-danger btn-flat" name="delete-donation" value="Delete">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->