      <div class="modal fade" id="add-service">
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="clinic_id">Clinic</label>
                    <select class="form-control select2" id="clinic_id" name="clinic_id" onchange='fetch_select(this.value);' required>
                        <option>-- SELECT CLINIC --</option>
                        <?php
                        if ($_SESSION['user_type'] == 1){//admin
                            require_once '../database&config/config.php';
                            $cn = new mysqli (HOST, USER, PW, DB);
                            $sql="SELECT clinic_id, clinic_name FROM tbl_clinic";
                            $qry=$cn->prepare($sql);
                            $qry->execute();
                            $qry->bind_result($clinic_id, $clinic_name);
                            $qry->store_result();
                            while($qry->fetch()){
                                echo "<option value='$clinic_id'>$clinic_name</option>";
                            }
                        }
                        if ($_SESSION['user_type'] == 2){//doctor
                            $doctor_id = $_SESSION['user_id'];
                            require_once '../database&config/config.php';
                            $cn = new mysqli (HOST, USER, PW, DB);
                            $sql="SELECT clinic_id, clinic_name FROM tbl_clinic WHERE doctor_id = $doctor_id";
                            $qry=$cn->prepare($sql);
                            $qry->execute();
                            $qry->bind_result($clinic_id, $clinic_name);
                            $qry->store_result();
                            while($qry->fetch()){
                                echo "<option value='$clinic_id'>$clinic_name</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="doctor_id">Doctor</label>
                    <select id='doctor_id' name='doctor_id'  class='form-control form-control-border select2'>
                    </select>
                </div>
                <div class="form-group">
                    <label for="service_name">Service Name</label>
                    <input type="text" id='service_name' name='service_name'  class='form-control form-control-border' placeholder="Service Name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control form-control-border" rows="3" id="description" name="description" placeholder="Description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" id='amount' name='amount'  class='form-control form-control-border' placeholder="Amount" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn elevation-1 btn-sm btn-default " data-dismiss="modal">Close</button>
              <input type="submit" class="btn elevation-1 btn-sm btn-primary " id="add-service_btn" name="add-service" value="Save">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<script>
$(document).ready(function(){
        
    $("#service_name").keyup(function(){
                    
        var service_name = $(this).val().trim();
             
        if(service_name != ''){
            
            $.ajax({
                url: 'check-service_name.php',
                type: 'post',
                data: {service_name: service_name},
                success: function(response){
                
                    $('#response').html(response);
                
                }
            });
        }else{
            $("#response").html("");
        }
                
    });

});
    function fetch_select(val) {
        $.ajax({
            type: 'post',
            url: 'get-doctor_id.php',
            data: {
                get_option:val
            },
            success: function (response) {
                document.getElementById('doctor_id').innerHTML=response; 
            }
        });
         
    }
</script>