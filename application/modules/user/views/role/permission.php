<!-- Start .row -->
<?php
$create = create_permission($permission, 'User_Permission');
$read = read_permission($permission, 'User_Permission');
$update = update_permisssion($permission, 'User_Permission');
$delete = delete_permission($permission, 'User_Permission');
?>
<div class=row> 
    <div class="col-lg-12">
        <div class=" panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><?php echo $role_details->role_name; ?></strong> Role Permission
                </div>
            </div>
            <div class=panel-body>                
                <form id="permission-form" class="form-horizontal form-groups-bordered" method="post" 
                      action="<?php echo base_url(); ?>user/role/module_role_permission">
                    <input type="hidden" name="role_id" value="<?php echo $role_details->role_id; ?>"/>
                    <?php  if($create || $update){ ?>
                    <div class="form-group">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <button type="submit" class="btn btn-info vd_bg-green" >Submit</button>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($create || $read || $update || $delete){ ?>
                    <table id="permission" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                        <thead>
                            
                            <tr>                                
                                <th>No</th>
                                <th>Module Name</th>
                                <?php if($create || $update){ ?>
                                <th colspan="4">Action</th>
                                <?php } ?>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <?php if($create || $update){ ?>
                                <td>
                                    <input type="checkbox" onclick="create_uncheck();" class="all-create"/><strong>Check All</strong>
                                </td>
                                <td>
                                    <input type="checkbox" onclick="read_uncheck();" class="all-read"/><strong>Check All</strong>
                                </td>
                                <td>
                                    <input type="checkbox" onclick="update_uncheck();" class="all-update"/><strong>Check All</strong>
                                </td>
                                <td>
                                    <input type="checkbox" onclick="delete_uncheck();" class="all-delete"/><strong>Check All</strong>
                                </td>
                                <?php } ?>
                            </tr>
                            <?php $counter = 0; ?>
                            <?php foreach ($modules as $row) { ?>
                                <?php $user_role_permission = ['0', '0', '0', '0']; ?>
                            
                                <?php
                                foreach($user_permission as $permission) {
                                    if($permission->module_id == $row->module_id) {
                                        $user_role_permission = str_split($permission->user_permission);                                        
                                        break;
                                    }
                                }
                                ?>
                            
                                <tr>
                                    <td><?php echo ++$counter; ?></td>
                                    <td><?php echo $row->module_name; ?></td>
                                     <?php if($create || $update){ ?>
                                    <td>
                                        <input class="create-permission" type="checkbox" name="create_<?php echo $row->module_id; ?>"
                                               <?php if($user_role_permission[0] == 1) echo 'checked'; ?>/>Create
                                    </td>
                                    <td>
                                        <input class="read-permission" type="checkbox" name="read_<?php echo $row->module_id; ?>"
                                               <?php if($user_role_permission[1] == 1) echo 'checked'; ?>/>Read</td>
                                    <td>
                                        <input class="update-permission" type="checkbox" name="update_<?php echo $row->module_id; ?>"
                                               <?php if($user_role_permission[2] == 1) echo 'checked'; ?>/>Update</td>
                                    <td><input class="delete-permission" type="checkbox" name="delete_<?php echo $row->module_id; ?>"
                                               <?php if($user_role_permission[3] == 1) echo 'checked'; ?>/>Delete</td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </form>
            </div>
        </div>
        <!-- End .panel -->
    </div>
</div>

</div>
<!-- End .row -->
</div>
<!-- End contentwrapper -->

<style>
    .checkbox-custom{
        display: inline-block;
    }
</style>

<script>
    function create_uncheck()
    {
        if ($('.all-create:checked').length == $('.all-create').length) {
            $('.create-permission').prop('checked', true);
        } else {
            $('.create-permission').prop('checked', false);
        }
    }

    function read_uncheck() {
        if ($('.all-read:checked').length == $('.all-read').length) {
            $('.read-permission').prop('checked', true);
        } else {
            $('.read-permission').prop('checked', false);
        }
    }

    function update_uncheck() {
        if ($('.all-update:checked').length == $('.all-update').length) {
            $('.update-permission').prop('checked', true);
        } else {
            $('.update-permission').prop('checked', false);
        }
    }

    function delete_uncheck() {
        if ($('.all-delete:checked').length == $('.all-delete').length) {
            $('.delete-permission').prop('checked', true);
        } else {
            $('.delete-permission').prop('checked', false);
        }
    }
</script>

