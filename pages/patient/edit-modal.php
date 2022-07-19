      <div class="modal fade" id="add-module">
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="module_name">Module Name</label>
                    <input type="text" class="form-control form-control-border" id="module_name" name="module_name" placeholder="Module Name" required>
                    <div id="response" ></div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control form-control-border" rows="3" id="description" name="description" placeholder="Description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="g_level_id">Grade Level</label>
                    <select class="form-control select2" id="g_level_id" name="g_level_id" required>
                        <?php
                        require_once '../database&config/config.php';
                        $cn = new mysqli (HOST, USER, PW, DB);
                        $sql="SELECT g_level_id, grade_level FROM tbl_grade_level";
                        $qry=$cn->prepare($sql);
                        $qry->execute();
                        $qry->bind_result($g_level_id, $grade_level);
                        $qry->store_result();
                        while($qry->fetch()){
                            echo "<option value='$g_level_id'>$grade_level</option>";
                        }
                        ?>
                    </select>
                  </div>
                <div class="form-group">
                    <label for="quarter">Quarter</label>
                    <select class="form-control" id="quarter" name="quarter" required>
                        <option value='1'>1st Quarter</option>
                        <option value='2'>2nd Quarter</option>
                        <option value='3'>3rd Quarter</option>
                        <option value='4'>4th Quarter</option>
                   </select>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn elevation-1 btn-sm btn-default " data-dismiss="modal">Close</button>
              <input type="submit" class="btn elevation-1 btn-sm btn-primary " id="add-module_btn" name="add-module" value="Save">
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
        
    $("#module_name").keyup(function(){
                    
        var module_name = $(this).val().trim();
             
        if(module_name != ''){
            
            $.ajax({
                url: 'check-module_name.php',
                type: 'post',
                data: {module_name: module_name},
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