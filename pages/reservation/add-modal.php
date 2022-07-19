      <div class="modal fade" id="add-reservation">
        <div class="modal-dialog modal-md">
            <form method="get" action="add-reservation.php" class="form-horizontal">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="clinic_id">Clinic</label>
                    <select class="form-control select2" id="clinic_id" name="clinic_id" required>
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
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn elevation-1 btn-sm btn-default " data-dismiss="modal">Close</button>
              <input type="submit" class="btn elevation-1 btn-sm btn-primary " id="add-reservation_btn" name="add-reservation" value="Next">
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
        
    $("#reservation_name").keyup(function(){
                    
        var reservation_name = $(this).val().trim();
             
        if(reservation_name != ''){
            
            $.ajax({
                url: 'check-reservation_name.php',
                type: 'post',
                data: {reservation_name: reservation_name},
                success: function(response){
                
                    $('#response').html(response);
                
                }
            });
        }else{
            $("#response").html("");
        }
                
    });

});
</script>