<!-- Start .row -->
<?php
$create = create_permission($permission, 'Assignment');
$read = read_permission($permission, 'Assignment');
$update = update_permisssion($permission, 'Assignment');
$delete = delete_permission($permission, 'Assignment');
?>
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle">
            <div class=panel-body>
                <div class="tabs mb20">
                    <ul id="import-tab" class="nav nav-tabs">
                        <li class="active">
                            <a href="#list" data-toggle="tab" aria-expanded="true"><?php echo ucwords("Assignment List"); ?></a>
                        </li>
                        <li class="">
                            <a href="#submittedlist" data-toggle="tab" aria-expanded="false"><?php echo ucwords("submitted assignment list"); ?></a>
                        </li>
                        <li class="">
                            <a href="#latesubmit" data-toggle="tab" aria-expanded="false"><?php echo ucwords("Late submitted assignment list"); ?></a>
                        </li>
                        <li class="">
                            <a href="#not_submitted" data-toggle="tab" aria-expanded="false"><?php echo ucwords("Not submitted assignment Student list"); ?></a>
                        </li>
                    </ul>
                    <div id="import-tab-content" class="tab-content">
                          <?php if ($create || $read || $update || $delete) { ?>
                        <div class="tab-pane fade active in" id="list">
                            <?php if ($create) { ?>
                            <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/assignment_create');" data-toggle="modal"><i class="fa fa-plus"></i> Assignment</a>
                            <?php } ?>
                             <div class="row filter-row">
                                <form id="assignment-search" action="#" class="form-groups-bordered validate">
                                    <div class="form-group col-sm-2">
                                        <label><?php echo ucwords("department"); ?></label>
                                        <select class="form-control" id="filterdegree" name="degree_search">
                                            <option value="">Select</option>
                                            <?php foreach ($degree as $row) { ?>
                                                <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label><?php echo ucwords("Branch"); ?></label>
                                        <select id="filtercourse" name="course_search" data-filter="4" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label><?php echo ucwords("Batch"); ?></label>
                                        <select id="filterbatch" name="batch_search" data-filter="5" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                    </div>                                
                                    <div class="form-group col-sm-2">
                                        <label> <?php echo ucwords("Semester"); ?></label>
                                        <select id="filtersemester" name="semester_search" data-filter="6" class="form-control">
                                            <option value="">Select</option>

                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label><?php echo ucwords("Class"); ?><span style="color:red"></span></label>
                                        <select class="form-control filter-rows" name="divclass" id="filterclass" >
                                            <option value="">Select</option>
                                            <?php
                                            $class = $this->db->get('class')->result_array();
                                            foreach ($class as $c) {
                                                ?>
                                                <option value="<?php echo $c['class_id'] ?>"><?php echo $c['class_name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div> 
                                    <div class="form-group col-sm-2">
                                        <label>&nbsp;</label><br/>
                                        <input id="search-assignment-structure-data" type="button" value="Go" class="btn btn-info"/>
                                    </div>
                                </form>
                            </div>
                            <div class="panel-body table-responsive" id="getresponse">          
                                <table id="datatable-listss" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                                    <thead>
                                        <tr>
                                            <th>No</th>												
                                            <th>Assignment</th>
                                            <th>Department</th>
                                            <th>Branch</th>												
                                            <th>Batch</th>												
                                            <th>Semester</th>
                                            <th>Class</th>
                                            <th>Description</th>
                                            <th>File</th>
                                            <th>Submission Date</th>												
                                           <?php if ($update || $delete) { ?>
                                            <th>Actions</th>
                                            <?php } ?>                           										
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($assignment as $row):
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>	
                                                <td ><?php echo $row->assign_title; ?></td>	
                                                <td>
                                                    <?php
                                                    foreach ($degree as $dgr):
                                                        if ($dgr->d_id == $row->assign_degree):

                                                            echo $dgr->d_name;
                                                        endif;
                                                    endforeach;
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    foreach ($course as $crs) {
                                                        if ($crs->course_id == $row->course_id) {
                                                            echo $crs->c_name;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($batch as $bch) {
                                                        if ($bch->b_id == $row->assign_batch) {
                                                            echo $bch->b_name;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($semester as $sem) {
                                                        if ($sem->s_id == $row->assign_sem) {
                                                            echo $sem->s_name;
                                                        }
                                                    }
                                                    ?>													
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($class as $c) {
                                                        if ($c['class_id'] == $row->class_id) {
                                                            echo $c['class_name'];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <!-- id="inlinedate" contenteditable="true" onBlur="saveToDatabase(this,'assign_dos','<?php echo $row->assign_id; ?>')" onClick="showEdit(this);"-->
                                                <td  ><?php echo wordwrap($row->assign_desc, 30, "<br>\n"); ?></td>
                                                <td id="downloadedfile"><a href="<?php echo base_url() . 'uploads/project_file/' . $row->assign_filename; ?>" download="" title="download"><i class="fa fa-download"></i></a></td>	
                                                <td ><?php echo date_formats($row->assign_dos); ?></td>	
                                                <?php if ($update || $delete) { ?>
                                                <td class="menu-action">
                                                     <?php 
                                            if($update) { ?>
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/assignment_edit/<?php echo $row->assign_id; ?>');" data-toggle="modal"><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>
                                                      <?php
                                                     $current = date("Y-m-d H:i:s");
                                                      $dos = date("Y-m-d H:i:s",strtotime($row->assign_dos));
                                                      if($dos < $current)
                                                      {
                                                    ?>
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/assignment_reopen/<?php echo $row->assign_id; ?>');" data-toggle="modal"><span class="label label-primary mr6 mb6"><i class="fa fa-desktop" ></i>Reopen</span></a>
                                                     <?php } ?>
                                            <?php } ?>
                                                      <?php
                                            if($delete) { ?>
                                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>assignment/delete/<?php echo $row->assign_id; ?>');" data-toggle="modal" ><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>
                                            <?php } ?>  
                                                </td>	
                                                <?php } ?>
                                            </tr>
                                        <?php endforeach; ?>						
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                         <!-- Submitted Assignment -->
                        <div class="tab-pane fade" id="submittedlist">
                            <div class="row filter-row">
                                <form id="submitted-filter" action="#" class="form-groups-bordered validate">
                                    <div class="form-group col-sm-2">
                                        <label><?php echo ucwords("department"); ?></label>
                                        <select class="form-control" id="submit-course" name="degree_search">
                                            <option value="">Select</option>
                                            <?php foreach ($degree as $row) { ?>
                                                <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label><?php echo ucwords("Branch"); ?></label>
                                        <select id="submit-branch" name="course_search" data-filter="4" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label><?php echo ucwords("Batch"); ?></label>
                                        <select id="submit-batch" name="batch_search" data-filter="5" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                    </div>                                
                                    <div class="form-group col-sm-2">
                                        <label> <?php echo ucwords("Semester"); ?></label>
                                        <select id="submit-semester" name="semester_search" data-filter="6" class="form-control">
                                            <option value="">Select</option>

                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2" style="display: none;">
                                        <label><?php echo ucwords("Class"); ?><span style="color:red"></span></label>
                                        <select class="form-control filter-rows" name="divclass" id="submit-class" >
                                            <option value="">Select</option>
                                            <?php
                                            //$class = $this->db->get('class')->result_array();
                                            foreach ($class as $c) {
                                                ?>
                                                <option value="<?php echo $c['class_id'] ?>"><?php echo $c['class_name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div> 
                                    <div class="form-group col-sm-2">
                                        <label>&nbsp;</label><br/>
                                        <input id="submitted" type="button" value="Go" class="btn btn-info"/>
                                    </div>
                                </form>
                            </div>
                            <div class="panel-body table-responsive" id="getsubmit">
                                <table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100% id="sub-tables">
                                    <thead>
                                        <tr>
                                            <th>No</th>												
                                            <th><div><?php echo ucwords("Assignment"); ?></div></th>
                                            <th><div><?php echo ucwords("Student"); ?></div></th>
                                            <th><div><?php echo ucwords("Department"); ?></div></th>
                                            <th><div><?php echo ucwords("Branch"); ?></div></th>												
                                            <th><div><?php echo ucwords("Batch"); ?></div></th>												
                                            <th><div><?php echo ucwords("Sem"); ?></div></th>	
                                            <th><div><?php echo ucwords("Submitted-date"); ?></div></th>	
                                            <th><div><?php echo ucwords("Comment"); ?></div></th>
                                            <th><div><?php echo ucwords("File"); ?></div></th>	
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($submitedassignment->result() as $rowsub):
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $rowsub->assign_title; ?></td>
                                                <td><?php echo $rowsub->name; ?></td>
                                                <td><?php
                                                    foreach ($degree as $dgr):
                                                        if ($dgr->d_id == $rowsub->assign_degree):

                                                            echo $dgr->d_name;
                                                        endif;


                                                    endforeach;
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    foreach ($course as $crs) {
                                                        if ($crs->course_id == $rowsub->course_id) {
                                                            echo $crs->c_name;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($batch as $bch) {
                                                        if ($bch->b_id == $rowsub->assign_batch) {
                                                            echo $bch->b_name;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($semester as $sem) {
                                                        if ($sem->s_id == $rowsub->assign_sem) {
                                                            echo $sem->s_name;
                                                        }
                                                    }
                                                    ?>													
                                                </td>	
                                                <td><?php echo date_formats($rowsub->submited_date); ?></td>	
                                                <td><?php echo $rowsub->comment; ?></td>
                                                <td id="downloadedfile"><a href="<?php echo base_url(); ?>uploads/project_file/<?php echo $rowsub->document_file; ?>" download="" title="download"><i class="fa fa-download"></i></a></td>                      	
                                            </tr>
                                        <?php endforeach; ?>						
                                    </tbody>
                                </table>
                            </div>
                        </div>
                         
                         <!-- End submitted assignments -->
                         <!-- Late Submitted Assignments student List -->
                         <div class="tab-pane fade" id="latesubmit">                            
                            <div class="panel-body table-responsive" id="latesubmit">
                                <table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100% id="latetable">
                                    <thead>
                                        <tr>
                                            <th>No</th>												
                                            <th><div><?php echo ucwords("Assignment"); ?></div></th>
                                            <th><div><?php echo ucwords("Student"); ?></div></th>
                                            <th><div><?php echo ucwords("Department"); ?></div></th>
                                            <th><div><?php echo ucwords("Branch"); ?></div></th>												
                                            <th><div><?php echo ucwords("Batch"); ?></div></th>												
                                            <th><div><?php echo ucwords("Semester"); ?></div></th>	
                                            <th><div><?php echo ucwords("Submission date"); ?></div></th>	
                                            <th><div><?php echo ucwords("Submitted-date"); ?></div></th>	
                                            <th><div><?php echo ucwords("Comment"); ?></div></th>
                                            <th><div><?php echo ucwords("File"); ?></div></th>	
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $countl = 1;
                                        foreach ($late_submitted as $rowlate):
                                            ?>
                                            <tr>
                                                <td><?php echo $countl++; ?></td>
                                                <td><?php echo $rowlate->assign_title; ?></td>
                                                <td><?php echo $rowlate->name; ?></td>
                                                <td><?php echo $rowlate->d_name;  ?></td>
                                                <td>
                                                    <?php   echo $rowlate->c_name;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php   echo $rowlate->b_name;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                            echo $rowlate->s_name;
                                                    ?>													
                                                </td>	
                                                <td><?php echo date_formats($rowlate->assign_dos); ?></td>	
                                                <td><?php echo date_formats($rowlate->submited_date); ?></td>	
                                                <td><?php echo $rowlate->comment; ?></td>
                                                <td id="downloadedfile"><a href="<?php echo base_url(); ?>uploads/project_file/<?php echo $rowlate->document_file; ?>" download="" title="download"><i class="fa fa-download"></i></a></td>                      	
                                            </tr>
                                        <?php endforeach; ?>						
                                    </tbody>
                                </table>
                            </div>
                        </div>
                         <!-- End Late Submitted  -->
                         <!-- Not submitted assignment student list -->
                           <div class="tab-pane fade" id="not_submitted">   
                            <div class="row filter-row">
                                <form id="not-submitted-search" action="#" class="form-groups-bordered validate">
                                    <div class="form-group col-sm-2">
                                        <label><?php echo ucwords("department"); ?></label>
                                        <select class="form-control" id="filter_department" name="degree_search">
                                            <option value="">Select</option>
                                            <?php foreach ($degree as $row) { ?>
                                                <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label><?php echo ucwords("Branch"); ?></label>
                                        <select id="filter_branch" name="course_search" data-filter="4" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label><?php echo ucwords("Batch"); ?></label>
                                        <select id="filter_batch" name="batch_search" data-filter="5" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                    </div>                                
                                    <div class="form-group col-sm-2">
                                        <label> <?php echo ucwords("Semester"); ?></label>
                                        <select id="filter_semester" name="semester_search" data-filter="6" class="form-control">
                                            <option value="">Select</option>

                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label><?php echo ucwords("Class"); ?><span style="color:red"></span></label>
                                        <select class="form-control filter-rows" name="divclass" id="filter_class" >
                                            <option value="">Select</option>
                                            <?php
                                            $class = $this->db->get('class')->result_array();
                                            foreach ($class as $c) {
                                                ?>
                                                <option value="<?php echo $c['class_id'] ?>"><?php echo $c['class_name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div> 
                                    <div class="form-group col-sm-2">
                                        <label><?php echo ucwords("Assignment"); ?><span style="color:red"></span></label>
                                        <select class="form-control filter-rows" name="assign_id" id="filter_assign" >
                                            <option value="">Select Assignment</option>
                                           
                                        </select>
                                    </div> 
                                    <div class="form-group col-sm-2">
                                        <label>&nbsp;</label><br/>
                                        <input id="not-submit" type="button" value="Go" class="btn btn-info"/>
                                    </div>
                                </form>
                            </div>
                            <div id="get_not_submitted">
                            
                            </div>
                        </div>
<!-- Not Submitted Assignment Student -->
                         

                          <?php } ?>

                    </div>

                </div>
            </div>
        </div>
        <!-- End .panel -->
    </div>
    <!-- col-lg-12 end here -->
</div>
<!-- End .row -->
</div>
<!-- End contentwrapper -->
</div>
<!-- End #content -->

<script>
    
    
    $(document).ready(function () {
         $("#filter_class").change(function(){
              var degree = $("#filter_department").val();
                    var course = $("#filter_branch").val();
                    var batch = $("#filter_batch").val();
                    var semester = $("#filter_semester").val();
                    var divclass = $("#filter_class").val();
                    $('#filter_assign').find('option').remove().end();
                    $('#filter_assign').append('<option value>Select</option>');
                    $.ajax({
                        url: '<?php echo base_url(); ?>assignment/getassignment_list/',
                        type: 'post',
                        data: {'degree': degree, "course": course, "batch": batch, "semester": semester, 'divclass': divclass},
                        success: function (content) {
                            var branch = jQuery.parseJSON(content);
                        console.log(branch);
                        $.each(branch, function (key, value) {
                            $('#filter_assign').append('<option value=' + value.assign_id + '>' + value.assign_title + '</option>');
                        });
                          //  $("#filter_assign").html(content);
                            // $("#dtbl").hide();

                        }
                    });
        });
        $('#filter_department').on('change', function () {
            var department_id = $(this).val();
            department_branch(department_id);
        });
        $('#filter_branch').on('change', function () {
            var branch_id = $(this).val();
            var department = $('#filter_department').val();
            batch_form_department_branch(department, branch_id);
            semester_from_branch(branch_id);
        });
        
        function department_branch(department_id) {
            $('#filter_branch').find('option').remove().end();
            $('#filter_branch').append('<option value>Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>branch/department_branch/' + department_id,
                type: 'GET',
                success: function (content) {
                    var branch = jQuery.parseJSON(content);
                    console.log(branch);
                    $.each(branch, function (key, value) {
                        $('#filter_branch').append('<option value=' + value.course_id + '>' + value.c_name + '</option>');
                    });
                }
            });
        }

        function batch_form_department_branch(department, branch) {
            $('#filter_batch').find('option').remove().end();
            $('#filter_batch').append('<option value>Select</option>');
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>batch/department_branch_batch/" + department + '/' + branch,
                success: function (response) {
                    var branch = jQuery.parseJSON(response);
                    $.each(branch, function (key, value) {
                        $('#filter_batch').append('<option value=' + value.b_id + '>' + value.b_name + '</option>');
                    });
                }
            });
        }

        function semester_from_branch(branch) {
            $('#filter_semester').find('option').remove().end();
            $('#filter_semester').append('<option value>Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>semester/semester_branch/' + branch,
                type: 'GET',
                success: function (content) {
                    var semester = jQuery.parseJSON(content);
                    $.each(semester, function (key, value) {
                        $('#filter_semester').append('<option value=' + value.s_id + '>' + value.s_name + '</option>');
                    });
                }
            });
        }
        
         var formn = $('#not-submitted-search');
          $('#not-submit').on('click', function () {
                $("#not-submit").validate({
                    rules: {
                        degree_search: "required",
                        course_search: "required",
                        batch_search: "required",
                        semester_search: "required"
                    },
                    messages: {
                        degree_search: "Select department",
                        course_search: "Select branch",
                        batch_search: "Select batch",
                        semester_search: "Select semester"
                    }
                });

                if (formn.valid() == true)
                {

                   var degree = $("#filter_department").val();
                    var course = $("#filter_branch").val();
                    var batch = $("#filter_batch").val();
                    var semester = $("#filter_semester").val();
                    var divclass = $("#filter_class").val();
                    var filter_assign = $("#filter_assign").val();                   
                    $.ajax({
                        url: '<?php echo base_url(); ?>assignment/getassignment/notsubmitted',
                        type: 'post',
                        data: {'degree': degree, "course": course, "batch": batch, "semester": semester, 'divclass': divclass,'assign_id':filter_assign},
                        success: function (content) {
                           
                            $("#get_not_submitted").html(content);
                            // $("#dtbl").hide();

                        }
                    });
                }
            });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sub-tables').dataTable({"language": { "emptyTable": "No data available" }});
        $("#datatable-listss").dataTable({"language": { "emptyTable": "No data available" }});
        $("#latetable").dataTable({"language": { "emptyTable": "No data available" }});
        $("#not_submitted_assignment_list").dataTable({"language": { "emptyTable": "No data available" }});

    });
</script>


<script>
    
    $(document).ready(function () {
        $('#filterdegree').on('change', function () {
            var department_id = $(this).val();
            department_branch(department_id);
        });
        $('#filtercourse').on('change', function () {
            var branch_id = $(this).val();
            var department = $('#filterdegree').val();
            batch_form_department_branch(department, branch_id);
            semester_from_branch(branch_id);
        });
        
        function department_branch(department_id) {
            $('#filtercourse').find('option').remove().end();
            $('#filtercourse').append('<option value>Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>branch/department_branch/' + department_id,
                type: 'GET',
                success: function (content) {
                    var branch = jQuery.parseJSON(content);
                    console.log(branch);
                    $.each(branch, function (key, value) {
                        $('#filtercourse').append('<option value=' + value.course_id + '>' + value.c_name + '</option>');
                    });
                }
            });
        }

        function batch_form_department_branch(department, branch) {
            $('#filterbatch').find('option').remove().end();
            $('#filterbatch').append('<option value>Select</option>');
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>batch/department_branch_batch/" + department + '/' + branch,
                success: function (response) {
                    var branch = jQuery.parseJSON(response);
                    $.each(branch, function (key, value) {
                        $('#filterbatch').append('<option value=' + value.b_id + '>' + value.b_name + '</option>');
                    });
                }
            });
        }

        function semester_from_branch(branch) {
            $('#filtersemester').find('option').remove().end();
            $('#filtersemester').append('<option value>Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>semester/semester_branch/' + branch,
                type: 'GET',
                success: function (content) {
                    var semester = jQuery.parseJSON(content);
                    $.each(semester, function (key, value) {
                        $('#filtersemester').append('<option value=' + value.s_id + '>' + value.s_name + '</option>');
                    });
                }
            });
        }
        
         var form = $('#assignment-search');
          $('#search-assignment-structure-data').on('click', function () {
                $("#assignment-search-submitted").validate({
                    rules: {
                        degree_search: "required",
                        course_search: "required",
                        batch_search: "required",
                        semester_search: "required"
                    },
                    messages: {
                        degree_search: "Select department",
                        course_search: "Select branch",
                        batch_search: "Select batch",
                        semester_search: "Select semester"
                    }
                });

                if (form.valid() == true)
                {

                    var degree = $("#filterdegree").val();
                    var course = $("#filtercourse").val();
                    var batch = $("#filterbatch").val();
                    var semester = $("#filtersemester").val();
                    var divclass = $("#filterclass").val();
                  
                    $.ajax({
                        url: '<?php echo base_url(); ?>assignment/getassignment/allassignment',
                        type: 'post',
                        data: {'degree': degree, "course": course, "batch": batch, "semester": semester, 'divclass': divclass},
                        success: function (content) {                        
                            $("#getresponse").html(content);
                            // $("#dtbl").hide();
                        }
                    });
                }
            });
    });
</script>
<script>
    
    
    $(document).ready(function () {
        $('#submit-course').on('change', function () {
            var department_id = $(this).val();
            department_branch(department_id);
        });
        $('#submit-branch').on('change', function () {
            var branch_id = $(this).val();
            var department = $('#submit-course').val();
            batch_form_department_branch(department, branch_id);
            semester_from_branch(branch_id);
        });
        
        function department_branch(department_id) {
            $('#submit-branch').find('option').remove().end();
            $('#submit-branch').append('<option value>Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>branch/department_branch/' + department_id,
                type: 'GET',
                success: function (content) {
                    var branch = jQuery.parseJSON(content);
                    console.log(branch);
                    $.each(branch, function (key, value) {
                        $('#submit-branch').append('<option value=' + value.course_id + '>' + value.c_name + '</option>');
                    });
                }
            });
        }

        function batch_form_department_branch(department, branch) {
            $('#submit-batch').find('option').remove().end();
            $('#submit-batch').append('<option value>Select</option>');
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>batch/department_branch_batch/" + department + '/' + branch,
                success: function (response) {
                    var branch = jQuery.parseJSON(response);
                    $.each(branch, function (key, value) {
                        $('#submit-batch').append('<option value=' + value.b_id + '>' + value.b_name + '</option>');
                    });
                }
            });
        }

        function semester_from_branch(branch) {
            $('#submit-semester').find('option').remove().end();
            $('#submit-semester').append('<option value>Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>semester/semester_branch/' + branch,
                type: 'GET',
                success: function (content) {
                    var semester = jQuery.parseJSON(content);
                    $.each(semester, function (key, value) {
                        $('#submit-semester').append('<option value=' + value.s_id + '>' + value.s_name + '</option>');
                    });
                }
            });
        }
        
         var forms = $('#submitted-filter');
          $('#submitted').on('click', function () {
                $("#submitted").validate({
                    rules: {
                        degree_search: "required",
                        course_search: "required",
                        batch_search: "required",
                        semester_search: "required"
                    },
                    messages: {
                        degree_search: "Select department",
                        course_search: "Select branch",
                        batch_search: "Select batch",
                        semester_search: "Select semester"
                    }
                });

                if (forms.valid() == true)
                {

                    var degree = $("#submit-course").val();
                    var course = $("#submit-branch").val();
                    var batch = $("#submit-batch").val();
                    var semester = $("#submit-semester").val();
                    var divclass = $("#submit-class").val();
                  
                    $.ajax({
                        url: '<?php echo base_url(); ?>assignment/getassignment/submitted',
                        type: 'post',
                        data: {'degree': degree, "course": course, "batch": batch, "semester": semester},
                        success: function (content) {                        
                            $("#getsubmit").html(content);
                            // $("#dtbl").hide();
                        }
                    });
                }
            });
    });
</script>

