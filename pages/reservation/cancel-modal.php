<div class='modal fade' id='cancel-reservation-<?php echo $appointment_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="appointment_id" value="<?php echo $appointment_id ?>" hidden>
                <input type="text" class="form-control" name="appointment_no" value="<?php echo $appointment_no ?>" hidden>
                Are you sure you want to cancel?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn elevation-1 btn-sm btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn elevation-1 btn-sm btn-danger" name="cancel-reservation" value="Confirm">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->