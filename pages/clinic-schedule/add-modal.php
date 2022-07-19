      <div class="modal fade" id="add-clinic_schedule">
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
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
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control form-control-border" name="date" id="date" required>
                </div>
                <div class="form-group">
                    <label for="slots">Slots Available</label>
                    <input type="number" class="form-control form-control-border" name="slots" id="slots" placeholder="Slots Available" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn elevation-1 btn-sm btn-default " data-dismiss="modal">Close</button>
              <input type="submit" class="btn elevation-1 btn-sm btn-primary " id="add-clinic_schedule_btn" name="add-clinic_schedule" value="Save">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<script>
</script>