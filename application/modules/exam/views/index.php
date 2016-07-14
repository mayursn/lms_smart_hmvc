<?php
$create = create_permission($permission, 'Exam');
$read = read_permission($permission, 'Exam');
$update = update_permisssion($permission, 'Exam');
$delete = delete_permission($permission, 'Exam');
?>
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <div class=panel-body>
                <?php if($create){ ?>
                <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/exam_create');" data-toggle="modal"><i class="fa fa-plus"></i> Exam</a>
                <?php } ?>
                <?php if($create || $read || $update || $delete){ ?>
                <div class="row filter-row">
                    <form id="due_amount-search" action="#" class="form-groups-bordered validate">
                        <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <label><?php echo ucwords("department"); ?></label>
                            <select class="form-control" id="search-degree"name="degree">
                                <option value="">Select</option>
                                <?php foreach ($degree as $row) { ?>
                                    <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <label><?php echo ucwords("Branch"); ?></label>
                            <select id="search-course" name="course" data-filter="4" class="form-control">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <label><?php echo ucwords("Batch"); ?></label>
                            <select id="search-batch" name="batch" data-filter="5" class="form-control">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label> <?php echo ucwords("Semester"); ?></label>
                            <select id="search-semester" name="semester" data-filter="6" class="form-control">
                                <option value="">Select</option>

                            </select>
                        </div>
                        <div class="form-group col-lg-1 col-md-1 col-sm-2 col-xs-2">
                            <label>&nbsp;</label><br/>
                            <input id="search-due_amount-data" type="button" value="Go" class="btn btn-info vd_bg-green"/>
                        </div>
                    </form>

                </div>

                <div id="all-due_amount-result">
                    <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                        <thead>

                        <th>No</th>
                        <th>Exam Name</th>
                        <th>Department</th>
                        <th width="14%">Branch</th>
                        <th>Batch</th>
                        <th width="10%">Semester</th>
                        <th width="10%">Date</th>
                        <?php if($update || $delete){ ?>
                        <th>Action</th>
                        <?php } ?>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($exams as $row) {
                                $cenlist = array();
                                ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $row->em_name; ?></td>
                                    <td><?php echo $row->d_name; ?></td>
                                    <td><?php echo $row->c_name; ?></td>
                                    <td><?php echo $row->b_name; ?></td>
                                    <td><?php echo $row->s_name; ?></td>
                                    <td><?php echo date_formats($row->em_date); ?></td>
                                    <?php if($update || $delete){ ?>
                                    <td class="menu-action">
                                        <?php if($update){ ?>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/exam_edit/<?php echo $row->em_id; ?>');"  data-toggle="tooltip" data-placement="top"><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>
                                        <?php } ?>
                                        <?php if($delete){ ?>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>exam/delete/<?php echo $row->em_id; ?>');" data-toggle="tooltip" data-placement="top"><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>
                                        <?php } ?>
                                    </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
                <div id="due_amount-filter-result"></div>

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
        var form = $('#due_amount-search');
        $('#search-due_amount-data').on('click', function () {
            $("#due_amount-search").validate({
                rules: {
                    degree: "required",
                    course: "required",
                    batch: "required",
                    semester: "required"
                },
                messages: {
                    degree: "Select department",
                    course: "Select branch",
                    batch: "Select batch",
                    semester: "Select semester"
                }
            });

            if (form.valid() == true)
            {
                $('#all-due_amount-result').hide();
                var degree = $("#search-degree").val();
                var course = $("#search-course").val();
                var batch = $("#search-batch").val();
                var semester = $("#search-semester").val();
                $.ajax({
                    url: '<?php echo base_url(); ?>exam/get_exam_filter/' + degree + '/'
                            + course + '/' + batch + '/' + semester,
                    type: 'get',
                    success: function (content) {
                        $("#due_amount-filter-result").html(content);
                        $('#all-due_amount-result').hide();
                        $('#due_amount-data-tables').DataTable({"language": {"emptyTable": "No data available"}});
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        //course by degree
        $('#search-degree').on('change', function () {
            var course_id = $('#search-course').val();
            var degree_id = $(this).val();
            //remove all present element
            $('#search-course').find('option').remove().end();
            $('#search-course').append('<option value="">Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>branch/department_branch/' + degree_id,
                type: 'get',
                success: function (content) {
                    var course = jQuery.parseJSON(content);
                    $.each(course, function (key, value) {
                        $('#search-course').append('<option value=' + value.course_id + '>' + value.c_name + '</option>');
                    })
                }
            })
            batch_from_degree_and_course(degree_id, course_id);
        });
        //batch from course and degree
        $('#search-course').on('change', function () {
            var degree_id = $('#search-degree').val();
            var course_id = $(this).val();
            batch_from_degree_and_course(degree_id, course_id);
            get_semester_from_branch(course_id);
        })

        //find batch from degree and course
        function batch_from_degree_and_course(degree_id, course_id) {
            //remove all element from batch
            $('#search-batch').find('option').remove().end();
            $('#search-batch').append('<option value="">Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>batch/department_branch_batch/' + degree_id + '/' + course_id,
                type: 'get',
                success: function (content) {
                    var batch = jQuery.parseJSON(content);
                    console.log(batch);
                    $.each(batch, function (key, value) {
                        $('#search-batch').append('<option value=' + value.b_id + '>' + value.b_name + '</option>');
                    })
                }
            })
        }

        //get semester from brach
        function get_semester_from_branch(branch_id) {
            $('#search-semester').find('option').remove().end();
            $.ajax({
                url: '<?php echo base_url(); ?>semester/semester_branch/' + branch_id,
                type: 'get',
                success: function (content) {
                    $('#search-semester').append('<option value="">Select</option>');
                    var semester = jQuery.parseJSON(content);
                    $.each(semester, function (key, value) {
                        $('#search-semester').append('<option value=' + value.s_id + '>' + value.s_name + '</option>');
                    })
                }
            })
        }

    })
</script>