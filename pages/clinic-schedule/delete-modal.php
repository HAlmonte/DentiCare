<div class='modal fade' id='delete-clinic_schedule-<?php echo $schedule_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="schedule_id" value="<?php echo $schedule_id ?>" hidden>
                Are you sure you want to delete?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn elevation-1 btn-sm btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn elevation-1 btn-sm btn-danger" name="delete-clinic_schedule" value="Delete">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->