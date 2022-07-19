<div class='modal fade' id='edit-background_image'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="background_image">Choose Image</label>
                    <input type="file" class="form-control form-control-border" id="background_image" name="background_image" accept="image/*" required>
                    <input type="text" name="about_id" value="<?php echo $about_id;?>" hidden>
                    <input type="text" name="old_background_image" value="<?php echo $background_image; ?>" hidden>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary btn-flat" name="edit-background_image" value="Save">
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
var uploadField = document.getElementById("background_image");

uploadField.onchange = function() {
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