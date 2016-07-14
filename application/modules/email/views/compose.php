<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.min.css"/>
<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/js/select2.full.min.js"></script>
<style>

    .select2-container-multi .select2-choices .select2-search-field input{
        padding: 0px;
    }
</style><!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh"></div>
        <div class="panel-body">                              
            <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>email/compose" method="post" 
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo ucwords("user type"); ?></label>
                    <div class="col-sm-5">
                        <select class="form-control" id="user_type" name="user_type" required="">
                            <option value="">Select</option>    
                            <option value="all">All</option>
                            <?php foreach ($user_type as $role) { ?>}
                                <option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
                            <?php } ?>
                        </select>                        
                    </div>
                </div>
                <div class="student_user hide">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo ucwords("department"); ?></label>
                        <div class="col-sm-5">
                            <select class="form-control" id="department" name="department">
                                <option value="">Select</option>
                                <?php foreach ($degree as $row) { ?>
                                    <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo ucwords("Branch"); ?></label>
                        <div class="col-sm-5">
                            <select class="form-control" id="branch" name="branch">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo ucwords("batch"); ?></label>
                        <div class="col-sm-5">
                            <select class="form-control" id="batch" name="batch">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="main_semester">
                        <label class="col-sm-2 control-label">Semester</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="semester" name="semester">
                                <option value="">Select</option>   
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group email_box hide">
                    <label class="col-sm-2 control-label"><?php echo ucwords("users"); ?></label>
                    <div class="col-sm-7">
                        <select class="form-control email_select2" style="width: 70%; height: 30px;" id="email" name="email[]" required="" multiple=""> 
                        </select>
                        <input class="col-md-2" type="checkbox" id="check_all_user"/>Select All
                    </div>
                </div>                

                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo ucwords("Subject"); ?></label>
                    <div class="col-sm-5">
                        <textarea class="form-control" name="subject" required=""></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo ucwords("external email"); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="cc"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo ucwords("Message"); ?></label>
                    <div class="col-sm-9">
                        <textarea id="cke_editor2" name="message" class="width-100 form-control"  rows="15" placeholder="Write your message here"></textarea>                                              
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo ucwords("Attachment"); ?></label>
                    <div class="col-sm-5">
                        <input type="file" class="form-control" name="userfile[]" multiple/>
                    </div>
                </div>

                <div class="form-group form-actions">
                    <div class="col-sm-12 col-md-offset-2">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope append-icon"></i> <?php echo ucwords("Send"); ?></button>

                    </div>
                </div>
            </form>
        </div>
        <!-- panel-body  --> 

    </div>
    <!-- panel --> 
</div>

</div>
<!-- row --> 

</div>
<!-- .vd_content-section --> 

</div>
<!-- .vd_content --> 
</div>
<!-- .vd_container --> 
</div>
<!-- .vd_content-wrapper --> 

<!-- Middle Content End --> 

<style>
    .checkbox-custom{
        display: inline-block;
    }
</style>

<script type="text/javascript">
    $(".email_select2").select2();
    $("#check_all_user").click(function () {
        if ($("#check_all_user").is(':checked')) {
            $(".email_select2 > option").prop("selected", "selected");
            $(".email_select2").trigger("change");
        } else {
            $(".email_select2 > option").removeAttr("selected");
            $(".email_select2").trigger("change");
        }
    });
</script>
<script>
    CKEDITOR.replace('message');
    $(document).ready(function () {

        $('#user_type').on('change', function () {
            var role_id = $(this).val();
            var role_name = $('option:selected', this).text();

            if (role_name == 'Student') {
                //show department branch and sem    
                show_student_user();
                show_email_box();
                set_email_required();
            } else if (role_name == 'All') {
                //show email box
                hide_email_box();
                hide_student_user();
                reset_email_required();
            } else {
                show_email_box();
                hide_student_user();
                users_list_by_role(role_id);
                set_email_required();
            }
        });

        $('#department').on('change', function () {
            var department_id = $(this).val();
            department_branch(department_id);
        });

        $('#branch').on('change', function () {
            var department_id = $('#department').val();
            var branch_id = $(this).val();
            batch_from_department_branch(department_id, branch_id);
            semester_from_branch(branch_id);
        });

        $('#semester').on('change', function () {
            var department = $('#department').val();
            var branch = $('#branch').val();
            var batch = $('#batch').val();
            var semester = $('#semester').val();
            student_list(department, branch, batch, semester);
        });

        function student_list(department, branch, batch, semester) {
            $('#email').find('option').remove().end();
            $('.select2-search-choice').remove();
            $.ajax({
                url: '<?php echo base_url(); ?>student/student_list/' + department + '/' + branch + '/' + batch + '/' + semester,
                type: 'GET',
                success: function (content) {
                    var students = jQuery.parseJSON(content);
                    $.each(students, function (key, value) {
                        $('#email').append('<option value=' + value.user_id + '>' + value.std_first_name + ' ' + value.std_last_name + '</option>');
                    });
                }
            });
            
        }

        function batch_from_department_branch(department, branch) {
            $('#batch').find('option').remove().end();
            $('#batch').append('<option value>Select</option>');
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>batch/department_branch_batch/" + department + '/' + branch,
                success: function (response) {
                    var branch = jQuery.parseJSON(response);
                    $.each(branch, function (key, value) {
                        $('#batch').append('<option value=' + value.b_id + '>' + value.b_name + '</option>');
                    });
                }
            });
        }

        function semester_from_branch(branch) {
            $('#semester').find('option').remove().end();
            $('#semester').append('<option value>Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>semester/semester_branch/' + branch,
                type: 'GET',
                success: function (content) {
                    var semester = jQuery.parseJSON(content);
                    $.each(semester, function (key, value) {
                        $('#semester').append('<option value=' + value.s_id + '>' + value.s_name + '</option>');
                    });
                }
            });
        }

        function department_branch(department_id) {
            $('#branch').find('option').remove().end();
            $('#branch').append('<option value>Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>branch/department_branch/' + department_id,
                type: 'GET',
                success: function (content) {
                    var branch = jQuery.parseJSON(content);
                    console.log(branch);
                    $.each(branch, function (key, value) {
                        $('#branch').append('<option value=' + value.course_id + '>' + value.c_name + '</option>');
                    });
                }
            });
        }

        function users_list_by_role(role_id) {
            $('#email').find('option').remove().end();
            $('.select2-search-choice').remove();
            $.ajax({
                url: '<?php echo base_url(); ?>user/users_with_role/' + role_id,
                type: 'GET',
                success: function (content) {
                    var users = jQuery.parseJSON(content);
                    $.each(users, function (key, value) {
                        $('#email').append('<option value=' + value.user_id + '>' + value.first_name + ' ' + value.last_name + '</option>');
                    });
                }
            });
            
        }
        
        function set_email_required() {
            $('#email').attr('required', 'required');
        }
        
        function reset_email_required() {
            $('#email').removeAttr('required');
        }

        function show_email_box() {
            $('.email_box').removeClass('hide');
        }

        function hide_email_box() {
            $('.email_box').addClass('hide');
        }

        function show_student_user() {
            $('.student_user').removeClass('hide');
        }

        function hide_student_user() {
            $('.student_user').addClass('hide');
        }

    });
</script>
