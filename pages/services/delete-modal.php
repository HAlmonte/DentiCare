<div class='modal fade' id='delete-service-<?php echo $service_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="service_id" value="<?php echo $service_id ?>" hidden>
                <input type="text" class="form-control" name="service_name" value="<?php echo $service_name ?>" hidden>
                Are you sure you want to delete <b><?php echo $service_name;?></b>?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn elevation-1 btn-sm btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn elevation-1 btn-sm btn-danger" name="delete-service" value="Delete">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->