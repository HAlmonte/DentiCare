      <div class="modal fade" id="add-donation">
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="donated_by">Donated by</label>
                    <input type="text" class="form-control form-control-border" id="donated_by" name="donated_by" placeholder="Donated by" required>
                </div>
                <div class="form-group">
                    <label for="date_of_donation">Date of Donation</label>
                    <input type="date" class="form-control form-control-border" id="date_of_donation" name="date_of_donation" required>
                </div>
                <div class="form-group">
                    <label for="donation_type">Donation Type</label>
                    <select class="form-control form-control-border" id="donation_type" name="donation_type" required>
                        <option value="Cash">Cash</option>
                        <option value="Kind">Kind</option>
                    </select>
                </div>
               <div class="form-group">
                    <label for="cash_donation">Cash Donation (if not in kind)</label>
                    <input type="text" class="form-control form-control-border" id="cash_donation" name="cash_donation" placeholder="Cash Donation">
                </div>
                <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <textarea type="text" class="form-control form-control-border" id="remarks" name="remarks" placeholder="Remarks" required></textarea>
                </div>
                <div class="form-group">
                    <label for="proof_of_donation">Proof of Donation</label>
                    <input type="file" class="form-control form-control-border" id="proof_of_donation" name="proof_of_donation" accept="image/*" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary btn-flat" id="add-donation_btn" name="add-donation" value="Save">
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
var uploadField2 = document.getElementById("proof_of_donation");

uploadField2.onchange = function() {
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