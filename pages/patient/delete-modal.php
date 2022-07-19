<div class='modal fade' id='delete-patient-<?php echo $patient_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="patient_id" value="<?php echo $patient_id ?>" hidden>
                <input type="text" class="form-control" name="old_upload_identity" value="<?php echo $upload_identity ?>" hidden>
                <input type="text" class="form-control" name="patient_name" value="<?php echo "$first_name $middle_name $last_name"; ?>" hidden>
                Are you sure you want to delete <b><?php echo "$first_name $middle_name $last_name";?></b>?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn elevation-1 btn-sm btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn elevation-1 btn-sm btn-danger" name="delete-patient" value="Delete">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->