      <div class="modal fade" id="edit-password-<?php echo $user_id; ?>">
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="password_<?php echo $user_id; ?>">New Password</label>
                    <input type="password" class="form-control form-control-border" name="password" id="password_<?php echo $user_id; ?>" placeholder="Password" required>
                    <input type="text" name="user_id" value="<?php echo $user_id; ?>" hidden>
                </div>
                <div class="form-group">
                    <label for="confirm_password_<?php echo $user_id; ?>">Confirm Password</label>
                    <input type="password" class="form-control form-control-border" id="confirm_password_<?php echo $user_id; ?>" placeholder="Password" oninput="confirmPassword<?php echo $user_id; ?>()" required>
                    <div id="response_confirm_password_<?php echo $user_id; ?>"></div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-sm elevation-1" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary btn-sm elevation-1" id="edit-password_btn<?php echo $user_id; ?>" name="edit-password" value="Save">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<script>
    
    function confirmPassword<?php echo $user_id; ?>() {
        var password_<?php echo $user_id; ?> = document.getElementById("password_<?php echo $user_id; ?>").value;
        var confirm_password_<?php echo $user_id; ?> = document.getElementById("confirm_password_<?php echo $user_id; ?>").value;
        
        if(password_<?php echo $user_id; ?> !== confirm_password_<?php echo $user_id; ?>){
            document.getElementById("response_confirm_password_<?php echo $user_id; ?>").innerHTML = "<span style='color: red;'>Password does not match!</span>";
            document.getElementById("edit-password_btn<?php echo $user_id; ?>").disabled = true;
            document.getElementById('confirm_password_<?php echo $user_id; ?>').className = 'form-control form-control-border is-invalid';
        }
        if(password_<?php echo $user_id; ?> == confirm_password_<?php echo $user_id; ?>){
            document.getElementById("response_confirm_password_<?php echo $user_id; ?>").innerHTML = " ";
            document.getElementById("edit-password_btn<?php echo $user_id; ?>").disabled = false;
            document.getElementById('confirm_password_<?php echo $user_id; ?>').className = 'form-control form-control-border is-valid';
        }
    }
</script>