      <div class="modal fade" id="add-doctor">
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-body">                
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control form-control-border" id="first_name" name="first_name" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" class="form-control form-control-border" id="middle_name" name="middle_name" placeholder="Middle Name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control form-control-border" id="last_name" name="last_name" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                    <label for="specialization">Specialization</label>
                    <input type="text" class="form-control form-control-border" id="specialization" name="specialization" placeholder="Specialization" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control form-control-border" rows="3" id="address" name="address" placeholder="Address" required></textarea>
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="text" class="form-control form-control-border" id="contact" name="contact" placeholder="Contact Number" oninput="checkNumber()" maxlength="11" required>
                    <div id="response_contact"></div>
                </div>
                <div class="form-group">
                    <label for="upload_identity">Upload Identity</label>
                    <input type="file" class="form-control form-control-border" id="upload_identity" name="upload_identity" placeholder="Profile Picture" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control form-control-border" id="username" name="username" placeholder="Username" required>
                    <div id="response"></div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control form-control-border" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class='custom-select form-control-border' name="status">
                        <option value='1'>Active</option>
                        <option value='0'>Inactive</option>
                        <option value='3'>Pending</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-sm elevation-1" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary btn-sm elevation-1" name="add-doctor" id="add-doctor_btn" value="Save">
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
var uploadField2 = document.getElementById("upload_identity");

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
        
        $("#username").keyup(function(){
                    
            var username = $(this).val().trim();
            
            if(username != ''){
            
                $.ajax({
                    url: 'check-username.php',
                    type: 'post',
                    data: {username: username},
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
            document.getElementById("add-doctor_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else if (contact < 09000000000) {
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Invalid Phone Number</span>";
            document.getElementById("add-doctor_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else if (isNaN(contact)){
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Invalid Phone Number</span>";
            document.getElementById("add-doctor_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else {
            document.getElementById("response_contact").innerHTML = "<span style='color: green;'>Valid Phone Number</span>";
            document.getElementById("add-doctor_btn").disabled = false;
            document.getElementById('contact').className = 'form-control form-control-border is-valid';
        }
    }
</script>