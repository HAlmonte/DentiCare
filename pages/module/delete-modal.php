<div class='modal fade' id='delete-module-<?php echo $module_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="module_id" value="<?php echo $module_id ?>" hidden>
                <input type="text" class="form-control" name="module_name" value="<?php echo $module_name ?>" hidden>
                Are you sure you want to delete <b><?php echo $module_name;?></b>?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn elevation-1 btn-sm btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn elevation-1 btn-sm btn-danger" name="delete-module" value="Delete">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->