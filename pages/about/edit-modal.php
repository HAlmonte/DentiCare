      <div class="modal fade" id="edit-donation-<?php echo $donation_id; ?>">
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="donated_by">Donated by</label>
                    <input type="text" class="form-control form-control-border" id="donated_by" name="donated_by" value="<?php echo $donated_by;?>" required>
                    <input type="text" name="donation_id" value="<?php echo $donation_id;?>" hidden>
                </div>
                <div class="form-group">
                    <label for="date_of_donation">Date of Donation</label>
                    <input type="date" class="form-control form-control-border" id="date_of_donation" name="date_of_donation" value="<?php echo $date_of_donation;?>" required>
                </div>
                <div class="form-group">
                    <label for="donation_type">Donation Type</label>
                    <select class="form-control form-control-border" id="donation_type" name="donation_type" required>
                        <?php
                        if ($donation_type == "Cash"){
                            echo "
                        <option value='Cash'>Cash</option>
                        <option value='Kind'>Kind</option>";
                        }
                        if ($donation_type == "Kind"){
                            echo "
                        <option value='Kind'>Kind</option>
                        <option value='Cash'>Cash</option>";
                        }
                        ?>
                    </select>
                </div>
               <div class="form-group">
                    <label for="cash_donation">Cash Donation (if not in kind)</label>
                    <input type="text" class="form-control form-control-border" id="cash_donation" name="cash_donation" value="<?php echo $cash_donation;?>">
                </div>
                <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <textarea type="text" class="form-control form-control-border" id="remarks" name="remarks" placeholder="Remarks" required><?php echo $remarks;?></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary btn-flat" name="edit-donation" value="Save">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->