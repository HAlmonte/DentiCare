<div class='modal fade' id='edit-upload_permit-<?php echo $clinic_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="upload_permit<?php echo $clinic_id; ?>">Choose New Permit for <?php echo "<b>$clinic_name</b>"; ?></label>
                    <input type="file" class="form-control form-control-border" id="upload_permit<?php echo $clinic_id; ?>" name="upload_permit" accept="image/*" required>
                    <input type="text" name="clinic_id" value="<?php echo $clinic_id; ?>" hidden>
                    <input type="text" name="old_upload_permit" value="<?php echo $upload_permit; ?>" hidden>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-sm elevation-1" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary btn-sm elevation-1" name="edit-upload_permit" value="Save">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<script>
    //File Validation
var uploadField<?php echo $clinic_id; ?> = document.getElementById("upload_permit<?php echo $clinic_id; ?>");

uploadField<?php echo $clinic_id; ?>.onchange = function() {
    if(this.files[0].type != 'image/jpeg' && this.files[0].type != 'image/png'){
        $(function() {
                var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
                });

                $(document).ready(function(){
                Toast.fire({
                icon: 'error',
                title: 'File is not an Image'
                })
                });

                });
       this.value = "";
    };
    if(this.files[0].size > 2097152){
//       alert("File is too big! Please select image less than 2mb.");
        $(function() {
                var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
                });

                $(document).ready(function(){
                Toast.fire({
                icon: 'error',
                title: 'Image too large! Image must not exceed 2mb.'
                })
                });

                });
       this.value = "";
    };
};
</script>