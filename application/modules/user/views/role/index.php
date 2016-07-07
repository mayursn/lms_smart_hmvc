<!-- Start .row -->
<div class=row> 
    <div class="col-lg-12">
        <div class=" panel-default toggle panelMove panelClose panelRefresh">
            <div class=panel-body>
                <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/user_role_create');" data-toggle="modal"><i class="fa fa-plus"></i> Role</a>
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Role Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($roles as $role) { ?>
                            <tr>
                                <td></td>
                                <td><?php echo $role->role_name; ?></td>
                                <td>
                                    <?php
                                    if ($role->is_active == 1)
                                        echo 'Active';
                                    else
                                        echo 'Inactive';
                                    ?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url(); ?>user/role/permission/<?php echo $role->role_id; ?>"><span class="label label-info mr6 mb6"><i class="fa fa-plus" aria-hidden="true"></i>Permission</span></a>
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/user_role_edit/<?php echo $role->role_id; ?>');" data-toggle="modal"><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>user/role/delete/<?php echo $role->role_id; ?>');" data-toggle="modal" ><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>    
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End .panel -->
    </div>
</div>

</div>
<!-- End .row -->
</div>
<!-- End contentwrapper -->

