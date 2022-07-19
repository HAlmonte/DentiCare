      <div class="modal fade" id="add-clinic">
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-body">     
                <div class="form-group">
                    <label for="clinic_name">Clinic Name</label>
                    <input type="text" class="form-control form-control-border" id="clinic_name" name="clinic_name" placeholder="Clinic Name" required>
                    <div id="response"></div>
                </div>
                <div class="form-group">
                    <label for="doctor_id">Doctor</label>
                    <select class='custom-select form-control-border select2' name="doctor_id">
                        <?php
                        require_once '../database&config/config.php';
                        $cn = new mysqli (HOST, USER, PW, DB);
                        $sql="SELECT doctor_id, first_name, last_name, middle_name FROM tbl_doctor";
                        $qry=$cn->prepare($sql);
                        $qry->execute();
                        $qry->bind_result($doctor_id, $first_name, $last_name, $middle_name);
                        $qry->store_result();
                        while ($qry->fetch()){
                            echo "
                            <option value='$doctor_id'>$first_name $last_name $middle_name</option>
                            ";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="upload_permit">Upload Permit</label>
                    <input type="file" class="form-control form-control-border" id="upload_permit" name="upload_permit" placeholder="Profile Picture" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control form-control-border" rows="3" id="address" name="address" placeholder="Address" required></textarea>
                </div><div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="text" class="form-control form-control-border" id="longitude" name="longitude" placeholder="Longitude" required>
                </div>
                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="text" class="form-control form-control-border" id="latitude" name="latitude" placeholder="Latitude" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class='custom-select form-control-border' name="status">
                        <option value='1'>Verified</option>
                        <option value='0'>Rejected</option>
                        <option value='3'>Pending</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-sm elevation-1" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary btn-sm elevation-1" name="add-clinic" id="add-clinic_btn" value="Save">
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
var uploadField2 = document.getElementById("upload_permit");

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
<script>
    $(document).ready(function(){
        
        $("#clinic_name").keyup(function(){
                    
            var clinic_name = $(this).val().trim();
            
            if(clinic_name != ''){
            
                $.ajax({
                    url: 'check-clinic_name.php',
                    type: 'post',
                    data: {clinic_name: clinic_name},
                    success: function(response){
                
                        $('#response').html(response);
                
                    }
                });
            }else{
                $("#response").html("");
            }
                
                });

            });
    
    $(document).ready(function(){
        
        $("#email").keyup(function(){
                    
            var email = $(this).val().trim();
            if(email != ''){
            
                $.ajax({
                    url: 'check-email.php',
                    type: 'post',
                    data: {email: email},
                    success: function(response_email){
                
                        $('#response_email').html(response_email);
                
                    }
                });
            }else{
                $("#response_email").html("");
            }
                
                });

            });
    
    function checkNumber() {
        var contact = document.getElementById("contact").value;
        var prev_contact = contact;
        if (contact > 09999999999) {
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Invalid Phone Number</span>";
            document.getElementById("add-clinic_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else if (contact < 09000000000) {
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Invalid Phone Number</span>";
            document.getElementById("add-clinic_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else if (isNaN(contact)){
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Invalid Phone Number</span>";
            document.getElementById("add-clinic_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else {
            document.getElementById("response_contact").innerHTML = "<span style='color: green;'>Valid Phone Number</span>";
            document.getElementById("add-clinic_btn").disabled = false;
            document.getElementById('contact').className = 'form-control form-control-border is-valid';
        }
    }
</script>