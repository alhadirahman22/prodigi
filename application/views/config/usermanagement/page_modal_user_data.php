<style type="text/css">
    .row {
        margin-right: 0px;
        margin-left: 0px;
    }
</style>
<form class="form-horizontal" id="formModal">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12 hide" align = 'center' id='msgMENU' style="color: red;">MSG</div>
        </div>   
        <div class="row">
            <div class="col-sm-4">
                <label class="control-label">Username:</label>
            </div>    
            <div class="col-sm-4">
                <input type="text" id="Username"  class="form-control" placeholder="Username Login" value =" <?php echo ($action == 'add') ? '' : $getData[0]['Username'] ?>">
            </div>
        </div>
    </div>
    <div class="form-group"> 
        <div class="row">
            <div class="col-sm-4">
                <label class="control-label">Name :</label>
            </div>    
            <div class="col-sm-4">
                <input type="text" id="Name"  class="form-control" placeholder="Name" value="<?php echo ($action == 'add') ? '' : $getData[0]['Name'] ?>">
            </div>
        </div>
    </div>
    <div class="form-group"> 
        <div class="row">
            <div class="col-sm-4">
                <label class="control-label">Password :</label>
            </div>    
            <div class="col-sm-4">
                <input type="password" id="Password"  class="form-control" placeholder="Password" value="">
            </div>
        </div>
    </div>
    <div class="form-group"> 
            <div class="row">
                <div class="col-sm-4">
                    <label class="control-label">Level :</label>
                </div>    
                <div class="col-sm-4">
                    <select id ="level">
                        <option value="SuperAdmin">SuperAdmin</option>
                        <option value="Operator">Operator</option>
                    </select>
                </div>
            </div>
        </div>
</form>
<script type="text/javascript">
    $(document).ready(function() {
      $('#modal3 .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="button" id="ModalbtnSaveForm" class="btn btn-success" action = "<?php echo $action ?>" kodeuniq = "<?php echo $id ?>">Save</button>');
      <?php if ($action == 'edit'): ?>
          $("#level option").filter(function() {
                //may want to use $.trim in here
                return $(this).val() == "<?php echo $getData[0]['Auth'] ?>"; 
          }).prop("selected", true);
      <?php endif ?>

    });
</script>